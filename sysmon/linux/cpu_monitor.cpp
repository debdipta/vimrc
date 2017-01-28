#include "cpu_monitor.h"
#include <stdio.h>

cpu_monitor::cpu_monitor(const char* _name)
{
    name = _name;
}

cpu_monitor::~cpu_monitor()
{
}

char* cpu_monitor::collect_data()
{
    return NULL;
}

bool cpu_monitor::update_data( char* _data )
{
    return true;
}
