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
#include <config.h>
#include <verlihub/cconndc.h>
#include "cconsole.h"
#include "cpigagrange.h"
#include "cgagranges.h"

using namespace nDirectConnect;


cGagRanges *cGagRangeConsole::GetTheList()
{
	return mOwner->mList;
}

const char *cGagRangeConsole::CmdSuffix()
{
	return "gagrange";
}

const char *cGagRangeConsole::CmdPrefix()
{
	return "!";
}

void cGagRangeConsole::GetHelpForCommand(int cmd, ostream &os)
{
	string help_str;
	switch(cmd)
	{
		case eLC_LST: 
		help_str = "!lstgagrange\r\nGive a list of GagRanges"; 
		break;
		case eLC_ADD: 
		case eLC_MOD:
		help_str = "!(add|mod)gagrange <iprange>"
			"[ -N<\"name\">]"
			"[ -CC<country_codes>]"
			"[ -n<nick_pattern>]"
			"[ -d(<\"desc_tag\">]"
			"[ -c<conn_type>]"
			"[ -g<share_guest>]"
			"[ -r<share_reg>]"
			"[ -v<share_vip>]"
			"[ -o<share_op>]"
			"[ -G<max_share_guest>]"
			"[ -R<max_share_reg>]"
			"[ -V<max_share_vip>]"
			"[ -O<max_share_op>]";
		break;
		case eLC_DEL:
		help_str = "!delgagrange <iprange>"; break;
		default: break;
	}
	cDCProto::EscapeChars(help_str,help_str);
	os << help_str;
}

const char * cGagRangeConsole::GetParamsRegex(int cmd)
{
	switch(cmd)
	{
		case eLC_ADD:
		case eLC_MOD:	
			return "(\\S+)" // <iprange>
			      ; break;
		case eLC_DEL: return "(\\S+)"; break;
		default : return ""; break;
	};
}

bool cGagRangeConsole::ReadDataFromCmd(cfBase *cmd, int id, cGagRange &data)
{
	/// regex parts for add command
	enum {eADD_ALL, eADD_RANGE};
	if (!cmd->GetParIPRange(eADD_ALL, data.mIPMin, data.mIPMax))
	{
		*(cmd->mOS) << "Unknown range format";
		return false;
	}

	return true;	
}

cGagRangeConsole::~cGagRangeConsole(){}

