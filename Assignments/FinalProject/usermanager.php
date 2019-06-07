<!DOCTYPE html>
<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isSet($_SESSION["type"]) || $_SESSION["type"] == "user") {
        header("location:index.php");
    }
?>
<html lang="">
<head>
    <meta charset="utf-8">
    <link href="css/sitestyle.css" rel="stylesheet" type="text/css" />
    <title>User Manager</title>
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
            <option value="administration.php">Admin Page</a></option>
            <option value="inventorymanager.php">Inventory Management</a></option>
            <option value="usermanager.php"> selectedUser Management</a></option>
        </select>
    </nav>
    
    <div class="main">
        
    </div>
</body>
</html>
