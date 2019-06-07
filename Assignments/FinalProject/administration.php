<!DOCTYPE html>
<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isSet($_SESSION["type"]) || $_SESSION["type"] == "user") {
    header("location:index.php");
}
?>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="css/sitestyle.css" rel="stylesheet" type="text/css" />
    <title>Admin Page</title>
</head>

<body>
    <!--Header-->
    <header>
        <img src="images/ratbanner.png" alt="Rodent Store Banner" />
    </header>
    
    <!--Navigation-->
    <nav>
        <select onclick="window.location.href=this.value;">
            <option value="index.php">Back To Store</option>
            <option value="administration.php" selected>Admin Page</a></option>
            <option value="inventorymanager.php">Inventory Management</a></option>
            <option value="usermanager.php">User Management</a></option>
        </select>
    </nav>
    
    <!--Main Area-->
    <div class="main">
        <h1>Administration Page</h1>
        <h2>Use The Links On The Left To Manage Users Or Products</h2>
    </div>
</body>
</html>
