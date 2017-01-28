#ifndef __COLLECTOR__
#define __COLLECTOR__

class collector
{
    int timer; //In secs

public:
    collector();
    ~collector();
    bool trigger();
};

#endif
