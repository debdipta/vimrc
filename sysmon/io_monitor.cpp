#include "io_monitor.h"
#include <stdio.h>
#include "hardware_monitor.h"

io_monitor::io_monitor(const char* _name)
{
    name = _name;
    hardware_monitor::get_instance()->register_monitors(this);
}

io_monitor::~io_monitor()
{
}

char* io_monitor::collect_data()
{
    return "IO Usage 20%\n";
}

bool io_monitor::update_data( char* _data )
{
    return true;
}
