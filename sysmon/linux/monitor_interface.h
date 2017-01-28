#ifndef __MONITOR_INTERFACE__
#define __MONITOR_INTERFACE__

#include "common.h"

class monitor_interface
{
public:
    virtual bool update_data( char* ) = 0;
};

#endif
