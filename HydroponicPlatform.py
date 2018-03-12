class HydroponicPlatform:

    uvExposure = 0
    fertInterval = 0
    
    def __init__(self, uv, fert):
        self.uvExposure = uv
        self.fertInterval = fert

    def senseToTurnOnPump(self, moistureValue):
        if moistureValue <= 10:
            #Turn pump on or keep pump on
            return 1
        else:
            #shut off pump or keep pump off
            return 0
        

    def flipTowerLight(self, curInput):
        #setting light pin output to 1
        if curInput == 1:
            return 0
        elif curInput == 0:
            return 1
        else:
            return 2


x = HydroponicPlatform(2, 30)
print x.uvExposure
print x.fertInterval

print "\nTest 1"

#Test number 2.2.2 - 1
print x.senseToTurnOnPump(9) #returns 1
print x.senseToTurnOnPump(11) #returns 0

print "\nTest 2"

#Test number 2.2.2 - 2
print x.flipTowerLight(1) #returns 0
print x.flipTowerLight(0) #returns 1
