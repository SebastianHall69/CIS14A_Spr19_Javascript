
<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Include files
require_once('config.php');

//Declare variables
$server = 'localhost';//Server name
$username = 'sebast49_root';//Server username
$password = 'Password69';//Server password
$db = 'sebast49_storefront';//Database name
$sql;//SQL query to be executed

//Create connection to database
$conn = connect($server, $username, $password, $db);

//Check if form data sent through post
if($_SERVER["REQUEST_METHOD"] == "POST") {//Process input from user
    //If login else if sign up
    if(isSet($_POST["loginUsername"])) {
        //Search database for username provided
        $uname = $_POST["loginUsername"];
        $pword = ($_POST["loginPassword"]) ? $_POST["loginPassword"] : "";
        $sql = "SELECT `account_id`, `account_username`, `account_password`, `account_type` FROM `sebast49_storefront`.`entity_account` WHERE `account_username`='$uname'";
        $result = $conn->query($sql);
        $loggedIn = false;

        //If a record was found
        if($result->num_rows > 0) {
            $loginInfo = $result->fetch_assoc();
            
            //If the password matches password on record
            if($_POST["loginPassword"] == $loginInfo["account_password"]){
                $_SESSION["username"] = $uname;
                $_SESSION["password"] = $pword;
                $_SESSION["id"] = $loginInfo["account_id"];
                $_SESSION["type"] = $loginInfo["account_type"];
                $loggedIn = true;
            } else {//Invalid password
                echo "<script>" .
                    "window.onload = function () {" .
                        "setMsg(1, 'Invalid password');" . 
                        "document.getElementById('loginForm').style.display = 'block';" .
                        "document.getElementById('loginUsername').value = '$uname';" .
                    "}" .
                "</script>";
            }
        } else {//Login not found
            echo "<script>" . 
                    "window.onload = function () {" .
                        "setMsg(0, 'Username does not exist');" . 
                        "document.getElementById('loginForm').style.display = 'block';" .
                    "}" .
                "</script>";
        }
    } else if(isSet($_POST["signUpUsername"])) {
        //Get new username and password from post
        $uname = $_POST["signUpUsername"];
        $pword = $_POST["signUpPassword"];

        //Check if username already exists
        $sql = "SELECT `account_id`, `account_username`, `account_password` FROM `sebast49_storefront`.`entity_account` WHERE `account_username`='$uname'";
        $result = $conn->query($sql);
        
        //If username is found
        if($result->num_rows > 0) {
            //Echo script that lets user know name is unavailable
            echo "<script>" . 
                    "window.onload = function () {" .
                        "setMsg(2, 'Username already exists');" . 
                        "document.getElementById('signUpForm').style.display = 'block';" .
                    "}" .
                "</script>";
        } else {
            $sql = "INSERT INTO `sebast49_storefront`.`entity_account` (`account_username`, `account_password`) VALUES ('$uname', '$pword');";
            $conn->query($sql);
            $_SESSION["username"] = $uname;
            $_SESSION["password"] = $pword;
            $_SESSION["id"] = $conn->insert_id;
            $_SESSION["type"] = "user";
            $loggedIn = true;
        }
    }
    
    //Load cart into session storage and go to shop if logged in
    if($loggedIn) {
        $sql = "SELECT `cart_json_text` FROM `entity_cart`, `xref_account_cart` WHERE `xref_account_cart`.`account_id`=" 
            . $_SESSION["id"] . " AND `xref_account_cart`.`cart_id`=`entity_cart`.`cart_id`;";
        $result;
        if($result = $conn->query($sql)) {
            //If a previous cart was found
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $txt = $row["cart_json_text"];
                echo "<script>";
                //Turn user cart from db into object
                echo "var userCart = '$txt';";
                echo "userCart = JSON.parse(userCart);";
                echo "userCart = new Cart(userCart);";
                //Get session cart
                echo "var currentCart = sessionStorage.getItem('userCart');";
                //Add session cart products to db cart if it exists
                echo "if(currentCart) {";
                echo "currentCart = JSON.parse(currentCart);";
                echo "currentCart = new Cart(currentCart);";
                echo "for(var i = 0; i < currentCart.products.length; ++i) {";
                echo "userCart.addProduct(currentCart.products[i]);";
                echo "}";
                echo "}";
                //Set db cart in session storage
                echo "var txt = JSON.stringify(userCart);";
                echo "sessionStorage.setItem('userCart', txt);";
                echo "</script>";
            }
        } else {
            echo "failure" . $conn->error;
        }
        
    }
    
    //Close database connection
    $conn->close();
    
    //Redirect to index if logged in
    if($loggedIn) {
        echo "<script>window.location.href='index.php';</script>";
    }
}
?>