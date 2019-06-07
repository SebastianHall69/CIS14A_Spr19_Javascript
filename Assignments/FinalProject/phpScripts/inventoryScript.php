<?php
    //Include Scripts
    require_once('config.php');
    
    //Declare variables
    $nameErr = $img_pathErr = $quantityErr = $priceErr = $catErr = $sqlMsg = "";//Error messages
    $name = $img_path = $cat = "";//Product name and image path
    $quantity = $price = 0;//Product quantity and price
    $isValid = true;//If all form input is valid
    $server = "localhost";
    $username = "sebast49_root";
    $password = "Password69";
    $db = "sebast49_storefront";
    $conn;
    
    //Create db connection
    $conn = connect($server, $username, $password, $db);

    //Check if sent with post
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //Fill all variables with post data or set error messages is empty fields
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
            $sql = "INSERT INTO entity_product (product_quantity, product_name," .
                "product_img_path, product_price, product_category) VALUES ($quantity, '$name', '$img_path', $price, '$cat');";
            if($conn->query($sql)) {
                $sqlMsg = "<h3>Record Successfully Created</h3>";
                $quantity = $price = 0;//Reset to default
                $name = $img_path = $cat = "";//Reset to default
            } else {
                $sqlMsg = "<h3>SQL Error: " . $sql . "</h3><h4>Error Message: " . $conn->error . "</h4>";
            }
        }
    }
    //Close connection
    $conn->close();
    
    
    /*
     * Function to load table
     */
function createTable() {
    //Create db connection
    global $server, $username, $password, $db;
    $conn = connect($server, $username, $password, $db);
    
    //Query products from the db
    $sql = "SELECT * FROM entity_product;";
    $result = $conn->query($sql);
    
    //Echo products results into a table
    echo "<form action='updateproducts.php' method='post' target='editFrame' id='updateForm'>";
    echo "<table><tr><th>Id</th><th>Quantity</th><th>Name</th><th>Path</th><th>price</th><th>Category</th></tr>";
    echo "<caption>Current Products</caption>";
    while($row = $result->fetch_assoc()) {
        $id = $row["product_id"];
        echo "<tr>";
        echo "<td>" . $id . "</td><td>" . $row["product_quantity"]. "</td><td>" . $row["product_name"]. "</td><td>" . $row["product_img_path"] . "</td><td>" . $row["product_price"]. "</td><td>" . $row["product_category"] . "</td>";
        echo "<td class='noBorder'><input type='button' value='Update' onclick='(function() {edit($id);})()' /></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<input id='product_id' type='hidden' name='product_id' />";
    echo "</form>";
    
    //Close db connection
    $conn->close();
}
?>