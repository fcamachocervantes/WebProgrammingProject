<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="Unit1_common.css" />
</head>
<body>
    <?php
    include "Unit1_header.php";

    //Retrieve form data using PHP superglobals
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $switchType = $_POST['switches'];
    $quantity = $_POST['quantity'];

    $precision = 2;

    //Define price for each switch type
    $switchPrices = [
        "Clicky" => 23.40,
        "Tactile" => 23.40,
        "Linear" => 23.40
    ];

    //Get the price based on the selected switch type
    $price = $switchPrices[$switchType];

    //Calculate subtotal
    $subTotal = $quantity * $price;

    //8.81% combined sales tax rate for Denver
    $taxRate = 0.0881;

    //Calculate total including tax
    $totalIncludingTax = $subTotal * (1 + $taxRate);

    //Check if the user opted for rounding up for donation
    $totalIncludingDonation = 0;
    if ($_POST['donation'] == "true") {
        $totalIncludingDonation = ceil($totalIncludingTax);
    }

    ?>

    <div class="confirmationPage">
        <h2>Order Confirmation</h2>
        <p>
            <strong>Name:</strong>
            <?php echo $firstName . " " . $lastName; ?>
        </p>
        <p>
            <strong>Email:</strong>
            <?php echo $email; ?>
        </p>
        <p>
            <strong>Product:</strong> NovelKey Cream 
            <?php echo $switchType; ?> Switch
        </p>
        <p>
            <strong>Quantity:</strong>
            <?php echo $quantity; ?>
        </p>
        <p>
            <strong>Price per unit:</strong> $
            <?php echo number_format($price, $precision, '.', ''); ?>
        </p>
        <p>
            <strong>Subtotal:</strong> $
            <?php echo number_format($subTotal, $precision, '.', ''); ?>
        </p>
        <p>
            <strong>Total including tax (8.81%):</strong> $
            <?php echo number_format($totalIncludingTax, $precision, '.', ''); ?>
        </p>
        <?php
        if ($totalIncludingDonation > 0) {
            echo "<p><strong>Total with donation:</strong> $" . number_format($totalIncludingDonation, $precision,'.', '') . "</p>";
        }
        ?>
    </div>

    <?php
    include "Unit1_footer.php";
    ?>

</body>
</html>