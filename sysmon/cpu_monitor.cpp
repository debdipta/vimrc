#include "cpu_monitor.h"
#include <stdio.h>

cpu_monitor::cpu_monitor(const char* _name)
{
    name = _name;
    hardware_monitor::get_instance()->register_monitors(this);
}

cpu_monitor::~cpu_monitor()
{
}

char* cpu_monitor::collect_data()
{
    return "CPU Usage 30%\n";
}
