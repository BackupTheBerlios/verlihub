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
#ifndef NFORBIDCCONSOLE_H
#define NFORBIDCCONSOLE_H

#ifdef HAVE_CONFIG_H
#include <config.h>
#endif

#include <verlihub/tlistconsole.h>
#include "cgagranges.h"

class cpiGagRange;
using namespace nCmdr;

namespace nDirectConnect { class cConnDC; };
using namespace nDirectConnect;

typedef class tListConsole<cGagRange, cGagRanges, cpiGagRange> tGagRangeConsoleBase;
/**
a console that parses commands

@author Daniel Muller
*/
class cGagRangeConsole : public tGagRangeConsoleBase
{
public:
	cGagRangeConsole(cVHPlugin *pi) : tGagRangeConsoleBase(pi)
	{
		AddCommands();
	}

	virtual ~cGagRangeConsole();
	virtual const char *GetParamsRegex(int cmd);
	virtual const char *CmdSuffix();
	virtual const char *CmdPrefix();
	virtual cGagRanges *GetTheList();
	virtual bool ReadDataFromCmd(cfBase *cmd, int CmdID, cGagRange &data);
	virtual void GetHelpForCommand(int cmd, ostream &os);
};

#endif
