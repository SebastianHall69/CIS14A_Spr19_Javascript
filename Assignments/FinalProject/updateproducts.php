<!DOCTYPE html>
<html lang="">
    <?php
        require_once('phpScripts/updateScript.php');
    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/sitestyle.css" rel="stylesheet" type="text/css" />
    <title>Update <?php echo $name;?></title>
</head>

<body class="center">
    <!--Header-->
    <h3><?php echo $name; ?></h3>
    
    <!--Form to update product infomation-->
    <div>
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
            <input type="submit" value="Update Product" />
            <input type="hidden" name="update" value="update" />
            <?php echo $sqlMsg;?>
        </form>
    </div>
    
    <!--Form to delete product-->
    <hr>
    <form id="deleteForm" method="post" action="phpScripts/deleteScript.php">
        <input type="submit" value="Delete Product" />
        <input type="hidden" value="<?php echo $id;?>" name="product_id" />
        <input type="hidden" value="<?php echo $name;?>" name="product_name" />
    </form>
</body>
</html>
