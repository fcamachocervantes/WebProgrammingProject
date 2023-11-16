<?php
include "Unit5_database.php";
$conn = getConnection();

$id = $_POST['productID'];

$result = getOrdersByProductId($id, $conn);

if($result -> num_rows > 0) {
    echo  "orders_exist";
}
else {
    echo "no_orders";
}
?>