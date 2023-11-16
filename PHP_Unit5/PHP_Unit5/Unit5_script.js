function getQuantity() {
    var switchType = document.getElementById("switches").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            quantity = this.responseText;
            if (quantity == 0) {
                quantity = "Not found";
            }
            document.getElementById("available").value = quantity;
        }
    };
    xmlhttp.open("GET", "Unit5_get_quantity.php?switch=" + switchType, true);
    xmlhttp.send();
};

function showCustomerTableByName(input, type) {
    var queryName = input.value;
    showCustomerTable(queryName, type);
};

function showCustomerTable(queryName, nameType) {
    if (queryName.length == 0) {

    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                var tableBody = document.getElementById("customerTable").getElementsByTagName("tbody")[0];
                tableBody.innerHTML = "";

                data.forEach(function (customer) {
                    var row = tableBody.insertRow();
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    cell1.textContent = customer.first_name;
                    cell2.textContent = customer.last_name;
                    cell3.textContent = customer.email;
                    row.onclick = function () {
                        fillFormFields(customer.first_name, customer.last_name, customer.email, row);
                    };
                });
            }
        };
        xmlhttp.open("GET", "Unit5_get_customer_table.php?queryName=" + queryName + "&nameType=" + nameType, true);
        xmlhttp.send();
    }
};

var selectedRow = null;
function fillFormFields(firstName, lastName, email, row) {
    if (selectedRow !== null) {
        selectedRow.style.backgroundColor = "";
    }
    row.style.backgroundColor = "yellow";

    document.getElementById("first_name").value = firstName;
    document.getElementById("last_name").value = lastName;
    document.getElementById("email").value = email;

    selectedRow = row;
};

$(document).ready(function () {
    $("#purchaseButton").click(function (e) {
        e.preventDefault();

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var switchType = $("#switches").val();
        var quantity = $("#quantity").val();
        var available = $("#available").val();
        var time_stamp = $("#time_stamp").val();
        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'first_name=' + first_name + '&last_name=' + last_name + '&email=' + email + '&switchType=' + switchType + '&quantity=' + quantity + '&timeStamp=' + time_stamp;
        if (first_name == '' || last_name == '' || email == '') {
            alert("Please Fill All Fields");
        }
        else if(switchType == null) {
            alert("Please select a switch type");
        }
        else if(parseInt(quantity) > parseInt(available)) {
            alert("Quantity entered (" + quantity + ") is greater than available (" + available + ")!");
        }
        else {
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "Unit5_ajaxsubmit.php",
                data: dataString,
                cache: false,
                success: function (result) {
                    $("#purchaseForm").each(function() {
                        this.reset();
                    });
                    console.log(result)
                    const order = JSON.parse(result);
                    console.log(order);
                    var confirmationMessage = 
                            "Order successful! Customer: " 
                            + order[0].first_name + " " 
                            + order[0].last_name + " "
                            + order[0].quantity + " Order of "
                            + order[0].product_name + " Switches "
                            + " Total $" + (parseFloat(order[0].price) * parseInt(order[0].quantity) + parseFloat(order[0].tax)).toFixed(2);
                    console.log(confirmationMessage)
                    $("#customerRows").empty();
                    $("#message").text(confirmationMessage);
                }
            });
        }
        return false;
    });
});
