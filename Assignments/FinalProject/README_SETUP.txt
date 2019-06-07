Two Options to test site
1.) The project is hosted online at sebastianhall.x10host.com/StoreFront. This is easier, quicker, and more convenient than setting it up locally.

2.) Host the project locally on your computer. Place the project in the xampp folder on your machine. Default C:\xampp\htdocs for windows and /opt/lampp/htdocs for linux. Turn on the apache server and MySql server within xampp and then run the sql file within the projects "sql" folder somewhere you can execute sql commands like phpmyadmin or mysqlworkbench. Then you can access the site in a brower from localhost


Site Access
To access the administrative side of the website login as an admin with username: "SebastianHall69" and password: "Password69".
To login as a user you can use username: "RatBuyer" password: "ratbuyer" or create your own login through the login page


Grading Notes
1.) Objects are used for product and cart.

2.) Cart can delete objects and empty cart from cart page, modify quantity from the shopping page

3.) Checkout process uses regex to check forms, but not luhn algorithm

4.) The shop products area is created by echoing a javascript script from php so it is generated using directly javascript. Can be seen in phpScripts/prodTableScript.php from root directory
