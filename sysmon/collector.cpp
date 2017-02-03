#include "collector.h"
#include "common.h"
#include "hardware_monitor.h"
#include "process_monitor.h"

collector::collector()
{
#ifdef MTIME
    timer = MTIME;
#else
    timer = 60;
#endif
    register_monitors();
}

collector::~collector()
{

}

bool collector::register_monitors()
{
    monitors.push_back(hardware_monitor::get_instance());
    monitors.push_back(process_monitor::get_instance());
}


bool collector::trigger()
{
    std::list<monitor_interface*>::iterator _monitor;
    for( _monitor = monitors.begin();_monitor != monitors.end(); _monitor++)    {
        printf("%s", (*_monitor)->collect_data());
    }
}
