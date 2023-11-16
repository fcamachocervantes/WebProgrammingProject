<?php
include "Unit4_database.php";
$conn = getConnection();

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$switchId = $_POST['switchType'];
$quantity = $_POST['quantity'];
$timeStamp = $_POST['timeStamp'];

$productDetails = getProduct($switchId, $conn);
$taxRate = 0.0881;
$price = $productDetails['price'];
$total = $quantity * $price;
$tax = $taxRate * $price * $quantity;
$subTotal = ($quantity * $price) * (1 + $taxRate);
$donationTotal = 0;

$customerId = getCustomerByEmail($email, $conn);
sellProduct($switchId, $quantity, $conn);
addOrder($switchId, $customerId, $quantity, $price, $tax, $donationTotal, $timeStamp, $conn);

$result = getOrdersByTimeAsArray($conn, $switchId, $customerId, $timeStamp);

echo json_encode($result);
?>