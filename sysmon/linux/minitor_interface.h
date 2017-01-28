#ifndef __MONITOR_INTERFACE__
#define __MONITOR_INTERFACE__

#include "common.h"

class monitor_interface
{

public:
    virtual char* collect_data() = 0;
    virtual bool send_data( char* ) = 0;
};

#endif
