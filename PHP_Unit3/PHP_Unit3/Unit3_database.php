<?php
date_default_timezone_set("America/Denver");
function getConnection() {
    include "Unit3_database_credentials.php";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getCustomers($conn) {
    $sql = "SELECT * FROM customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getNumCustomers($conn) {
    $sql = "SELECT COUNT(id) AS count FROM customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'];
}

function getCustomerById($id, $conn) {
    $sql = "SELECT first_name, last_name FROM customer WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "is "; echo $row['first_name']; echo " "; echo $row["last_name"];
    }
    else {
        echo "does not exist";
    }
}

function getCustomerByEmail($email, $conn) {
    $sql = "SELECT first_name, last_name FROM customer WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function addCustomer($first_name, $last_name, $email, $conn) {
    $sql = "INSERT INTO customer (first_name, last_name, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $first_name, $last_name, $email);
    $stmt->execute();
}

function getNumberOfOrders($conn) {
    $sql = "SELECT COUNT(id) AS count FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row["count"];
}

function addOrder($product_id, $customer_id, $quantity, $price, $tax, $donation, $time_stamp, $conn) {
    $sql = "INSERT INTO orders (product_id, customer_id, quantity, price, tax, donation, time_stamp) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiidddi", $product_id, $customer_id, $quantity, $price, $tax, $donation, $time_stamp);
    $stmt->execute();
}

function getOrders($conn) {
    $sql = "SELECT o.id AS order_id, 
                    o.product_id, 
                    p.product_name AS product_name, 
                    o.customer_id, c.first_name AS first_name, 
                    c.last_name AS last_name, 
                    o.quantity AS quantity, 
                    o.price AS price, 
                    o.tax AS tax, 
                    o.donation AS donation, 
                    o.time_stamp AS time_stamp 
                    FROM orders o 
                    JOIN product p ON o.product_id = p.id 
                    JOIN customer c ON o.customer_id = c.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getOrdersByTime($conn, $switchId, $customerId, $timeStamp) {
    $sql = "SELECT o.id AS order_id, 
                    o.product_id, 
                    p.product_name AS product_name, 
                    o.customer_id, c.first_name AS first_name, 
                    c.last_name AS last_name, 
                    o.quantity AS quantity, 
                    o.price AS price, 
                    o.tax AS tax, 
                    o.donation AS donation, 
                    o.time_stamp AS time_stamp 
                    FROM orders o 
                    JOIN product p ON o.product_id = ?
                    JOIN customer c ON o.customer_id = ?
                    WHERE time_stamp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $switchId, $customerId, $timeStamp);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getProducts($conn) {
    $sql = "SELECT * FROM product";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getProduct($id, $conn) {
    $sql = "SELECT * FROM product WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function sellProduct($product_id, $quantity, $conn) {
    $sql = "UPDATE product 
            SET in_stock = CASE 
                            WHEN in_stock >= ? THEN in_stock - ? 
                            ELSE 0 
                           END 
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $quantity, $product_id);
    $stmt->execute();
}

function getProductQuantity($product_name, $conn) {
    $sql = "SELECT in_stock AS quantity FROM product WHERE product_name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo $row["quantity"];
}
?>