<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Unit4_common.css" />
  <link rel="stylesheet" href="Unit4_store.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>KeyWave</title>
</head>

<script>
  $(document).ready(function () {
    //When the value of the switches dropdown changes
    $('select[name="switches"]').on("change", function () {
      //Get the selected option value
      var switchImage = $("option:selected").attr('data-image-name');
      var quantity = $("option:selected").attr('data-in-stock');
      switchImage = "images/" + switchImage

      //Set the product image source based on the selected switch
      $('.productImage img').attr('src', switchImage);
      $('.productImage img').attr('alt', switchImage);

      if (quantity == 0) {
        $('.productImage #quantityMessage').text("SOLD OUT");
        $('.productImage #quantityMessage').css("color", "red");
      }
      else if (quantity <= 5 && quantity > 0) {
        $('.productImage #quantityMessage').text("Only " + quantity + " left");
        $('.productImage #quantityMessage').css("color", "red");
      }
      else {
        $('.productImage #quantityMessage').text("");
      }
    });
  });
</script>

<body>
  <?php
  include "Unit4_header.php";
  include "Unit4_database.php";
  $conn = getConnection();
  date_default_timezone_set("America/Denver");
  ?>

  <div class="storeBody">
    <form action="Unit4_process_order.php" class="purchaseInfo" method="post">
      <label for="personalInfo" class="floatingLabel">Personal Information</label>
      <ul id="personalInfo" class="infoBox">
        <li>
          <label for="first_name">First name: *</label>
          <input type="text" id="first_name" name="first_name" value="" pattern="[A-Za-z].{1,}" required
            title="Names can only include letters, spaces and apostrophe" /><br />
        </li>
        <li>
          <label for="last_name">Last name: *</label>
          <input type="text" id="last_name" name="last_name" value="" pattern="[A-Za-z].{1,}" required
            title="Names can only include letters, spaces and apostrophe" /><br />
        </li>
        <li>
          <label for="email">Email: *</label>
          <input type="email" id="email" name="email" value="" required /><br />
        </li>
      </ul>

      <?php
      $result = getProducts($conn);
      ?>

      <label for="purchaseInfo" class="floatingLabel">Product Information</label>
      <ul id="purchaseInfo" class="infoBox">
        <li>
          <select name="switches" required>
            <option value disabled selected hidden>
              -- Choose a switch type --
            </option>
            <?php if ($result): ?>
              <?php foreach ($result as $row): ?>
                <option value=<?= $row['id'] ?> data-image-name=<?= $row['image_name'] ?> data-in-stock=<?= $row['in_stock'] ?> >
                  <?= $row['product_name'] ?> 36/box $<?= $row['price'] ?>
                </option>
              <?php endforeach ?>
            <?php endif ?>
          </select>
        </li>
        <li>
          <label for="quantity">Quantity: </label>
          <input type="number" min="1" max="100" id="quantity" name="quantity" value="1" /><br />
        </li>
      </ul>

      <ul id="makeDonation">
        <p>Round up to the nearest dollar for a donation?</p>
        <li>
          <input type="radio" name="donation" value="true" />
          <label for="true">Yes</label>
        </li>
        <li>
          <input type="radio" name="donation" value="false" checked />
          <label for="false">No</label>
        </li>
      </ul>
      <input type="text" id="email" name="time_stamp" value="<?php echo time(); ?>" hidden/>
      <input type="submit" value="Purchase" class="floatingLabel" id="purchaseButton" />
    </form>

    <div class="productImage">
      <img src="" alt="Select a keyboard switch to see it">
      <p id="quantityMessage"></p>
    </div>
  </div>

  <?php
  include "Unit4_footer.php";
  ?>
</body>

</html>