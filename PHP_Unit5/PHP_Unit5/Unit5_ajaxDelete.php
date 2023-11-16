<?php
include "Unit5_database.php";
$conn = getConnection();

$id = $_POST['productID'];

deleteProduct($id, $conn);

$result = getProducts($conn);
createProductTable($conn, $result);
?>