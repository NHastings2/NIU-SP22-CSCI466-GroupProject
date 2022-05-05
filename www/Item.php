<html><head><?php

include "Libraries/Inventory.php";

$item = GetInventoryItemByID($_GET["ID"]);
$json = json_decode($item, true);

if (!empty($json)) {
    foreach ($json as $key => $value) {
        echo "<title>Game Shop {$value["Product_Name"]}</title></head><body style=\"background-color:black; color:white;\">";
        echo "<h>{$value["Product_Name"]}</h>
                <p>This product costs \${$value["Product_Cost"]}</p>
                <p>We currently have {$value["Product_in_Stock"]} of this product in stock</p>
                <p>Product ID: {$value["Product_ID"]}</p>";
        echo "<br/><br/>Quantity:<form method=\"POST\" action=\"./Managers/CartManager.php\">
                <input type=\"hidden\" name=\"Action\" value=\"Add\"/>
                <input type=\"hidden\" name=\"ProductID\" value=\"{$value["Product_ID"]}\"/>
                <input type=\"number\" name=\"Quantity\" placeholder=\"Quantity\" min=\"1\" max=\"{$value["Product_in_Stock"]}\"/>
                <input type=\"submit\" value=\"Add to Cart!\"/>
                <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Cart.php\"/></form>";
    }
}

?></body></html>