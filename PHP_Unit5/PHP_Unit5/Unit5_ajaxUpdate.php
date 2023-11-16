<?php
include "Unit5_database.php";
$conn = getConnection();

$product_name = $_POST['product_name'];
$image_name = $_POST['image_name'];
$in_stock = $_POST['in_stock'];
$price = $_POST['price'];
$inactive = $_POST['inactive'];
$id = $_POST['productID'];

if($inactive === false) {
    $isActive = 0;
} else {
    $isActive = 1;
}

updateProduct($product_name, $image_name, $in_stock, $price, $isActive, $id, $conn);

$result = getProducts($conn);
createProductTable($conn, $result);
?>