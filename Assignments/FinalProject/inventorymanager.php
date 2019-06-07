<DOCTYPE html>
<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isSet($_SESSION["type"]) || $_SESSION["type"] == "user") {
        header("location:index.php");
    }
    require_once('phpScripts/inventoryScript.php');
?>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <script src="js/Product.js"></script>
    <script src="js/Cart.js"></script>
    <script>
        function edit(id) {
            document.getElementById("product_id").value = id;
            document.forms.updateForm.submit();
        }
    </script>
    <link href="css/sitestyle.css" rel="stylesheet" type="text/css" />
    <title>Inventory Manager</title>
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
            <option value="inventorymanager.php" selected>Inventory Management</a></option>
            <option value="usermanager.php">User Management</a></option>
        </select>
    </nav>
    
    <!--Main Page div-->
    <div class="main">
        <!--Form for creating a new record-->
        <section>
            <fieldset><legend>Add Product</legend>
                <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
                    <label>Product Quantity</label><br/>
                    <input type="number" min="0" name="product_quantity" value="<?php echo $quantity;?>" /><span class="err"> *<?php echo $quantityErr?></span><br/>
                    <label>Product Name</label><br/>
                    <input type="text" name="product_name" value="<?php echo $name;?>" /><span class="err"> *<?php echo $nameErr?></span><br/>
                    <label>Product Category</label><br/>
                    <select name="product_category">
                        <option value="rat"  <?php if($cat == 'rat') echo 'selected';?> >Rat</option>
                        <option value="mouse"  <?php if($cat == 'mouse') echo 'selected';?> >Mouse</option>
                        <option value="squirrel" <?php if($cat == 'squirrel') echo 'selected';?> >Squirrel</option>
                    </select>
                    <span class="err"> *<?php echo $catErr?></span><br/>
                    <label>Product Image Path</label><br/>
                    <input type="text" name="product_img_path" value="<?php echo $img_path;?>" /><span class="err"> *<?php echo $img_pathErr?></span><br/>
                    <label>Product Price</label><br/>
                    <input type="number" step="0.01" min="0" name="product_price" value="<?php echo $price;?>" /><span class="err"> *<?php echo $priceErr?></span><br/>
                    <input type="submit" value="Add Product to Database" />
                    <?php echo $sqlMsg;?>
                </form>
            </fieldset>
        </section>
        
        <!--Display and edit product information-->
        <section>
            <!--iframe for editing products-->
            <div id="updateProd">
                <h2 class="center">Update Products</h2>
                <iframe name="editFrame" src="about:blank"></iframe>
            </div>

            <!--Current table of products-->
            <div>
                <?php
                    createTable();
                ?>
                <input id="reload" type="button" class="center" value="Reload Table" onclick="window.location.href=window.location.href;"/>
            </div>
        </section>
    </div>
</body>
</html>
