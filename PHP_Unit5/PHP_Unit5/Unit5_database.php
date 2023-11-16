<?php
date_default_timezone_set("America/Denver");
function getConnection()
{
    include "Unit5_database_credentials.php";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getCustomers($conn)
{
    $sql = "SELECT * FROM customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getCustomersByFirstName($conn, $firstName)
{
    $firstName .= "%";
    $sql = "SELECT first_name, last_name, email FROM customer WHERE first_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $firstName);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCustomersByLastName($conn, $lastName)
{
    $lastName .= "%";
    $sql = "SELECT first_name, last_name, email FROM customer WHERE last_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $lastName);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getNumCustomers($conn)
{
    $sql = "SELECT COUNT(id) AS count FROM customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'];
}

function getCustomerById($id, $conn)
{
    $sql = "SELECT first_name, last_name FROM customer WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "is ";
        echo $row['first_name'];
        echo " ";
        echo $row["last_name"];
    } else {
        echo "does not exist";
    }
}

function getCustomerByEmail($email, $conn)
{
    $sql = "SELECT first_name, last_name FROM customer WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function addCustomer($first_name, $last_name, $email, $conn)
{
    $sql = "INSERT INTO customer (first_name, last_name, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $first_name, $last_name, $email);
    $stmt->execute();
}

function getNumberOfOrders($conn)
{
    $sql = "SELECT COUNT(id) AS count FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row["count"];
}

function addOrder($product_id, $customer_id, $quantity, $price, $tax, $donation, $time_stamp, $conn)
{
    $sql = "INSERT INTO orders (product_id, customer_id, quantity, price, tax, donation, time_stamp) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiidddi", $product_id, $customer_id, $quantity, $price, $tax, $donation, $time_stamp);
    $stmt->execute();
}

function getOrders($conn)
{
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

function getOrdersByTime($conn, $switchId, $customerId, $timeStamp)
{
    $sql = "SELECT o.id AS order_id, 
                    o.product_id, 
                    p.product_name AS product_name, 
                    o.customer_id, 
                    c.first_name AS first_name, 
                    c.last_name AS last_name, 
                    o.quantity AS quantity, 
                    o.price AS price, 
                    o.tax AS tax, 
                    o.donation AS donation, 
                    o.time_stamp AS time_stamp 
                    FROM orders o 
                    JOIN product p ON o.product_id = p.id
                    JOIN customer c ON o.customer_id = c.id
                    WHERE time_stamp = ? AND o.product_id = ? AND o.customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $timeStamp, $switchId, $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getOrdersByTimeAsArray($conn, $switchId, $customerId, $timeStamp)
{
    $sql = "SELECT o.id AS order_id, 
                    o.product_id, 
                    p.product_name AS product_name, 
                    o.customer_id, 
                    c.first_name AS first_name, 
                    c.last_name AS last_name, 
                    o.quantity AS quantity, 
                    o.price AS price, 
                    o.tax AS tax, 
                    o.donation AS donation, 
                    o.time_stamp AS time_stamp 
                    FROM orders o 
                    JOIN product p ON o.product_id = p.id
                    JOIN customer c ON o.customer_id = c.id
                    WHERE time_stamp = ? AND o.product_id = ? AND o.customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $timeStamp, $switchId, $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProducts($conn)
{
    $sql = "SELECT * FROM product";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getActiveProducts($conn)
{
    $sql = "SELECT * FROM product WHERE inactive = 0";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getProduct($id, $conn)
{
    $sql = "SELECT * FROM product WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
}

function sellProduct($product_id, $quantity, $conn)
{
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

function getProductQuantity($switchId, $conn)
{
    $sql = "SELECT in_stock AS quantity FROM product WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $switchId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row["quantity"];
}

function addProduct($product_name, $image_name, $in_stock, $price, $inactive, $conn)
{
    $sql = "INSERT INTO product (product_name, image_name, in_stock, price, inactive) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidi", $product_name, $image_name, $in_stock, $price, $inactive);
    $stmt->execute();
}

function updateProduct($product_name, $image_name, $in_stock, $price, $inactive, $id, $conn)
{
    $sql = "UPDATE product SET product_name = ?, image_name = ?, in_stock = ?, price = ?, inactive = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidii", $product_name, $image_name, $in_stock, $price, $inactive, $id);
    $stmt->execute();
}

function deleteProduct($id, $conn)
{
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function getOrdersByProductId($id, $conn)
{
    $sql = "SELECT * FROM orders WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function createProductTable($conn, $result)
{
    echo "<table>";
    echo "<tr>";
    echo "<th>Switch</th>";
    echo "<th>Image</th>";
    echo "<th>Quantity</th>";
    echo "<th>Price</th>";
    echo "<th>Inactive?</th>";
    echo "</tr>";
    if ($result) {
        foreach ($result as $row) {
            echo "<tr class='productRow' id='".$row['id']."'>";
            echo "<td class='switchName'>";
            echo $row['product_name'];
            echo "</td>";
            echo "<td class='imageName'>";
            echo $row['image_name'];
            echo "</td>";
            echo "<td class='quantity'>";
            echo $row['in_stock'];
            echo "</td>";
            echo "<td class='price'>";
            echo $row['price'];
            echo "</td>";
            echo "<td class='inactive'>";
            if ($row['inactive'] == 0) {
                echo 'No';
            } else {
                echo 'Yes';
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>