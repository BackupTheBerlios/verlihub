#ifdef HAVE_CONFIG_H
#include <config.h>
#endif
#include "cpigagrange.h"
#include <stringutils.h>

using namespace nStringUtils;
using namespace nDirectConnect::nProtocol::nEnums;

cpiGagRange::cpiGagRange()
{
	mName = "GagRange";
	mVersion = VERSION;
	mCfg= NULL;
}

void cpiGagRange::OnLoad(cServerDC *server)
{
	if (!mCfg) mCfg = new cGagRangeCfg(server);
	mCfg->Load();
	mCfg->Save();
	tpiGagRangeBase::OnLoad(server);
}

cpiGagRange::~cpiGagRange() {
	if (mCfg != NULL) delete mCfg;
	mCfg = NULL;
}

bool cpiGagRange::RegisterAll()
{
	RegisterCallBack("VH_OnUserLogin");
	RegisterCallBack("VH_OnOperatorCommand");
}

bool cpiGagRange::OnOperatorCommand(cConnDC *conn, string *str)
{
	if( mConsole.DoCommand(*str, conn) ) return false;
	return true;
}


bool cpiGagRange::OnUserLogin(cUser *user) 
{ 
	cGagRange *range;
	if (user && user->mxConn && !user->mClass)
	{
		range = mList->FindGagRange(user->mxConn->AddrIP());
		if (range) {
			user->SetRight(eUR_CHAT,range->mUntil,false);
		}
	}
	return true;
}

REGISTER_PLUGIN(cpiGagRange);

