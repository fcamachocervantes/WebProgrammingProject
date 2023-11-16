<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Unit5_common.css" />
  <link rel="stylesheet" href="Unit5_order_entry.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="Unit5_script.js"></script>
  <title>KeyWave</title>
</head>

<body>
  <?php
  include "Unit5_header.php";
  include "Unit5_database.php";
  $conn = getConnection();
  date_default_timezone_set("America/Denver");
  ?>

  <div class="storeBody">
    <form id="purchaseForm" class="purchaseInfo">
      <label for="personalInfo" class="floatingLabel">Personal Information</label>
      <ul id="personalInfo" class="infoBox">
        <li>
          <label for="first_name">First name: *</label>
          <input type="text" id="first_name" name="first_name" onkeyup="showCustomerTableByName(this, 'first')" /><br />
        </li>
        <li>
          <label for="last_name">Last name: *</label>
          <input type="text" id="last_name" name="last_name" onkeyup="showCustomerTableByName(this, 'last')" /><br />
        </li>
        <li>
          <label for="email">Email: *</label>
          <input type="email" id="email" name="email" /><br />
        </li>
      </ul>

      <?php
      $result = getProducts($conn);
      ?>

      <label for="purchaseInfo" class="floatingLabel">Product Information</label>
      <ul id="purchaseInfo" class="infoBox">
        <li>
          <select name="switches" id="switches">
            <option value disabled selected hidden>
              -- Choose a switch type --
            </option>
            <?php if ($result): ?>
              <?php foreach ($result as $row): ?>
                <option onclick=getQuantity() value=<?= $row['id'] ?> data-image-name=<?= $row['image_name'] ?>
                  data-in-stock=<?= $row['in_stock'] ?>>
                  <?= $row['product_name'] ?> 36/box $<?= $row['price'] ?>
                </option>
              <?php endforeach ?>
            <?php endif ?>
          </select>
        </li>
        <li>
          <label for="available">Available: </label>
          <input type="text" id="available" name="available" readonly /><br />
        </li>
        <li>
          <label for="quantity">Quantity: </label>
          <input type="number" min="1" id="quantity" name="quantity" value="1" /><br />
        </li>
      </ul>
      <input type="radio" name="donation" value="false" checked hidden />
      <input type="text" id="time_stamp" name="time_stamp" value="<?php echo time(); ?>" hidden />
      <input type="submit" value="Purchase" class="floatingLabel" id="purchaseButton" />
      <input type="reset" value="Reset" id="resetButton">
    </form>
    <div id="right">
      <h2>Matching Customers</h2>
      <table id="customerTable">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
          </tr>
        </thead>
        <tbody id="customerRows">

        </tbody>
      </table>
      <div id="message"></div>
    </div>
  </div>

  <?php
  include "Unit5_footer.php";
  ?>
</body>

</html>