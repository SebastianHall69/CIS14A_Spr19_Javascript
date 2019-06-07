<!--Gather data from db-->
<?php
session_start();
require_once('config.php');

//Declare and initialize variables
$nameErr = $img_pathErr = $quantityErr = $priceErr = $catErr = $sqlMsg = "";//Error messages
$conn = connect("localhost", "sebast49_root", "Password69", "sebast49_storefront");//DB connection
$quantity = $price = 0;//Default value
$name = $cat = $img_path = "";//Default values
$isValid = true;//Flag for valid form submission
$id = 0;//Default value

//If entering page with product id from Product Adder
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isSet($_POST["product_id"])) {
        //Set sql statemenet
        $id = $_POST["product_id"];
        $_SESSION["id"] = $id;
        $sql = "SELECT * FROM sebast49_storefront.entity_product WHERE product_id=$id";

        //Perform query
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        //Get data from query
        $quantity = $row["product_quantity"];
        $name = $row["product_name"];
        $cat = $row["product_category"];
        $img_path = $row["product_img_path"];
        $price = $row["product_price"];
    }//If form has been submitted for update
    if(isSet($_POST["update"])) {
        //Fill all variables with post data or set error messages is empty fields
        $id = $_SESSION["id"];
        if(empty($_POST["product_name"])) {
            $nameErr = "Product Name Required";
            $isValid = false;
        } else {
            $name = testInput($_POST["product_name"]);
            if(!preg_match("/^[\w ]+$/", $name)) {
                $nameErr = "Only alphanumerical characters and whitespace";
                $isValid = false;
            }
        }
        if(empty($_POST["product_img_path"])) {
            $img_pathErr = "Image Path Required";
            $isValid = false;
        } else {
            $img_path = testInput($_POST["product_img_path"]);
            if(!preg_match("/^[\S]+$/", $img_path)) {
                $img_pathErr = "No Whitespace in image path";
                $isValid = false;
            }
        }
        if(empty($_POST["product_quantity"])) {
            $quantityErr = "Quantity Required";
            $isValid = false;
        } else {
            $quantity = testInput($_POST["product_quantity"]);
        }
        if(empty($_POST["product_price"])) {
            $priceErr = "Product Price Required";
            $isValid = false;
        } else {
            $price = testInput($_POST["product_price"]);
        }
        if(empty($_POST["product_category"])) {
            $catErr = "Category Required";
            $isValid = false;
        } else {
            $cat = testInput($_POST["product_category"]);
        }

        //If form is valid then store product in database, else output err message
        if($isValid) {
            $sql = "UPDATE sebast49_storefront.entity_product SET product_quantity=$quantity, product_name='$name', product_category='$cat', product_img_path='$img_path', product_price=$price WHERE product_id=$id";
            if($conn->query($sql)) {
                echo "<script>parent.location.href=parent.location.href;</script>";
            } else {
                $sqlMsg = "<h3>SQL Error: " . $sql . "</h3><h4>Error Message: " . $conn->error . "</h4>";
            }
        }
    }
} else {
    header("location:../index.php");
}

//Close database connection
$conn->close();
?>