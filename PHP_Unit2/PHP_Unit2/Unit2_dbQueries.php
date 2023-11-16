<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database Queries</title>
        <link rel="stylesheet" href="Unit2_common.css" />
        <link rel="stylesheet" href="Unit2_dbQueries.css" />
    </head>

    <body>
        <?php
        include "Unit2_header.php";
        include "Unit2_database.php";
        $conn = getConnection();
        ?>

        <div class="dbContainer">
            <div class="customers">
                <h2>Customers</h2>
                <?php
                $result = getCustomers($conn);
                ?>
                <table>
                    <tr>
                        <th>Customer #</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                    </tr>
                    <?php if ($result): ?>
                    <?php foreach($result as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>

                <ul>
                    <li>Number of customers: <?php echo getNumCustomers($conn); ?></li> 
                    <li>Customer 2 <?php getCustomerById(2, $conn); ?></li>
                    <li>Customer 4 <?php getCustomerById(4, $conn); ?></li>
                    <li>Finding customer by email: mmouse@mines.edu... <?php getCustomerByEmail('mmouse@mines.edu', $conn); ?></li>
                    <li>Finding customer by email: dduck@mines.edu... <?php getCustomerByEmail('dduck@mines.edu', $conn); ?></li>
                    <li>Adding New Customer Donald Duck <?php addCustomer('Donald', 'Duck', 'dduck@mines.edu', $conn); ?></li>
                    <li>Finding customer by email: dduck@mines.edu... <?php getCustomerByEmail('dduck@mines.edu', $conn); ?></li>
                </ul>
            </div>
            <div class="orders">
                <h2>Orders</h2>
                <ul>
                    <li><?php getNumberOfOrders($conn); ?></li>
                    <li>Adding an order <?php addOrder(2, 1, 6, 23.40, 8.81, 0.23, $conn); ?></li>
                </ul>

                <?php
                $result = getOrders($conn);
                ?>
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
                    <?php foreach($result as $row): ?>
                    <tr>
                        <td><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>
                        <td><?= $row['product_name'] ?></td>
                        <td><?= date("m/d/y h:i A",$row['time_stamp']) ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['tax'] ?></td>
                        <td><?= $row['donation'] ?></td>
                        <td><?= $row['price'] * $row['quantity'] + $row['tax'] + $row['donation'] ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>

                <ul>
                    <li><?php getNumberOfOrders($conn); ?></li>
                </ul>
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
                    <?php foreach($result as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['product_name'] ?></td>
                        <td><?= $row['in_stock'] ?></td>
                        <td><?= $row['price'] ?></td>
                    </tr>
                    <?php endforeach ?>
                    <?php endif ?>
                </table>

                <ul>
                    <li>Selling 2 Tactile Switches <?php sellProduct("Tactile", 2, $conn) ?></li>
                    <li>The new quantity for Tacticle Switches is <?php getProductQuantity("Tactile", $conn) ?></li>
                    <li>Selling 20 Tactile Switches <?php sellProduct("Tactile", 20, $conn) ?></li>
                    <li>The new quantity for Tacticle Switches is <?php getProductQuantity("Tactile", $conn) ?></li>
                </ul>
            </div>
        </div>

        <?php
        include "Unit2_footer.php";
        ?>

    </body>

</html>