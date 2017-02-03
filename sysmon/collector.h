#ifndef __COLLECTOR__
#define __COLLECTOR__

#include <stdio.h>
#include <iostream>
#include <list>
#include "monitor_interface.h"

class collector
{
    int timer; //In secs
    std::list<monitor_interface*> monitors;
    bool register_monitors();
public:
    collector();
    ~collector();
    bool trigger();
};

#endif
