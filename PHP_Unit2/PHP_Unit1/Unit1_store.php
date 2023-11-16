<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Unit1_common.css" />
    <link rel="stylesheet" href="Unit1_store.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>KeyWave</title>
  </head>

  <script>
    $(document).ready(function() {
      //When the value of the switches dropdown changes
      $('select[name="switches"]').change(function() {
        //Get the selected option value
        var selectedSwitch = $(this).val();
        
        //Define an object to map switch values to image paths
        var switchImages = {
          "Clicky": "images/NK_Cream_LaunchBlue.jpg",
          "Tactile": "images/NK_Cream_Tactile.jpg",
          "Linear": "images/NK_Cream_Dream.jpg"
        };

        var switchAlts = {
          "Clicky": "NK Clicky Blue Switch",
          "Tactile": "NK Tactile Switch",
          "Linear": "NK Linear Switch"
        };
  
        //Set the product image source based on the selected switch
        $('.productImage img').attr('src', switchImages[selectedSwitch]);
        $('.productImage img').attr('alt', switchAlts[selectedSwitch]);
      });
    });
  </script>
  
  <body>
    <?php
    include "Unit1_header.php";
    ?>

    <div class="storeBody">
      <form action="Unit1_process_order.php" class="purchaseInfo" method="post">
        <label for="personalInfo" class="floatingLabel">Personal Information</label>
        <ul id="personalInfo" class="infoBox">
          <li>
            <label for="first_name">First name: *</label>
            <input type="text" id="first_name" name="first_name" value="" pattern="[A-Za-z].{1,}" required title="Names can only include letters, spaces and apostrophe"/><br />
          </li>
          <li>
            <label for="last_name">Last name: *</label>
            <input type="text" id="last_name" name="last_name" value="" pattern="[A-Za-z].{1,}" required title="Names can only include letters, spaces and apostrophe"/><br />
          </li>
          <li>
            <label for="email">Email: *</label>
            <input type="email" id="email" name="email" value="" required/><br />
          </li>
        </ul>

        <label for="purchaseInfo" class="floatingLabel">Product Information</label>
        <ul id="purchaseInfo" class="infoBox">
          <li>
            <select name="switches" required>
              <option value disabled selected hidden>
                -- Choose a switch type --
              </option>
              <option value="Clicky">Novelkey Cream Clicky 36/box $23.40 </option>
              <option value="Tactile">Novelkey Cream Tactile 36/box $23.40</option>
              <option value="Linear">Novelkey Cream Linear 36/box $23.40</option>
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
            <input type="radio" name="donation" value="false" checked/>
            <label for="false">No</label>
          </li>
        </ul>

        <input
          type="submit"
          value="Purchase"
          class="floatingLabel"
          id="purchaseButton" />
      </form>

      <div class="productImage">
        <img src="" alt="Select a keyboard switch to see it">
      </div>
    </div>

    <?php
    include "Unit1_footer.php";
    ?>
  </body>
</html>
