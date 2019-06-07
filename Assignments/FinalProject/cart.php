<!DOCTYPE html>
<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <script src="js/Cart.js"></script>
    <script src="js/Product.js"></script>
    <link href="css/sitestyle.css" rel="stylesheet" />
    <title>Checkout</title>
</head>
    
<body>
    <!--Header-->
    <header>
        <img src="images/ratbanner.png" alt="Rodent Store Banner" />
    </header>

    <!--Navigation-->
    <nav>
        <select onclick="window.location.href=this.value;">
            <option value="index.php">Shop</option>
            <option value="cart.php" selected>Cart</option>
            <option value="aboutus.php">About Us</option>
            <?php
            if(!isSet($_SESSION["username"])) {
                echo "<option value='login.php'>Sign Up or Login</option>";
            }
            if(isSet($_SESSION["type"])) {
                if($_SESSION["type"] == "admin") {
                    echo "<option value='administration.php'>Admin Page</option>";
                }
            }
            if(isSet($_SESSION["username"])) {
                echo "<option value='phpScripts/logoutScript.php'>Sign Out</option>";
            }
            ?>
        </select>
    </nav>
    
    <!--User info div-->
        <?php
        echo "<div class='userInfo'>";
        if(isSet($_SESSION["username"])) {
            echo "<h3>Welcome Back<br/>" . $_SESSION['username'] . "!</h3>";
            echo "<input type='button' value='Sign Out' onclick='location.href=\"phpScripts/logoutScript.php\";' />";
        } else {
            echo "<h3>Welcome Guest</h3>";
            echo "<input type='button' value='Login or Sign Up' onclick='location.href=\"login.php\";' />";
        }
        echo "</div>";
        ?>
    
    <!--Main document area-->
    <div class="main">
        <!--Confirm Payment Form-->
        <form action='checkout.php' method='post' target='_self'>

            <!--Cart Heading-->
            <h1 class="center">Your Cart</h1>

            <!--Display cart and checkout button-->
            <div id="cartDiv"></div>
        </form>
        
        <!--Hidden form to update cart when products dropped-->
        <form id="updateCartForm" name="updateCartForm" action="phpScripts/updateCartScript.php" method="post" target="-blank">
            <input type="hidden" id="jsonText" name="jsonText" />
        </form>
    </div>
    
        <script>
            function showCart() {
                //Declare variables
                var output = "";
                var userCart = (sessionStorage.getItem("userCart")) ? new Cart(JSON.parse(sessionStorage.getItem("userCart"))) : null;//Users cart

                //Set output for cart
                if(userCart && userCart.products.length > 0) {
                    output += "<table style='margin:auto;'>";
                    output += userCart.tableInsides();
                    output += "</table>";
                    output += "<h5 class='center'>*Click A Product Image To Remove It From Your Cart*</h5>";
                    output += "<input type='submit' value='Checkout' id='checkout' onsubmit='checkProdCount();' />";
                } else {
                    output += "<h2>No Items In Your Cart! Get Shopping, Pauper!</h2>";
                }

                //Set cart output in cart area
                document.getElementById("cartDiv").innerHTML = output;
            }
            
            function dropItem(id) {
                //Declare variables
                var userCart = (sessionStorage.getItem("userCart")) ? new Cart(JSON.parse(sessionStorage.getItem("userCart"))) : null;//Users cart
                
                //Remove item from cart
                if(userCart) {
                    userCart.removeProduct(id);//Remove item
                    window.sessionStorage.setItem("userCart", JSON.stringify(userCart));//Set item in storage
                    window.location.href = window.location.href;//Reload page
                } else {
                    console.log("No Cart, But Trying To Remove Item With ID: " + id);
                }
                
                //Set string in hidden value and update cart
                document.getElementById("jsonText").value = JSON.stringify(userCart);
                document.updateCartForm.submit();
            }
            
            function checkProdCount() {
                //Get cart from session storage
                var userCart = (sessionStorage.getItem("userCart")) ? new Cart(JSON.parse(sessionStorage.getItem("userCart"))) : null;//Users cart
                var emptyCart = false;//If users cart is empty
                
                //Set flag for empty or nonexistent cart
                if(userCart === null || userCart.products.length === 0) {
                    emptyCart = true;
                }
                
                //Reload page if empty cart
                if(emptyCart) {
                    window.location.href = window.location.href;
                    return;
                }
            }
            window.onload = showCart();
        </script>
</body>
    
</html>