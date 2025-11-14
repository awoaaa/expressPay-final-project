<?php
$host = "localhost";         #The database server which is usually localhost
$username = "root";          #the default username in XAMPP is root so we use root as our username
$password = "";              #the default password is always empty in XAMPP so we leave it empty 
$dbname = "booking_system";  #this is the database we want to use 

#Here, we are creating the connection object. This is what we will use to connect to our form
$conn = new mysqli($host, $username, $password, $dbname);

#This checks to see if there are errors in our connection. If there are, then we use the die function to print out the error message and stoop the rest of the script from running.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 	#stops the script and prints the error so you know what went wrong
}