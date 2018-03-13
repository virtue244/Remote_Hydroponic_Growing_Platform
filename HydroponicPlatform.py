class HydroponicPlatform:
    
    def __init__(self, uv, fert):
        self.uvExposure = uv
        self.fertInterval = fert

    def senseToFlipPump(self, moistureValue):
        if moistureValue <= 100:
            #Turn pump on or keep pump on
            return 1
        else:
            #shut off pump or keep pump off
            return 0

    def flipTowerLight(self, curInput):
        #setting light pin output to 1
        if curInput == 1:
            return 0
        else:
            return 1

    def senseToAdjustLight(self, lightValue):
        if lightValue >= 10:
            return 0
        else:
            return 1
        
    def checkForFert(self, daysPassed, fertInterval):
        if daysPassed >= fertInterval:
            return 1
        else:
            return 0

