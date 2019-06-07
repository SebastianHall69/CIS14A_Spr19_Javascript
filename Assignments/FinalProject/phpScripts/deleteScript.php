<?php
//Include files
require_once('config.php');

//Exit script if requirements not met
if($_SERVER["REQUEST_METHOD"] != "POST" || empty($_POST["product_id"])) {
    echo "Request Method Not Post Or Empty Product Id";
    die;
}

//Declare variables
$id = $_POST["product_id"];//Product id
$name = $_POST["product_name"];//Product name
$conn = connect("localhost", "sebast49_root", "Password69", "sebast49_storefront");//Connection to db
$delsql = "DELETE FROM sebast49_storefront.entity_product WHERE product_id=$id;";//SQL query for deletion
$selsql = "SELECT * FROM sebast49_storefront.entity_product WHERE product_id=$id;";//SQL query for determing if product has is in database
$results;//Results of selection sql

//Run query to determine if product_id is valid key
$results = $conn->query($selsql);

//If there is a match in the database delete item
if($results->num_rows > 0) {
    //Run deletion query and display results
    if($conn->query($delsql)) {//If deleted say so
        echo "<h3>$name was successfully deleted</h3>";//Output results
    } else {//Else remove item from all carts that have the item and run query again
        $rmvFrgKey = "DELETE FROM sebast49_storefront.xref_cart_product WHERE product_id=$id;";
        $conn->query($rmvFrgKey);
        if($conn->query($delsql)) {
            echo "<h3>$name was successfully deleted and removed from users carts</h3>";
        } else {
            echo "<h3>Failure to remove $name from cart</h3>";
        }
    }
}
else {//Let user know item does not exist
    echo "<h3>This product does not exist or has already been deleted</h3>";
    echo "<input type='button' value='Update Product Table' onclick='parent.location.href=parent.location.href;' />";
}
//Close database connection
$conn->close();
?>