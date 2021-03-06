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

#ifndef CSIPS_H
#define CSIPS_H

#include <string>
#include <verlihub/cconndc.h>
#include <verlihub/tlistplugin.h>

using namespace std;
using namespace nDirectConnect::nEnums;
using namespace nDirectConnect::nPlugin;

namespace nDirectConnect{ class cServerDC;};
using namespace nDirectConnect;

class cpiGagRange;
class cGagRanges;

class cGagRange
{
public:
	cGagRange();

	// -- stored data
	unsigned long mIPMin;
	unsigned long mIPMax;
	unsigned long mUntil;

	//-- methods
	cpiGagRange *mPI;
	virtual void OnLoad();
	friend ostream& operator << (ostream &, const cGagRange &gagrange);
};


class cGagRangeCfg : public cConfigBase
{
public:
	cGagRangeCfg(cServerDC *);
	int max_check_nick_class;
	int max_check_conn_class;
	int max_check_gagrange_class;
	int max_insert_desc_class;
	long unit_min_share_bytes;
	long unit_max_share_bytes;
	string msg_share_more;
	string msg_share_less;
	string msg_no_gagrange;
	bool allow_all_connections;
	bool case_sensitive_nick_pattern;

	cServerDC *mS;
	virtual int Load();
	virtual int Save();
};

typedef class tOrdList4Plugin<cGagRange, cpiGagRange> tGagRangeListBase;

class cGagRanges : public tGagRangeListBase
{
public:
	cGagRanges(cVHPlugin *pi);	
	virtual void AddFields();
	cGagRange *FindGagRange(const string &ip);
	virtual bool CompareDataKey(const cGagRange &D1, const cGagRange &D2);
	virtual int OrderTwoItems(const cGagRange &D1, const cGagRange &D2);
	virtual void OnLoadData(cGagRange &Data);
};

#endif//CSIPS_H
