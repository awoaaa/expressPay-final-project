<?php
#this is the express pay send request page. This is used to send a payment request to expresspay and in turn we receive a token and we are redirected to the payment page
session_start();
include 'db_connect.php';
include 'expressdetails.php';

#This will redirect to the login page if a user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

#This will get the booking details from the form using a POST request
$listing_id  = $_POST['listing_id'];
$checkin     = $_POST['checkin'];
$checkout    = $_POST['checkout'];
$numof_guests  = $_POST['numof_guests'];
$total_price = $_POST['total_price']; 

#here, i will input the booking information into the database 
$insert_booking = "INSERT INTO bookings (listing_id, user_id, checkin, checkout, numof_guests, total_price)
                   VALUES ('$listing_id', '{$_SESSION['user_id']}', '$checkin', '$checkout', '$numof_guests', '$total_price')";

#checking to see if we were able to add a booking to the database and if not, stop the running script and show the error message 
if (!$conn->query($insert_booking)) {
    die("Error creating booking: " . $conn->error);
}

#creating a booking id that will link to the payment table
$booking_id = $conn->insert_id; 

#here, i will create an order_id for ExpressPay so we can track each users transaction/booking. I will use uniqid to create unique and random order ids 
$order_id = uniqid('order_');

#this is to store payment with the booking_id linked in the payment table and store the current status as pending 
$conn->query("INSERT INTO payments (booking_id, order_id, token, amount, currency, status)
              VALUES ('$booking_id', '$order_id', '', '$total_price', 'GHS', 'PENDING')");

#stores the email and phone number in the variables customeremail and customerphone
#necessary data needed by expresspay
$data = [
    'merchant-id' => $merchant_id,
    'api-key'     => $api_key,
    'amount'       => number_format($total_price, 2, '.', ''),
    'currency'     => 'GHS',
    'redirect-url' => 'http://localhost/finalproject/paymentsuccess.php',
    'order-id'     => $order_id,
    'order-desc'   => "Booking payment for Booking ID #$booking_id",
    'email'        => $_SESSION['email'],
    'phonenumber' => $_SESSION['phone'],
    'firstname'   => $_SESSION['firstname'],
    'lastname'    => $_SESSION['lastname']
];

#here we will be sending a payment request to ExpressPay using the sandbox submit.php api 
$url = "https://sandbox.expresspaygh.com/api/submit.php";
$postFields = http_build_query($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);#informs the cURL to send a POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields); #It tells cURL to send data in the $data array as the body of a POST request
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); #returns the response as string

#Now, we execute the cURL
$response = curl_exec($ch);
curl_close($ch);

#here we will handle the response so if it is false, we stop the connection and the error message shows up 
if ($response === false) {
    die("Error contacting ExpressPay.");
}

#using json_decode and true to return an associative array and store it in $result
$result = json_decode($response, true);
if (isset($result['token'])) {
    $token = $result['token'];

   #after we extract this token and store it in the appropriate variable, we will then add this to our payment table with the order_id linked to it so we can track payments for our specific orders
    $conn->query("UPDATE payments SET token='$token' WHERE order_id='$order_id'");

    #now here, the request has successfully been sent and expresspay has authorised it all and now it will redirect us to our checkout page where we can actually make payment 
    header("Location: https://sandbox.expresspaygh.com/api/checkout.php?token=$token");
    exit;
} else {
    echo "Error from ExpressPay: " . $response;
}
?>
