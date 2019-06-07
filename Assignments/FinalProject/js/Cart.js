/*
 * Cart to hold products in online store
 */
function Cart(cart) {
    "use strict";
    this.products = [];//Create products array
    this.taxrate = 0.08;
    if (arguments.length > 0) {//Copy constructor
        for (var i = 0; i < cart.products.length; ++i) {//Populate products array
            this.products.push(new Product(cart.products[i]))
        }
        this.total = cart.total;//Copy total
    } else {//Default constructor
        this.total = 0.0;//Set total to default 0
    }
}

//Update total
Cart.prototype.updateTotal = function () {
    "use strict";
    var ttl = 0.0;
    for(var i = 0; i < this.products.length; ++i) {
        ttl += this.products[i].getSub();
    }
    this.total = ttl * (1 + this.taxrate);
};

//Get total
Cart.prototype.getTotal = function () {
    "use strict";
    return this.total;
};

//Set products
Cart.prototype.setProducts = function (prodArr) {
    "use strict";
    this.products = prodArr;//Assign array
    this.updateTotal();
};

//Add product to cart
Cart.prototype.addProduct = function (prod) {
    "use strict";
    //Check if item already in cart
    for(var i = 0; i < this.products.length; ++i) {
        if(this.products[i].getId() === prod.getId()) {//If item is already in cart
            this.products[i].setOrdered(prod.getOrdered());//Just increase quantity
            this.updateTotal();//Update total
            return;
        }
    }
    //If not add item to cart
    this.products.push(prod);//Add item to cart
    this.updateTotal();//Update total
};

//Get products
Cart.prototype.getProducts = function () {
    "use strict";
    return this.products;
};

//Remove product based on product id
Cart.prototype.removeProduct = function (id) {
    "use strict";
    //Remove product if it exists
    for(var i = 0; i < this.products.length; ++i) {//Iterate through products
        if(this.products[i].getId() == id) {//If product id matches id to delete
            this.products.splice(i, 1);//Splice product from array
        }
    }
    //Update total
    this.updateTotal();
};

//Display all product info
Cart.prototype.dump = function () {
    "use strict";
    var output = "";
    for (var i = 0; i < this.products.length; ++i) {
        output += "Product: " + this.products[i].getName() + "<br/>";
        output += this.products[i].dump();
    }
    output += "Total: $" + this.total + "<br/><br/>";
    return output;
};

//Display Cart in receipt format
Cart.prototype.tableInsides = function () {
    //Set headers
    var output = "<tr><th>Image</th><th>Name</th><th>#Ordered</th>" + 
        "<th>Unit Price</th><th>Subtotal</th><th>Tax</th><th>Total</th></tr>";
    
    //Add each product as a table row
    for(var i = 0; i < this.products.length; ++i) {
        var id = this.products[i].getId();
        var imgPath = this.products[i].getImgPath();//Image path
        var name = this.products[i].getName();//Product name
        var ordered = this.products[i].getOrdered();//Number ordered
        var price = this.products[i].getPrice();//Unit price
        var sub = ordered * price;//Subtotal
        var taxAmnt = sub * this.taxrate;//Tax amount
        var ttl = sub + taxAmnt;//Total for product
        output += "<tr>";//Start product row
        output += "<td><img class='checkoutImg' src='" + imgPath + "' onclick='dropItem(\"" + id + "\");' /></td>";//Add image
        output += "<td>" + name + "</td>";//Add name
        output += "<td>" + ordered + "</td>";//Add number ordered
        output += "<td>$" + price.toFixed(2) + "</td>";//Add unit price
        output += "<td>$" + sub.toFixed(2) + "</td>";//Add subtotal
        output += "<td>$" + taxAmnt.toFixed(2) + "</td>";//Add tax amount
        output += "<td>$" + ttl.toFixed(2) + "</td>";//Add total
        output += "</tr>";//End product row
    }
    
    //Add total row
    output += "<tr><td colspan='6' style='text-align:right;'><h3>Total</h3></td><td> $" + this.getTotal().toFixed(2) + "</td></tr>";
    
    //Return insides of table
    return output;
};