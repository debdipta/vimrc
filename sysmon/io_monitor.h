#ifndef __IO_MONITOR__
#define __IO_MONITOR__

#include "monitor_interface.h"

class io_monitor: public monitor_interface
{
    const char* name;
public:
    io_monitor(const char*);
    ~io_monitor();
    char* collect_data();
    bool update_data( char* );
};
#endif
