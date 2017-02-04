#ifndef __LINUX_CPU_MONITOR__
#define __LINUX_CPU_MONITOR__
#include "../monitor_interface.h"
class linux_cpu_monitor : public monitor_interface
{

public:
    linux_cpu_monitor();
    ~linux_cpu_monitor();

    int get_cpu_number();
    char* collect_data();
};

#endif
