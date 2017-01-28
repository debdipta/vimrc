CC=g++
CFLAGS=-g -c 
LDFLAGS=
DEBUG_FLAGS=-D$(debug_level)

SOURCES=logger.cpp monitord.cpp collector.cpp hardware_monitor.cpp cpu_monitor.cpp io_monitor.cpp
OBJECTS=$(SOURCES:.cpp=.o)
EXECUTABLE=monitord

all: $(SOURCES) $(EXECUTABLE)

$(EXECUTABLE): $(OBJECTS)
	$(CC) $(LDFLAGS) $(OBJECTS) -o $@

.cpp.o:
	$(CC) $(CFLAGS) $(DEBUG_FLAGS) $< -o $@
clean:
	rm -rf *.o $(EXECUTABLE) 

