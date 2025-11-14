<?php
#This file is used to check if our payment was successful and went through so it checks the status of our payment 
include 'db_connect.php';
include 'expressdetails.php'; 

if (!isset($_GET['token'])) {
    die("Token is required.");
}

$token = $_GET['token'];
$url = "https://sandbox.expresspaygh.com/api/query.php";

$data = [
  "merchant-id" => $merchant_id,
  "api-key" => $api_key,
  "token" => $token
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if (!$response) {
  die("Error contacting ExpressPay.");
}

$result = json_decode($response, true);

if (!isset($result['result'])) {
  die("Unexpected response: " . htmlspecialchars($response));
}

$status = $result['result-text']; #this will store the current status of the payment from the array so this could be a "Success" or "Pending", etc.
$orderId = $result['order-id']; #storing the corresponding order id to track the status 

#when all the information has been collected, we have to update the payments status in our table 
$conn->query("UPDATE payments SET status = '$status' WHERE order_id = '$orderId'");

if ($result['result'] === 1) {
    header("Location: payment_success.php"); #my payment successful page
} else {
    header("Location: payment_failed.php"); #payment failure page
}
exit;
?>
