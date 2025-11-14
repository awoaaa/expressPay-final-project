<?php
require __DIR__ . '/vendor/autoload.php';
#this stores specific information such as the merchant id, api key and our submit url from expresspay 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$expresspaydetails = [
    'merchant_id' => $_ENV['EXPRESSPAY_MERCHANT_ID'],
    'api_key'     => $_ENV['EXPRESSPAY_PRIVATE_KEY'],
    'submit_url'  => $_ENV['EXPRESSPAY_SUBMIT_URL']
];

$merchant_id = $expresspaydetails['merchant_id'];
$api_key = $expresspaydetails['api_key'];
$submit_url = $expresspaydetails['submit_url'];

?>