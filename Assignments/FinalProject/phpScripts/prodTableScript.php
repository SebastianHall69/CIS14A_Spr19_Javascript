<?php
//Include files
require_once('config.php');

//Declare variables
$server = "localhost";//Server name
$username = "sebast49_root";//Server username
$password = "Password69";//Server password
$db = "sebast49_storefront";//Server db name
$filter = (isSet($_GET["cat"])) ? "WHERE product_category = '" . $_GET["cat"] . "'": "";//String to append and filter product
$sql = "SELECT product_id, product_quantity, product_name, product_img_path, product_price FROM entity_product $filter;";//SQL statement to query db
$result;//Result of sql query
$row;//Associative array holding a row from result

function displayProducts() {
    //Declare global variables
    global $server, $username, $password, $db, $sql, $result, $row;
    
    //Create database connection
    $conn = connect($server, $username, $password, $db);
    
    //Execute query
    if($result = $conn->query($sql)) {//If execution successful
        if($result->num_rows > 0) {//If num rows > 0 create table
            while($row = $result->fetch_assoc()) {
                echo "<form action='phpScripts/updateCartScript.php' target='_blank' method='post' id='updateForm" . $row["product_id"] . "' >";
                echo "<div class='product'>";
                echo "<img class='prodImg' src='" . $row["product_img_path"] ."' alt='" . $row["product_img_path"] . "' />";
                echo "<div class='prodInfo'>";
                echo "<h3>" . $row["product_name"] . "</h3>";
                echo "<h5>Quantity Available: " . $row["product_quantity"] . "</h5>";
                echo "<h5>Price: $" . number_format($row["product_price"], 2) . "</h5>";
                echo "<div class='prodInput'>";
                echo "<input id='" . $row["product_id"] . "' type='number' max='" . $row["product_quantity"] . "' min='0' step='1' placeholder='Order Quantity' onchange='limitOrdered(" . $row["product_id"] . ");' />";
                echo "<input type='button' value='Add To Cart' onclick='addToCart(" . $row["product_id"] . ", " . $row["product_quantity"] . ", \"" . $row["product_name"] . "\", \"" . $row["product_img_path"] . "\", " . $row["product_price"] . ")' />";
                echo "<input type='hidden' id='jsonText" . $row["product_id"] . "' name='jsonText' />";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
            }
        } else {
            echo "<h4>No Products At This Time</h4>";
        }
    } else {//Else report error
        echo $conn->error;
    }
    
    //Close database connection
    $conn->close();
}
?>