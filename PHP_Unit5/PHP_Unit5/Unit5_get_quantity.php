<?php 
    include "Unit5_database.php";
    $conn = getConnection();
    $switchId = $_GET["switch"];
    $quantity = getProductQuantity($switchId, $conn);
    echo $quantity;
?>