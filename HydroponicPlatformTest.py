import unittest
from HydroponicPlatform import HydroponicPlatform

class HydroponicPlatformTest (unittest.TestCase):

    
    def setUp(self):
        x = HydroponicPlatform(2, 30)
    
    def test_senseToTurnOnPumpCheck(self):
        #x = HydroponicPlatform(2, 30)
        print x.senseToTurnOnPump(9) #returns 1
        print x.senseToTurnOnPump(11) #returns 0
        #self.assertEqual()

if __name__ =='__main__':
    unittest.main()
