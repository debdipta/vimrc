
from sys import argv

script, file_to_read = argv

print "Hellow World!!!\n"
print "Welcome to python...!!"

print "Debdipta Salary: ", 10*5+2
print "rajatSalary: 10*5+2", 10*5+2
print 10+2/1
print 10 - 3 < 4+8
print 10 > 5
print 10 <= -2

cars = 100
drivers = 10
cars_not_driven = cars - drivers
print "cars not driven=", cars_not_driven

my_name = 'Debdipta Ghosh'
my_dob = '28dec 1988'
my_height = 650
my_eye = 'brown'
print "My Name is %s " % my_name
print "My dob is %s " % my_dob
print "I have a height of %s inches" % my_height
print "I have a %s colored eye" % my_eye
print "HI, I an %s with height of %d and dob is %s" % (my_name , my_height, my_dob)
print "I saib %r" % my_name

y = raw_input("Name? ")
print "Input: %s" % y

def func_all(*args):
    arg1, arg2 = args
    print "arg1=%s arg2=%s" %(arg1, arg2)

def func_two(arg1, arg2):
    print "arg1=%s arg2=%s" %(arg1, arg2)

def func_no():
    print "I have no arguments"


func_all("Debd", "Soumyo")
func_two("rock", "achs")
func_no()

print "*******************"
def print_whole_file(file_data):
    print file_data.read()

def rewind(f):
    f.seek(0)

print "Going to read file %s" % file_to_read
file_data = open(file_to_read)
print "printing the whole file"
print_whole_file(file_data)
print "REwinding the file"
rewind(file_data)

print"********************"
print "Learning array in python"
the_count = [1, 2,3,4,5]
my_names = ['Debdipta', 'Yash', 'Sanjay'];
all_in_one = [1, 'test', 2, 'love', 3, 'debug']

for count in the_count:
    print " %d" % count

for count in all_in_one:
    print " %r " % count

elements = []
for i in range(0, 6):
    print "Adding %d in elenemt" % i
    elements.append(i)

class Myclass(object):
    def __init__(self):
        self.name = "debdipta learning python"
    def apple(self):
        print "This is best apple"

thing = Myclass()
thing.apple()
print thing.name

class song(object):
    def __init__(self, lyrics):
        self.lyrics = lyrics
    def sing_now(self):
        for line in self.lyrics:
            print(line)

happy_song = song(['I am so happy today',
                    'Let\'s have a drink'])
sad_song = song(['Iss dard e dil ka kya jano',
                    'payaar ka tamanna'])

happy_song.sing_now()
sad_song.sing_now()


