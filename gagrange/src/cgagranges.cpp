/***************************************************************************
 *   Copyright (C) 2004 by Daniel Muller                                   *
 *   dan at verliba dot cz                                                 *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.,                                       *
 *   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 ***************************************************************************/

#include <verlihub/cbanlist.h>
#include <verlihub/cconndc.h>
#include <verlihub/cdcproto.h>
#include <verlihub/stringutils.h>
#include "cgagranges.h"
#include "cpigagrange.h"

using namespace nDirectConnect::nTables;
using namespace nDirectConnect::nEnums;
using namespace nDirectConnect::nProtocol;
using namespace nStringUtils;

cGagRange::cGagRange() : 
	mIPMin(0),
	mIPMax(0),
	mUntil(0),
	mPI(NULL)
{
}

void cGagRange::OnLoad()
{
}

ostream& operator << (ostream &os, const cGagRange &gagrange)
{
	string ip, tmp;
	cBanList::Num2Ip(gagrange.mIPMin, ip);
	os << ip << "..";
	cBanList::Num2Ip(gagrange.mIPMax, ip);
	os << ip << " : " << gagrange.mUntil;
	return os;
}

//--------------------------


cGagRangeCfg::cGagRangeCfg(cServerDC *s) : mS(s)
{
	/*Add("max_check_conn_class",max_check_conn_class,2);
	Add("max_check_nick_class",max_check_nick_class,0);
	Add("max_check_gagrange_class",max_check_gagrange_class,2);
	Add("max_insert_desc_class",max_insert_desc_class,2);
	Add("unit_min_share_bytes",unit_min_share_bytes,1024*1024*1024);
	Add("unit_max_share_bytes",unit_max_share_bytes,1024*1024*1024);
	Add("msg_share_more",msg_share_more,"Please share more!!");
	Add("msg_share_less",msg_share_less,"Please share less!!");
	Add("msg_no_gagrange",msg_no_gagrange,"You are not allowed to enter this hub. Your GagRange is not allowed.");
	Add("allow_all_connections",allow_all_connections,true);
	Add("case_sensitive_nick_pattern",case_sensitive_nick_pattern, false);
	*/
}

int cGagRangeCfg::Load()
{
	mS->mSetupList.LoadFileTo(this,"pi_gagrange");
	return 0;
}

int cGagRangeCfg::Save()
{
	mS->mSetupList.SaveFileTo(this,"pi_gagrange");
	return 0;
}

//--------------------------

cGagRanges::cGagRanges(cVHPlugin *pi) : tGagRangeListBase(pi, "pi_gagrange", "ipmin asc")
{};

void cGagRanges::AddFields()
{
	AddCol("ipmin","bigint(20)","0",false,mModel.mIPMin);
	AddCol("ipmax","bigint(20)","0",false,mModel.mIPMax);
	AddPrimaryKey("ipmin");
	AddCol("until" ,"int(11)","0",true,mModel.mUntil);
	mMySQLTable.mExtra = "PRIMARY KEY(ipmin)";
}

void cGagRanges::OnLoadData(cGagRange &Data)
{
	Data.mPI = this->mOwner;
	Data.OnLoad();
	//for(int i=0; i < Size(); i++)cout << GetDataAtOrder(i)->mIPMin << " ";
	//cout << endl;
}

cGagRange * cGagRanges::FindGagRange(const string &ip)
{
	unsigned long ipnum = cBanList::Ip2Num(ip);
	iterator it;
 	cGagRange *CurGagRange  = NULL;
	
	cGagRange Sample;
	int Pos = 0;
	
	Sample.mIPMin = ipnum;
	// find the closest bigger or equal item
	//cout << "Searching: " << Sample.mIPMin << endl;
	CurGagRange  = this->FindDataPosition(Sample, Pos);
	//cout << "Position : " << Pos << (CurGagRange?"eq":"ne") <<endl;
	// if it was not equal, but there is one smaller
	if (!CurGagRange && Pos) CurGagRange = this->GetDataAtOrder(Pos -1);
	// verify it
	if (CurGagRange && (CurGagRange->mIPMax >= ipnum)) return CurGagRange;
	//if (CurGagRange) cout << "Didn't match " << CurGagRange->mIPMax << " to " << ipnum << endl;
	// none found by ip range, try the cc
	return NULL; // there is not 0..xx GagRange
}

int cGagRanges::OrderTwoItems(const cGagRange &D1, const cGagRange &D2)
{
	if(D1.mIPMin < D2.mIPMin) return -1;
	if(D1.mIPMin > D2.mIPMin) return  1;
	return 0;
}
		
bool cGagRanges::CompareDataKey(const cGagRange &D1, const cGagRange &D2)
{
	return D1.mIPMin == D2.mIPMin;
}

