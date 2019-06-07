<?php
//Start session
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Include files
require_once('config.php');

//Only execute if signed in
if(isSet($_SESSION["id"])) {
    //Declare variables
    $server = "localhost";
    $username = "sebast49_root";
    $password = "Password69";
    $db = "sebast49_storefront";
    $txt = $_POST["jsonText"];
    $conn = connect($server, $username, $password, $db);
    $sId = $_SESSION["id"];
    $getCartIdSQL = "SELECT `cart_id` FROM `xref_account_cart` WHERE `xref_account_cart`.`account_id`=" . $sId . ";";
    
    //If query to get cart id successful
    if($result = $conn->query($getCartIdSQL)) {
        //If a cart was found
        if($result->num_rows > 0) {
            //Update cart
            $row = $result->fetch_assoc();
            $cId = $row["cart_id"];
            $updateSQL = "UPDATE `entity_cart` SET `cart_json_text`='$txt' WHERE `cart_id`=$cId;";
            if($conn->query($updateSQL)) {
                
            } else {
                echo "failed to update";
                echo $conn->error;
                die();
            }
        } else {//No cart was found
            //Insert cart
            $insertSQL= "INSERT INTO `entity_cart` (`cart_json_text`) VALUES ('$txt');";
            if($conn->query($insertSQL)) {
                //Create reference between user and cart
                $newId = $conn->insert_id;
                $xrefSQL = "INSERT INTO `xref_account_cart` (`account_id`, `cart_id`) VALUES ($sId, $newId);";
                if($conn->query($xrefSQL)) {
                    
                } else {
                    echo "failed to create reference";
                    echo $conn->error;
                    die();
                }
            } else {
                echo "failed to insert";
                echo $conn->error;
                die();
            }
        }
    }
    
    $conn->close();
}

//Close window quickly and pretend that it never opened
echo "<script>window.close();</script>";
?>
