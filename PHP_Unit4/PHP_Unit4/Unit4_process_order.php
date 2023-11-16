<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="Unit4_common.css" />
    <link rel="stylesheet" href="Unit4_process_order.css" />
</head>

<body>
    <?php
    include "Unit4_header.php";
    include "Unit4_database.php";
    $conn = getConnection();

    $email = $_POST['email'];
    $foundCustomer = getCustomerByEmail($email, $conn);
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $switchId = $_POST['switches'];
    $productDetails = getProduct($switchId, $conn);
    $quantity = $_POST['quantity'];
    $timeStamp = $_POST['time_stamp'];
    $precision = 2;

    //8.81% combined sales tax rate for Denver
    $taxRate = 0.0881;
    ?>
    <div class="confirmationPageContainer">
        <div class="confirmationPage">
            <h3>Order Confirmation</h3>
            <article>
                <p>
                    <strong>Hello
                        <?php
                        echo "{$firstName} {$lastName}</strong>";
                        if ($foundCustomer) {
                            echo " - Welcome back!";
                        } else {
                            echo " - Welcome to the KeyWave!";
                            addCustomer($firstName, $lastName, $email, $conn);
                        }
                        ?>
                </p>
                <p>
                    We hope you enjoy your
                    <?php echo "<strong>{$productDetails['product_name']}</strong> switches!" ?>
                </p>
            </article>
            <h3>
                Order Details:
            </h3>
            <article id="orderDetails">
                <?php
                $price = $productDetails['price'];
                $total = $quantity * $price;
                $tax = $taxRate * $price * $quantity;
                $subTotal = ($quantity * $price) * (1 + $taxRate);
                $donationTotal = 0;
                $customerId = getCustomerByEmail($email, $conn);
                sellProduct($switchId, $quantity, $conn);
                ?>
                <div class="left-col">
                    <p>
                        <?php
                        echo "{$quantity} @ $" . "{$price}:&emsp;";
                        ?>
                    </p>
                    <p>
                        <?php
                        echo "Tax:&emsp;";
                        ?>
                    </p>
                    <p>
                        <?php
                        echo "Subtotal:&emsp;";
                        ?>
                    </p>
                    <p>
                        <?php
                        if ($_POST['donation'] == "true") {
                            echo "Total with donation:&emsp;";
                        }
                        ?>
                    </p>
                </div>
                <div class="right-col">
                    <p>
                        <?php
                        echo "$" . number_format($total, $precision, '.', '');
                        ?>
                    </p>
                    <p>
                        <?php
                        echo "$" . number_format($tax, $precision, ".", "");
                        ?>
                    </p>
                    <p>
                        <?php
                        echo "$" . number_format($subTotal, $precision, ".", "");
                        ?>
                    </p>
                    <p>
                        <?php
                        if ($_POST['donation'] == "true") {
                            $donationTotal = ceil($subTotal);
                            echo "$" . number_format($donationTotal, $precision, ".", "");
                        }
                        ?>
                    </p>
                </div>
            </article>
            <p id="emailOffers">We'll send special offer to
                <?= $email ?>
            </p>
        </div>
    </div>
    <?php
    $foundOrder = getOrdersByTime($conn, $switchId, $customerId, $timeStamp);
    if (!$foundOrder) {
        addOrder($switchId, $customerId, $quantity, $price, $tax, $donationTotal, $timeStamp, $conn);
    }
    include "Unit4_footer.php";
    ?>

</body>

</html>