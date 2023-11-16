document.addEventListener("DOMContentLoaded", function () {
    const tableRows = document.getElementsByClassName("productRow");

    for (let i = 0; i < tableRows.length; i++) {
        const switchName = tableRows[i].querySelector('.switchName').textContent;
        const imageName = tableRows[i].querySelector('.imageName').textContent;
        const quantity = parseInt(tableRows[i].querySelector('.quantity').textContent, 10);
        const price = parseFloat(tableRows[i].querySelector('.price').textContent);
        const isActive = tableRows[i].querySelector('.inactive').textContent.trim() === 'No' ? false : true;
        const id = parseInt(tableRows[i].id);

        tableRows[i].onclick = function () {
            fillFormFields(switchName, imageName, quantity, price, isActive, id, tableRows[i]);
        };
    }
});


var selectedRow = null;
function fillFormFields(switchName, imageName, quantity, price, isActive, id, row) {
    if (selectedRow !== null) {
        selectedRow.style.backgroundColor = "";
    }
    row.style.backgroundColor = "yellow";

    document.getElementById("product_name").value = switchName;
    document.getElementById("image_name").value = imageName;
    document.getElementById("in_stock").value = quantity;
    document.getElementById("price").value = price;
    document.getElementById("inactive").checked = isActive;
    document.getElementById("productID").value = id;

    selectedRow = row;
};

$(document).ready(function () {
    $("#addSwitchButton").click(function (e) {
        e.preventDefault();

        var product_name = $("#product_name").val();
        var image_name = $("#image_name").val();
        var in_stock = $("#in_stock").val();
        var price = $("#price").val();
        var inactive = $("#inactive").val();

        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'product_name=' + product_name + '&image_name=' + image_name + '&in_stock=' + in_stock + '&price=' + price + '&inactive=' + inactive;
        if (product_name == '' || image_name == '') {
            alert("Please Fill All Fields");
        }
        else if (in_stock == '') {
            alert("Please enter a quantity >=0");
        }
        else {
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "Unit5_ajaxCreate.php",
                data: dataString,
                cache: false,
                success: function (response) {
                    $("#productForm").each(function () {
                        this.reset();
                    });

                    $("#productTable").html(response);
                }
            });
        }
        return false;
    });
});

$(document).ready(function () {
    $("#updateSwitchButton").click(function (e) {
        e.preventDefault();

        var product_name = $("#product_name").val();
        var image_name = $("#image_name").val();
        var in_stock = $("#in_stock").val();
        var price = $("#price").val();
        var inactive = $("#inactive").val();
        var id = $("#productID").val()

        // Returns successful data submission message when the entered information is stored in database.
        var dataString = 'product_name=' + product_name + '&image_name=' + image_name + '&in_stock=' + in_stock + '&price=' + price + '&inactive=' + inactive + '&productID=' + id;
        if (product_name == '' || image_name == '') {
            alert("Please Fill All Fields");
        }
        else if (id == '') {
            alert("Please select an existing product");
        }
        else if (in_stock == '') {
            alert("Please enter a quantity >=0");
        }
        else {
            // AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "Unit5_ajaxUpdate.php",
                data: dataString,
                cache: false,
                success: function (response) {
                    $("#productForm").each(function () {
                        this.reset();
                    });

                    $("#productTable").html(response);
                }
            });
        }
        return false;
    });
});

$(document).ready(function () {
    $("#deleteButton").click(function (e) {
        e.preventDefault();
        var id = $("#productID").val();
        $.ajax({
            type: "POST",
            url: "Unit5_ajaxCheckOrders.php",
            data: { productID: id },
            success: function (response) {
                if (response === "orders_exist") {
                    alert("Cannot delete the product because there are existing orders. Consider making the item inactive.");
                } else {
                    var confirmDelete = confirm("Are you sure you want to delete this product?");

                    if (confirmDelete) {
                        $.ajax({
                            type: "POST",
                            url: "Unit5_ajaxDelete.php",
                            data: { productID: id },
                            success: function (response) {
                                $("#productForm").each(function () {
                                    this.reset();
                                });

                                $("#productTable").html(response);
                            }
                        });
                    }
                }
            }
        });
    });
});
