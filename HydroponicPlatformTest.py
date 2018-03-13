import unittest
from HydroponicPlatform import HydroponicPlatform

class HydroponicPlatformTest (unittest.TestCase):
    
    def setUp(self):
        # uvExposure set to an index of 10 
        # fertInterval set to 30 days
        self.x = HydroponicPlatform(10, 30)

    #Test number 2.2.2 - 1
    def test_senseToFlipPumpOn(self):
        self.assertTrue(self.x.senseToFlipPump(99))

    def test_senseToFlipPumpOff(self):
        self.assertFalse(self.x.senseToFlipPump(101))

    #Test number 2.2.2 - 2
    def test_flipTowerLightOn(self):
        self.assertTrue(self.x.flipTowerLight(0))

    def test_flipTowerLightOff(self):
        self.assertTrue(self.x.flipTowerLight(0))

    #Test number 2.2.2 - 3
    def test_senseToAdjustLightUp(self):
        self.assertFalse(self.x.senseToAdjustLight(10))

    def test_senseToAdjustLightDown(self):
        self.assertTrue(self.x.senseToAdjustLight(3))

    #Test number 2.2.2 - 4
    def test_checkForFertPast(self):
        self.assertTrue(self.x.checkForFert(30, self.x.fertInterval))

    def test_checkForFertBefore(self):
        self.assertFalse(self.x.checkForFert(29, self.x.fertInterval))
    
    
    
    
    
    

suite = unittest.TestLoader().loadTestsFromTestCase(HydroponicPlatformTest)
unittest.TextTestRunner(verbosity=2).run(suite)
