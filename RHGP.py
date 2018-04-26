from datetime import datetime
import time
import thread
import SI1145
import RPi.GPIO as GPIO
import MySQLdb
import socket

lightSensor = SI1145.SI1145()
GPIO.setmode(GPIO.BCM)

moistureSensor = 4
    
lightPower = 17
waterPumpPower = 27
fertPumpPower = 22

GPIO.setup(moistureSensor, GPIO.IN)

GPIO.setup(lightPower, GPIO.OUT)
GPIO.setup(waterPumpPower, GPIO.OUT)
GPIO.setup(fertPumpPower, GPIO.OUT)

GPIO.output(lightPower, GPIO.HIGH)
GPIO.output(waterPumpPower, GPIO.HIGH)
GPIO.output(fertPumpPower, GPIO.HIGH)

dayOfWeek = datetime.now().weekday()
product_id = '456789'

class RHGP:
    
    def __init__(self):
        self.uvX = 'Medium'
        self.fertInt = 30
        self.timeLeft = self.fertInt
        self.timeBefore = datetime.now().hour
        self.timeAfter = datetime.now().hour

    '''
    Request Data from server DB
    '''
    def requestData(self, product_id):
        #global product_id

        try:
            ''' Create connection object '''
            clientSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

            #host = 'feedingfree.online'
            #host = '10.0.0.244' #testing IP
            host = '69.88.163.49'
            port = 6000
            ''' Connect to host at port number '''
            clientSocket.connect((host, port))
            ''' Identify self '''
            clientSocket.send(product_id)
            ''' Collect & Store data for later '''
            self.uvX, self.fertInt = clientSocket.recv(100).split(",")
            ''' Close connection '''
            clientSocket.close()
            return True

        except:
            #print("Connection Failed")
            ''' Close connection '''
            clientSocket.close()
            return False
            
    
    '''
    Detect sunlight sensor input
    '''
    def detectSunlight(self):
        try:
            IR = lightSensor.readIR()
            print('IR: ' + str(IR))
            return (IR)
        except:
            #print("GrovePi Sunlight Sensor Detached")
            return ("GrovePi Sunlight Sensor Detached")

    def assureLight(self, sensorValue, uvExposure):
        if datetime.now().hour >= 8 or datetime.now().hour < 18:
            if uvExposure == 'High':
                lumenLevel = 800
            elif uvExposure == 'Medium':
                lumenLevel = 500
            elif uvExposure == 'Low':
                lumenLevel = 250
                
        #if detectSunlight fails but is caught then it will later fail here
        if sensorValue < lumenLevel:
            GPIO.output(lightPower, GPIO.LOW)
            print ("Light turned on")
            return 0 # light turned on
        else:
            if(sensorValue > (lumenLevel + 200)): #needs testing with real sunlight
                GPIO.output(lightPower, GPIO.HIGH)
                print ("Light levels acceptable")
                return 1 # light turned off
            else:
                GPIO.output(lightPower, GPIO.LOW)
                print ("Maintaining light")
                return 2 # light staying on

                
    def detectMoisture(self):
        try:
            return GPIO.input(moistureSensor)
        except:
            return False
    
    '''
    Detect moisture sensor input
    '''
    def assureWatering(self, sensorValue):
            if (sensorValue):
                print ("Turning on Water Pump")
                GPIO.output(waterPumpPower, GPIO.LOW)
                time.sleep(15) #set to 3 for testing, should be 15 for actual watering time
                GPIO.output(waterPumpPower, GPIO.HIGH)
                print ("Water Pump Off")
                return 0
            else:
                print ("Water levels acceptable")
                GPIO.output(waterPumpPower, GPIO.HIGH)
                return 1

    '''
    Detect if needs fertilizing
    '''
    def detectFert(self, tAfter, daysLeft):
        
        if (daysLeft == 0):
            print ("Turning on Fertilizer Pump")
            GPIO.output(fertPumpPower, GPIO.LOW)
            time.sleep(15)
            GPIO.output(fertPumpPower, GPIO.HIGH)
            print ("Fertilizer Pump Off")
            self.timeLeft == self.fertInt
            return 0 # fertilized
        else:
            print("Not ready to fert!")
            return 1 # not fertilized
            
        if (tAfter < self.timeBefore):
            self.timeLeft = self.timeBefore - 1

        self.timeBefore = tAfter
        

    '''
    Test light power switch
    '''
    def lightTest(self):
        try:
            GPIO.output(lightPower, GPIO.LOW)
            time.sleep(1)
            GPIO.output(lightPower, GPIO.HIGH)
            time.sleep(1)
            print("lightPower pin attached")
            return True
        except:
            print("lightPower pin detached")
            return False

    '''
    Test water pump power switch
    '''
    def waterPumpTest(self):
        try:
            GPIO.output(waterPumpPower, GPIO.LOW)
            time.sleep(1)
            GPIO.output(waterPumpPower, GPIO.HIGH)
            time.sleep(1)
            print("waterPumpPower pin attached")
            return True
        except:
            print("waterPumpPower pin detached")
            return False

    '''
    Test fertilizer pump power switch
    '''
    def fertPumpTest(self):
        try:
            GPIO.output(fertPumpPower, GPIO.LOW)
            time.sleep(1)
            GPIO.output(fertPumpPower, GPIO.HIGH)
            time.sleep(1)
            print("fertPumpPower pin attached")
            return True
        except:
            print("fertPumpPower pin detached")
            return False
            
    '''
    GPIO pin cleanup before exiting program
    '''
    def pinCleanUp(self):
        try:
            GPIO.cleanup()
            return True
        except:
            return False

    '''
    Developer testing method
    '''
    def displayUVandFertInt(self):
        print('UV level desired: ' + str(self.uvX))
        print('Days between ferting: ' + str(self.fertInt))
        #print('Days until ferting: ' + str(self.timeLeft))

    def testSystem(self):
        start_time = time.time()
        x = self.lightTest() and self.waterPumpTest() and self.fertPumpTest()
        print ("testSystem() -> " + str(time.time() - start_time) + " seconds\n")
        return (x)
        
    def startSystem(self):
        global product_id
        '''
        start_time = time.time()
        self.requestData(product_id)
        print ("requestData(product_id) -> " + str(time.time() - start_time) + " seconds\n")
        self.timeLeft = self.fertInt
        '''
        while True:
            start_time = time.time()
            self.requestData(product_id)
            print ("requestData(product_id) -> " + str(time.time() - start_time) + " seconds\n")
            self.displayUVandFertInt()
            
            print("------------------")
            start_time = time.time()
            self.assureLight(self.detectSunlight(), self.uvX)
            print ("assureLight(light sensed, light needed) -> " + str(time.time() - start_time) + " seconds\n")
            
            #detect for fertilizing
            start_time = time.time()
            self.detectFert(datetime.now().hour, self.timeLeft)
            print ("detectFert(timeNow, daysTillFertilizing) -> " + str(time.time() - start_time) + " seconds\n")

            start_time = time.time()
            self.assureWatering(self.detectMoisture())
            print ("detectMoisture() -> " + str(time.time() - start_time) + " seconds\n")
            print("------------------")
            
            time.sleep(15)
        
        '''
        main loop
        update uvX and fertInterval from DB

        try:
            update days since last fertilizing
                if == to fertInterval, then make sure water pump is off and turn on fertilizer pump 

            detect moisture and respond
            
        except:
            Malfunction, turning off pumps for safety. Please check system for loose wires.
            
        detect sunlight and respond
        wait 900 seconds before next loop
        '''
        




    

    
    



