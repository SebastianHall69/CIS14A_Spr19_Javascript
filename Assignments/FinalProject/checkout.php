<!DOCTYPE html>
<?php if(session_status() == PHP_SESSION_NONE) { session_start(); }?>
<html lang="en-US">
<head>
    <meta charset="utf-8">
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
            <option value="cart.php">Cart</option>
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
    
    <div class="main">
        <form action="postPayment.php" method="post" target="_self">
            <!--Shipping Information-->
            <fieldset><legend>Shipping Address</legend>
                <label>First Name</label><br/>
                <input type="text" required pattern="[a-zA-Z\s]+"><br/><br/>
                <label>Last Name</label><br/>
                <input type="text" required pattern="[a-zA-Z\s]+"><br/><br/>
                <label>Street Address</label><br/>
                <input type="text" required pattern="[\w\s]+"><br/><br/>
                <label>City</label><br/>
                <input type="text" required pattern="[a-zA-Z\s]+"><br/><br/>
                <label>State</label><br/>
                <select>
                    <option>AL</option>
                    <option>AK</option>
                    <option>AZ</option>
                    <option>AR</option>
                    <option selected="selected">CA</option>
                    <option>CO</option>
                    <option>CT</option>
                    <option>DE</option>
                    <option>FL</option>
                    <option>GA</option>
                    <option>HI</option>
                    <option>ID</option>
                    <option>IL</option>
                    <option>IN</option>
                    <option>IA</option>
                    <option>KS</option>
                    <option>LA</option>
                    <option>ME</option>
                    <option>MD</option>
                    <option>MA</option>
                    <option>MI</option>
                    <option>MN</option>
                    <option>MS</option>
                    <option>MO</option>
                    <option>MT</option>
                    <option>NE</option>
                    <option>NV</option>
                    <option>NH</option>
                    <option>NJ</option>
                    <option>NM</option>
                    <option>NY</option>
                    <option>NC</option>
                    <option>ND</option>
                    <option>OH</option>
                    <option>OK</option>
                    <option>OR</option>
                    <option>PA</option>
                    <option>RI</option>
                    <option>SC</option>
                    <option>SD</option>
                    <option>TN</option>
                    <option>TX</option>
                    <option>UT</option>
                    <option>VT</option>
                    <option>VA</option>
                    <option>WA</option>
                    <option>WV</option>
                    <option>WI</option>
                    <option>WY</option>
                </select><br/><br/>
                <label>Zipcode</label><br/>
                <input type="text" maxlength="5" required pattern="^\d{5}$"><br/><br/>
            </fieldset>

            <!--PaymentForm-->
            <fieldset><legend>Payment Information</legend>
                <label></label><br/>
                <select>
                    <option selected="selected">Visa</option>
                    <option>Mastercard</option>
                    <option>Discover</option>
                    <option>American Express</option>
                </select><br/><br/>
                <label>Card Number</label><br/>
                <input type="text" maxlength="19" required pattern="\d{4}(\s)?\d{4}(\s)?\d{4}(\s)?(\d{4}(\s)?)?"><br/><br/>
                <label>Security Code</label><br/>
                <input type="text" maxlength="4" size="4" required pattern="^\d{3,4}$"><br/><br/>
            </fieldset>
            
            <!--Submit Button-->
            <input type="submit" value="Confirm Payment" id="checkout">
        </form>
    </div>
</body>
</html>
