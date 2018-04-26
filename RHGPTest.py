import unittest
import time
from RHGP import RHGP

class RHGPTest (unittest.TestCase):
    
    def setUp(self):
        # uvExposure set to an index of 10 
        # fertInterval set to 30 days
        self.x = RHGP()

    def test_requestData_ValidProductID(self):
        self.assertTrue(self.x.requestData('456789'))

    def test_requestData_InvalidProductID(self):
        self.assertFalse(self.x.requestData('159753'))

    def test_requestData_alteredData(self):
        self.assertTrue(self.x.uvX != 30 and self.x.fertInt != 'Medium')

    def test_detectSunlight(self):
        self.assertTrue((str(self.x.detectSunlight())).isdigit())

    def test_assureLight_Maintained(self):
        time.sleep(1)
        y = self.x.assureLight(800, 'High')
        self.assertTrue(True if y == 2 else False)
        time.sleep(1)

    def test_assureLight_TurnedOff(self):
        time.sleep(1)
        y = self.x.assureLight(1000, 'High')
        self.assertTrue(True if y == 1 else False)
        time.sleep(1)

    def test_assureLight_TurnedOn(self):
        time.sleep(1)
        y = self.x.assureLight(500, 'High')
        self.assertTrue(True if y == 0 else False)
        time.sleep(1)

    def test_detectMoisture(self):
        self.assertTrue((str(self.x.detectMoisture())).isdigit())

    def test_assureWatering_Watered(self):
        time.sleep(1)
        y = self.x.assureWatering(1)
        self.assertTrue(True if y == 0 else False)
        time.sleep(1)

    def test_assureWatering_NotWatered(self):
        time.sleep(1)
        y = self.x.assureWatering(0)
        self.assertTrue(True if y == 1 else False)
        time.sleep(1)

    def test_detectFert_Ferted(self):
        time.sleep(1)
        y = self.x.detectFert(23, 0)
        self.assertTrue(True if y == 0 else False)
        time.sleep(1)

    def test_detectFert_NotFerted(self):
        time.sleep(1)
        y = self.x.detectFert(1, 29)
        self.assertTrue(True if y == 1 else False)
        time.sleep(1)
            
    def test_pinCleanup(self):
        self.assertTrue(self.x.pinCleanUp())    
    
    
    
    

suite = unittest.TestLoader().loadTestsFromTestCase(RHGPTest)
unittest.TextTestRunner(verbosity=2).run(suite)
