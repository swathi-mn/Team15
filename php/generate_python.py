import smtplib
import string
import random
password = ''.join(random.choice(string.ascii_lowercase) for x in range(8));

f = open("email.txt")
reciever = f.read().strip()

gmail_user = 'instasound.help@gmail.com'
gmail_pwd = "instapassword"
FROM = 'InstaSound'
TO = [reciever] #must be a list
SUBJECT = "Thank you for contacting support."
TEXT = "Your new password is: " + password + '\n\n\nThis is an auto generated email. Please do not reply.'
# Prepare actual message
message = """\From: %s\nTo: %s\nSubject: %s\n\n%s
    """ % (FROM, ", ".join(TO), SUBJECT, TEXT)
try:
	server = smtplib.SMTP("smtp.gmail.com", 587) 
	server.ehlo()
	server.starttls()
	server.login(gmail_user, gmail_pwd)
	for i in TO:
		server.sendmail(FROM, i, message)
	server.close()
	print(password)
except:
    print("")

