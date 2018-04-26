import socket
import MySQLdb

#establish DB connection
def connectToDB():
    db = MySQLdb.connect(host="localhost",  # hostname
                     user="root",          # username
                     passwd="Okmijn1029",    # password
                     db="mydb")             # name of the data base
    return db

'''
Create and return a socket object
socket.socket(family, type)
family = ?
type = ?
'''
serverSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

'''
Bind the socket to the address and port
socketObject.bind( (adrs, port) )
adrs = ?
port = ?
'''
serverSocket.bind(('', 6000))

'''
Place the socket into the listening state, able to pend
backlog outstanding connection requests
socketObject.listen(backlog)
backlog = ?
'''
serverSocket.listen(5)


'''
Return a client socket (with peet address information)
socketObject.accept()
'''
while 1:

    
    (clientSocket, address) = serverSocket.accept()
    word = clientSocket.recv(100)
    print word
    try:
        
        db = connectToDB()
        db.autocommit(True)

        c = db.cursor()
        sqlStatement = "select * from users where product_id = '" + word + "'"
        c.execute(sqlStatement)
        arr = c.fetchone()
        try:
            '''(uvX,fertInt)'''
            clientSocket.send(arr[3] + ',' + str(arr[4]))
        except:
            print("Failed to send message")
    except:
        clientSocket.send("Invalid Data")
        print("Invalid Data Recieved")
    clientSocket.close()
