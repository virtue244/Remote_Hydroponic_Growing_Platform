#!/usr/bin/python
import MySQLdb
import socket
import RPi.GPIO as GPIO


GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

##print "Connecting to DB"
##db = MySQLdb.connect(host = "10.0.0.244",
##                   user = "dylan",
##                   passwd = "raspberry",
##                   db = "mydb")
##print "Sucessfuly connected to DB"
##print db
##c = db.cursor()
##c.execute("SELECT * FROM feed_now_table")
##
##arr = c.fetchone()
##x = arr[1]
##print x
##
##if(arr[1] != 1):
##    print "Equals one!"

#print socket.gethostbyname('www.ibm.com')
#print socket.gethostbyname('www.google.com')

'''Create and return a socket object
socket.socket(family, type)
family = ?
type = ?
'''
clientSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

host = 'feedingfree.online'
port = 6000

'''Connect the socket to the defined host and port
socketObject.connect( (adrs, port) )
adrs = ?
port = ?
'''
clientSocket.connect((host, port))
print "successfully connected"
clientSocket.send("Test Message 1\n")
#print clientSocket.recv(100)

clientSocket.close()

clientSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

clientSocket.connect((host, port))
#print "successfully connected again!!!"
clientSocket.send("Test Message 2\n")
#print clientSocket.recv(100)

clientSocket.close()

exitProg = 0
while exitProg == 0:
    clientSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

    clientSocket.connect((host, port))
    #print "successfully connected again!!!"
    words = raw_input("Message: ")
    #print words
    if (words == "exit"):
        exitProg = 1
    else:
        clientSocket.send(words)
        print clientSocket.recv(100)

    clientSocket.close()

    
