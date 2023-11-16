<?php 
    include "Unit4_database.php";
    $conn = getConnection();
    $switchId = $_GET["switch"];
    $quantity = getProductQuantity($switchId, $conn);
    echo $quantity;
?>