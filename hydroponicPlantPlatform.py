#
# Software created by Drew Davis and Dylan Victory
# December 2017
#

# This software allows the monitoring and control of a hydroponic plant platform
# It utilizes a grove sunlight sensor, as well as moisture sensors to achieve this
# A simple UI allows the user to choose the sunlight level/time between fertilizations they would like.
# The moisture sensors are monitoring the moisture level in the platform every 15 minutes
# This determines when to activate a power tail switch connected to a water pump, which will pump water.
# The sunlight sensor determines when to activate the light, based on how much light the user wants
# the plant to have.

from Tkinter import *
from datetime import datetime
import time
import thread
import SI1145
import RPi.GPIO as GPIO

keepRunning = False

dayOfWeek = datetime.now().weekday()
fertCounter = 0

# Utilizes two global variables for the purpose of checking when it is the day
# a fertilization needs to be done. Checks the integer value of the current day
# to see if it has changed to a new day. Counter is incremented to account for
# new day. Once counter is equal to the days between fertilizations set, fertilize.
# Set counter back to 0 to restart counter
def fertCheck():
    global dayOfWeek
    global fertCounter

    
    
    if datetime.now().weekday() != dayOfWeek:
        fertCounter += 1
        dayOfWeek = datetime.now().weekday()

    if fertCounter == int(e2.get()):
        print "FERTILIZE!FERTILIZE!FERTILIZE!FERTILIZE!FERTILIZE!"
        GPIO.output(fertPower_pin, True)
        time.sleep(15)
        GPIO.output(fertPower_pin, False)
        fertCounter = 0
    
# Utilize an if else statement to check if the input is high or low. If high, indicates
# that moisture levels are low. Activates the water pump through the power switch tail.
# Waters for 15 seconds before shutting off the pump. Else it just continues and makes sure
# pump is shut off.
def detectMoisture():
    if GPIO.input(moisturePinInput):
            print "Water needed for plant"
            GPIO.output(pumpPower_pin, True)
            time.sleep(15)
            GPIO.output(pumpPower_pin, False)
    else:
        print "Water levels acceptable"
        GPIO.output(pumpPower_pin, False)

# Get infrared light reading from sunlight sensor, print out value. Check to see if the time
# is between 8AM and 6PM. If it is, check to see what value was provided for sunlight value
# by user. Set desired light level to user defined level. Run a check to see if the infrared
# light level from sensor is less than user defined level. Turn light on if it is. If not, make
# sure light is off.
def detectSunlight():
    IR = sensor.readIR()
    print('IR:              ' + str(IR))

    if datetime.now().hour >= 8 or datetime.now().hour < 18:
        if tkvar.get() == 'Full Sun':
            print '800 Lumens'
            lumenLevel = 800
        elif tkvar.get() == 'Partial Sun':
            print '500 Lumens'
            lumenLevel = 500
        elif tkvar.get() == 'Shaded':
            print '250 Lumens'
            lumenLevel = 250

        if IR < lumenLevel:
            GPIO.output(lightPower_pin, True)
            print 'Light turned on'
        else:
            GPIO.output(lightPower_pin, False)

# Main loop
def run_scheduler():
    global keepRunning
    keepRunning = True
    e1.config(state="disabled")
    e2.config(state="disabled")
    startButton.config(state="disabled")
    stopButton.config(state="active")
    quitButton.config(state="disabled")
    
    #SCHEDULER LOOP
    while keepRunning:
        try: 
            fertCheck()
            detectMoisture()
        except:
            GPIO.output(pumpPower_pin, False)
            GPIO.output(fertPower_pin, False)
            print "Malfunction, turning off pumps for safety."

        detectSunlight()
        time.sleep(900)
        
        
        
# Stops main loop, deactivates all pins to shut off power to pumps and light
def stop_scheduler():
    global keepRunning
    keepRunning = False
    print "Feeder Stopped"
    e1.config(state="active")
    e2.config(state="normal")
    startButton.config(state="active")
    stopButton.config(state="disabled")
    quitButton.config(state="active")
    GPIO.output(pumpPower_pin, False)
    GPIO.output(lightPower_pin, False)
    GPIO.output(fertPower_pin, False)

# Starts main loop    
def start_scheduler():
    thread.start_new_thread(run_scheduler, ())

sensor = SI1145.SI1145()
GPIO.setmode(GPIO.BCM)

moisturePinInput = 17
pumpPower_pin = 27
lightPower_pin = 22
fertPower_pin = 23


GPIO.setup(moisturePinInput, GPIO.IN)

GPIO.setup(pumpPower_pin, GPIO.OUT)
GPIO.setup(lightPower_pin, GPIO.OUT)
GPIO.setup(fertPower_pin, GPIO.OUT)

GPIO.output(pumpPower_pin, False)
GPIO.output(lightPower_pin, False)
GPIO.output(fertPower_pin, False)

master = Tk()
master.title("Pet Feeder")
Label(master, text="Daily UV Dose (Lumens)").grid(row = 0)
Label(master, text="Fertilizer Interval (Days)").grid(row = 1)

tkvar = StringVar(master)
options = {'Full Sun', 'Partial Sun', 'Shaded'}
tkvar.set('Shaded')

e1 = OptionMenu(master, tkvar, *options)
e1.grid(row = 0, column = 1)

e2 = Entry(master)
e2.grid(row = 1, column = 1)

startButton = Button(master, text="Start", command = start_scheduler)
startButton.grid(row = 3, column = 0)

quitButton = Button(master, text="Quit", command = master.destroy)
quitButton.grid(row = 3, column = 1)

stopButton = Button(master, text="Stop", command = stop_scheduler)
stopButton.grid(row = 4, column = 0)
stopButton.config(state="disabled")

master.mainloop()

