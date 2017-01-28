#include "io_monitor.h"
#include <stdio.h>

io_monitor::io_monitor(const char* _name)
{
    name = _name;
}

io_monitor::~io_monitor()
{
}

char* io_monitor::collect_data()
{
    return NULL;
}

bool io_monitor::update_data( char* _data )
{
    return true;
}
