<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Unit5_common.css" />
    <link rel="stylesheet" href="Unit5_adminProduct.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="Unit5_CRUD_scripts.js"></script>
    <title>Products</title>
</head>

<body>
    <?php
    include "Unit5_header.php";
    include "Unit5_database.php";
    $conn = getConnection();
    ?>
    <div class="adminProducts">
        <div class="tableSection">
            <h2>Switches</h2>
            <?php
            $result = getProducts($conn);
            ?>
            <span class="productTable" id="productTable">
                <?php
                createProductTable($conn, $result);
                ?>
            </span>
        </div>

        <div class="addProductForm">
            <form id="productForm" class="productInfo">
                <label for="switchInfo" class="floatingLabel">Switch Info</label>
                <ul id="switchInfo" class="infoBox">
                    <li>
                        <label for="product_name">Switch Name: *</label>
                        <input type="text" id="product_name" name="product_name" required />
                    </li>
                    <li>
                        <label for="image_name">Switch Image: *</label>
                        <input type="text" id="image_name" name="image_name" required />
                    </li>
                    <li>
                        <label for="in_stock">Quantity: *</label>
                        <input type="number" min="0" id="in_stock" name="in_stock" required />
                    </li>
                    <li>
                        <label for="price">Price: </label>
                        <input type="number" min="0" id="price" name="price" />
                    </li>
                    <li>
                        <label for="inactive">Make Inactive: </label>
                        <input type="checkbox" id="inactive" name="inactive" />
                    </li>
                    <li>
                        <input type="text" id="productID" name="productID" value="" hidden />
                    </li>
                </ul>
                <input type="submit" value="Add Switch" class="floatingLabel" id="addSwitchButton" />
                <input type="submit" value="Update" class="floatingLabel" id="updateSwitchButton" />
                <input type="submit" value="Delete" id="deleteButton">
            </form>
        </div>
    </div>
    <?php
    include "Unit5_footer.php";
    ?>
</body>

</html>