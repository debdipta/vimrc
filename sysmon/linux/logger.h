#ifndef __LOGGER__
#define __LOGGER__

#include <stdio.h>

#define LOGMSG_SIZE 255

enum    {
    L1,
    L2,
    L3
};

#ifdef DEBUGL1 
#define LOG( _level, ...)   {    \
    do  {   \
        if( L1 == _level )  {       \
            logger::getInstance()->write_file("%s() : %d : %s\n",               \
                    __FUNCTION__,       \
                    __LINE__,      \
                    __VA_ARGS__); \
        }           \
    }while(0);    \
}
#endif

#ifdef DEBUGL2 
#define LOG(_level, ...)   {    \
    do  {   \
        if( L2 == _level )  {       \
            logger::getInstance()->write_file("%s() : %d : %s\n",               \
                    __FUNCTION__,       \
                    __LINE__,      \
                    __VA_ARGS__); \
        }           \
    }while(0);    \
}
#endif

#ifdef DEBUGL3 
#define LOG(_level, ...)   {    \
    do  {   \
        if( L3 == _level )  {       \
            logger::getInstance()->write_file("%s() : %d : %s\n",               \
                    __FUNCTION__,       \
                    __LINE__,      \
                    __VA_ARGS__); \
        }           \
    }while(0);    \
}
#endif

#ifndef DEBUGL1
#ifndef DEBUGL2
#ifndef DEBUGL3
#define _level
#define LOG(_level, ...)    {   \
    do  {   \
        logger::getInstance()->write_file("%s() : %d : %s\n",               \
                __FUNCTION__,__LINE__, __VA_ARGS__);       \
    }while(0);   \
}
#endif
#endif
#endif

class logger
{
    FILE *__fp_log = NULL;
    const char* __logpath;
    //Constructor
    /* Create log file with /tmp/logger/logger.log */
    logger(const char* );
    static logger* __instance;
    logger& operator=(const logger &_logger){};
    logger(const logger &_logger){};
public:
    ~logger();
    void write_file( const char* ,... );
    static logger* getInstance();
};

#endif
