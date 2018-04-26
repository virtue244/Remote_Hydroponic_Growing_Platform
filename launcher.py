from RHGP import RHGP

planter = RHGP()

if (planter.testSystem()):
    planter.startSystem()

planter.pinCleanUp()
