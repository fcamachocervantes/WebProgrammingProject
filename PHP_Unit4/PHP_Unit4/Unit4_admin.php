<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="Unit4_common.css" />
    <link rel="stylesheet" href="Unit4_admin.css" />
</head>

<body>
    <?php
    include "Unit4_header.php";
    include "Unit4_database.php";
    $conn = getConnection();
    ?>
    <div class="adminContent">
        <div class="customers">
            <h2>Customers</h2>
            <?php
            $result = getCustomers($conn);
            ?>
            <table>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                </tr>
                <?php if ($result): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td>
                                <?= $row['last_name'] ?>
                            </td>
                            <td>
                                <?= $row['first_name'] ?>
                            </td>
                            <td>
                                <?= $row['email'] ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
        <div class="orders">
            <h2>Orders</h2>
            <?php
            $orderCount = getNumberOfOrders($conn);
            $result = getOrders($conn);
            ?>
            <?php if ($orderCount == 0) {
                echo "No orders yet!";
            }
            ?>
            <?php if ($orderCount > 0): ?>
                <table>
                    <tr>
                        <th>Customer</th>
                        <th>Switch</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Donation</th>
                        <th>Total</th>
                    </tr>
                    <?php if ($result): ?>
                        <?php foreach ($result as $row): ?>
                            <tr>
                                <td>
                                    <?= $row['first_name'] ?>
                                    <?= $row['last_name'] ?>
                                </td>
                                <td>
                                    <?= $row['product_name'] ?>
                                </td>
                                <td>
                                    <?= date("m/d/y h:i A", $row['time_stamp']) ?>
                                </td>
                                <td>
                                    <?= $row['quantity'] ?>
                                </td>
                                <td>
                                    <?= $row['price'] ?>
                                </td>
                                <td>
                                    <?= $row['tax'] ?>
                                </td>
                                <td>
                                    <?= $row['donation'] ?>
                                </td>
                                <td>
                                    <?= $row['price'] * $row['quantity'] + $row['tax'] + $row['donation'] ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </table>
            <?php endif ?>
        </div>
        <div class="product">
            <h2>Switches</h2>

            <?php
            $result = getProducts($conn);
            ?>
            <table>
                <tr>
                    <th>Switch ID</th>
                    <th>Switch</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php if ($result): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td>
                                <?= $row['id'] ?>
                            </td>
                            <td>
                                <?= $row['product_name'] ?>
                            </td>
                            <td>
                                <?= $row['in_stock'] ?>
                            </td>
                            <td>
                                <?= $row['price'] ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
    </div>
    <?php
    include "Unit4_footer.php";
    ?>
</body>

</html>