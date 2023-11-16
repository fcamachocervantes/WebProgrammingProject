<?php
include "Unit5_database.php";
$conn = getConnection();

$queryName = $_GET['queryName'];
$nameType = $_GET['nameType'];

if ($nameType == 'first') {
    $result = getCustomersByFirstName($conn, $queryName);
} elseif ($nameType == 'last') {
    $result = getCustomersByLastName($conn, $queryName);;
}

echo json_encode($result);
?>
