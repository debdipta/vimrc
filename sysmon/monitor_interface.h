#ifndef __MONITOR_INTERFACE__
#define __MONITOR_INTERFACE__

#include "common.h"

class monitor_interface
{
public:
    virtual const char* collect_data() = 0;
    virtual ~monitor_interface(){};
};

#endif
