<?php
$host = "localhost";         #The database server which is usually localhost
$username = "root";          #the default username in XAMPP is root so we use root as our username
$password = "";              #the default password is always empty in XAMPP so we leave it empty 
$dbname = "booking_system";  #this is the database we want to use 

#Here, we are creating the connection object. This is what we will use to connect to our form
$conn = new mysqli($host, $username, $password, $dbname);

#This checks to see if there are errors in our connection. If there are, then we use the die function to print out the error message and stop the rest of the script from running.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 	#stops the script and prints the error so you know what went wrong
} else {
echo "Connected successfully!<br>";
}

#Here, we want to make the connection to our form
if ($_SERVER["REQUEST_METHOD"] == "POST") { # A PHP array that contains information about the current request — like headers, request method, IP address, etc. so this checks if the method used to access the page was a "POST" method.
#stores the responses in these variables 
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["emailaddress"];
    $phone = $_POST["phonenumber"];
    $roomid = $_POST["room_id"];
    $checkin = $_POST["checkin_date"];
    $guests = $_POST["numof_guests"];
    $checkout = $_POST["checkout_date"];
}
#We are adding data into the bookings table using the INSTERT INTO .... VALUES syntax 
$sql = "INSERT INTO bookings (firstname, lastname, email, phone, roomid, checkin, guests, checkout)
        VALUES ('$firstname', '$lastname', '$email', '$phone', '$roomid' '$checkin', '$guests', '$checkout')";
#This line tells PHP to run the SQL query stored in $sql. The query() function sends our sql data to MySQL. It then checks if the connection has been successful and the query worked.
if ($conn->query($sql) === TRUE) {
    echo "Booking has been created and saved successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
  ?>
