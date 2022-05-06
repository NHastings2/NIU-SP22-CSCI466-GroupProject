<html><head><title>Game Shopping Cart</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Inventory.php";
include "Libraries/Cart.php";

echo "<a href=\"..\">Back to home page</a>";

$cart = GetCart();
$json = json_decode($cart, true);

if (!empty($json)) {
    echo "<table border bordercolor=\"white\"><tr><th>Name</th><th>Quantity Ordered</th><th>Price</th><th>Item Page</th><th>Update Product Count</th><th>Remove product</th></tr>";
    $totalCost = 0;
    foreach ($json as $key => $value) {
        $item = GetInventoryItemByID($value["productID"]);
        $itemJson = json_decode($item, true);

        if (!empty($itemJson)) {
            foreach ($itemJson as $itemKey => $itemValue) {
                echo "<tr><td>{$itemValue["Product_Name"]}</td>
                        <td>{$value["quantity"]}</td>
                        <td>\${$itemValue["Product_Cost"]}</td>
                        <td><a href=\"Item.php?ID={$itemValue["Product_ID"]}\">Item page</a></td>
                        <td><form method=\"POST\" action=\"./Managers/CartManager.php\">
                                <input type=\"hidden\" name=\"Action\" value=\"Update\"/>
                                <input type=\"hidden\" name=\"ProductID\" value=\"{$itemValue["Product_ID"]}\"/>
                                <input type=\"number\" name=\"Quantity\" placeholder=\"Quantity\" min=\"1\" max=\"{$itemValue["Product_in_Stock"]}\"/>
                                <input type=\"submit\" value=\"Change Order Amount\"/>
                                <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Cart.php\"/></form></td>
                        <td><form method=\"POST\" action=\"./Managers/CartManager.php\">
                                <input type=\"hidden\" name=\"Action\" value=\"Remove\"/>
                                <input type=\"hidden\" name=\"ProductID\" value=\"{$itemValue["Product_ID"]}\"/>
                                <input type=\"submit\" value=\"Remove From Cart\"/>
                                <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Cart.php\"/></form></td></tr>";
                $totalCost += $value["quantity"] * $itemValue["Product_Cost"];
            }
        }
    }
    echo "</table>";
    echo "<br/>Your current order will cost \$$totalCost<form method=\"POST\" action=\"./Managers/OrderManager.php\">
            <input type=\"hidden\" name=\"Action\" value=\"Create\"/>
            <input type=\"number\" name=\"CC_Num\" placeholder=\"Last 4 CC digits\"/>
            <input type=\"text\" name=\"ShippingAddress\" placeholder=\"Shipping address\"/>
            <input type=\"number\" name=\"CustomerID\" placeholder=\"Customer ID\"/>
            <input type=\"submit\" value=\"Order!\"/>
            <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Cart.php\"/></form>";
} else {
    echo "You have no items in your cart!";
}

?></body></html>