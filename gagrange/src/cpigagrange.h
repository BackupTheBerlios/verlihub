#ifndef CPIGR_H
#define CPIGR_H

#include <verlihub/tlistplugin.h>
#include "cgagranges.h"
#include "cconsole.h"

using namespace nDirectConnect;
using namespace nDirectConnect::nPlugin;

typedef tpiListPlugin<cGagRanges,cGagRangeConsole> tpiGagRangeBase;

class cpiGagRange : public tpiGagRangeBase
{
public:
	cpiGagRange();
	virtual ~cpiGagRange();
	virtual void OnLoad(cServerDC *server);

	virtual bool RegisterAll();
	virtual bool OnUserLogin(cUser *);
	virtual bool OnOperatorCommand(cConnDC *conn, string *str);
cGagRangeCfg *mCfg;
};

#endif
