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
}

collector::~collector()
{

}

bool collector::trigger()
{
        printf(hardware_monitor::get_instance()->collect_data());
        printf(process_monitor::get_instance()->collect_data());
}
