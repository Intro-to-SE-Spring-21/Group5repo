import mysql.connector
import tkinter as tk
from tkinter import ttk

window = tk.Tk()
window.title("Python Tkinter Text Box")
window.minsize(600, 400)

db = mysql.connector.connect(
    host="localhost",
    user="jackson",
    password="password",
    database="mydatabase"
)

mycursor = db.cursor()
#sql = "CREATE DATABASE mydatabase"
#val = ("John", "Highway 21")
#mycursor.execute("CREATE TABLE tweets (tweet_text VARCHAR(255), username VARCHAR(255))")

# mycursor.execute("SHOW TABLES")
# for x in mycursor:
#   print(x)


db.commit()
print(mycursor.rowcount, "record inserted.")

def registerSubmit():
    label_firstname.configure(text=firstname.get())
    label_lastname.configure(text=lastname.get())
    label_username.configure(text=username.get())
    sql = "INSERT INTO users (username, firstname, lastname) VALUES (%s, %s, %s)"
    val = (username.get(), firstname.get(), lastname.get())
    mycursor.execute(sql, val)
    mycursor.execute("SELECT * FROM users")
    myresult = mycursor.fetchall()
    print("Current Table Data:")
    for x in myresult:
        print(x)


def postTweet():
    print(tweet.get())
    sql = "INSERT INTO tweets (tweet_text, username) VALUES (%s, %s)"
    val = (username.get(), tweet.get())
    mycursor.execute(sql, val)
    mycursor.execute("SELECT * FROM tweets")
    myresult = mycursor.fetchall()

ttk.Label(window, width=15, text="-- Register --").grid(column=0, row=0)
ttk.Label(window, width=15, text="---------------").grid(column=1, row=0)

label_firstname = ttk.Label(window, text="Firstname:")
label_firstname.grid(column=0, row=1)
label_lastname = ttk.Label(window, text="Lastname:")
label_lastname.grid(column=0, row=2)
label_username = ttk.Label(window, text="Username:")
label_username.grid(column=0, row=3)

firstname = tk.StringVar()
lastname = tk.StringVar()
username = tk.StringVar()

firstnameEntered = ttk.Entry(window, width=15, textvariable=firstname)
firstnameEntered.grid(column=1, row=1)
lastnameEntered = ttk.Entry(window, width=15, textvariable=lastname)
lastnameEntered.grid(column=1, row=2)
usernameEntered = ttk.Entry(window, width=15, textvariable=username)
usernameEntered.grid(column=1, row=3)

button = ttk.Button(window, text="Register", command=registerSubmit)
button.grid(column=0, row=4)

ttk.Label(window, width=15, text="-- Post Tweet --").grid(column=0, row=5)
ttk.Label(window, width=15, text="---------------").grid(column=1, row=5)

tweet = tk.StringVar()
tweetEntry = ttk.Entry(window, width=15, textvariable=tweet)
tweetEntry.grid(column=0, row=6)
tweetSubmit = ttk.Button(window, text="Send", command=postTweet)
tweetSubmit.grid(column=1, row=6)


window.mainloop()