<!DOCTYPE html>
<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/sitestyle.css" rel="stylesheet" type="text/css" />
    <title>About Us</title>
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
            <option value="aboutus.php" selected>About Us</option>
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
    
    <!--Main Area-->
    <div class="main">
        <h1 class="center">About Us</h1>
        <p>
            The Rodent Store™ is an online store dedicated to providing the 
            highest quality selection of internet rodents. We pride ourselves 
            on always stocking a wide selection of rodents including large 
            quantities of your favorites like the Communist Rat™ and our Basic 
            Mouse™ or a few more rare and pricey selections such as the King 
            Rat™ or Copyright Mouse™. Whatever your rodent needs, The Rodent 
            Store™ will always be happy to provide exactly what you are looking
            for at a price that can fit any budget, unless you want the 
            expensive rats. You can't really afford those, but we'll still allow
            you to look
        </p>
        <img src="images/communistrat.png" height="400" width="400">
    </div>
</body>
</html>
