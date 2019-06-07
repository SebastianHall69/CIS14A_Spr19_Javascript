<?php
//Include files
require_once('config.php');

//Start session
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Declare variables
$server = "localhost";
$username = "sebast49_root";
$password = "Password69";
$db = "sebast49_storefront";

//If user logged in drop cart from db
if(isSet($_SESSION["id"])) {
    //Connect to db
    $conn = connect($server, $username, $password, $db);
    
    //Declare and initailize variables
    $sId = $_SESSION["id"];
    $getCartIdSQL = "SELECT `cart_id` FROM `xref_account_cart` WHERE `xref_account_cart`.`account_id`=" . $sId . ";";
    $delXrefSQL = "DELETE FROM `xref_account_cart` WHERE `xref_account_cart`.`account_id`=" . $sId . ";";
    
    //If cart id query succeeds
    if($result = $conn->query($getCartIdSQL)) {
        if($result->num_rows > 0) {//If a result is found
            $row = $result->fetch_assoc();
            $cId = $row["cart_id"];//Get cart id
            
            //Delete reference between cart and user
            if($conn->query($delXrefSQL)) {
                //Delete cart
                $delCartSQL = "DELETE FROM entity_cart WHERE entity_cart.cart_id=" . $cId . ";";
                if($conn->query($delCartSQL)) {
                    
                } else {
                    echo "Failed to delete cart";
                    die();
                }
            } else {
                echo "Failed to delete reference";
                die();
            }
        }
    } else {
        echo "Query to get cart id failed";
        die();
    }
    
    //Close db connection
    $conn->close();
}

//Drop cart from session storage for logged in user and guest
echo "<script>sessionStorage.removeItem('userCart');</script>";
?>