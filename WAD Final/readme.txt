Files in the system:
Login.php
Register.php
admin.php
Booking.php
------------------------

Brief instructions on the system:


**Register.php**
- The user will enter their details into the field boxes to regiester an account with the taxi service
- if their email is already in the system they will be redirected to the login page
- when they are ready to submit they will press the Register button which will redirect them to the Booking the php page
- if they leave any fields empty they will get a "Please fill in all the fields warning"

*Login.php*
- the user will use their existing login to make a booking for themselves are another person
- if they don't have the correct details a "Combination of email and password is incorrect" warning will appear letting them know
  they have made a mistake
- if they end up on the login page and don't have an account, they can click the register link

** Booking Page**
- the email and user name of the account holder will transfer over to this page when someone is redirected to the booking page
- the details of the user entering the information will taken providing all the fields are entered besides street number or unit number
- if all the fields are correctly field out it will accept their booking
- if any fields are left out a " Please fill in all the blanks before you submit" warning will appear

**admin.php**
- this page will load
- the list all button will need to be pressed for the table to appear
- one the user sees the table, they can choose to update a status of the booking
- a notification will apeear telling the user what reference number was updated
