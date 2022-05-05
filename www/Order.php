<html><head><title>Game Shop Order</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Order.php";

$item = GetOrderByID($_GET["ID"]);
$json = json_decode($item, true);

if (!empty($json)) {
    foreach ($json as $key => $value) {
        echo "<h>Order number {$value["Order_ID"]}</h>
                <p>Ordered on {$value["Order_Date"]}</p>
                <p>Ship to {$value["Shipping_Address"]}</p>
                <p>Tracking number: {$value["Tracking_Num"]}</p>
                <p>Order status: {$value["Order_Status"]}</p>
                <p>Total Cost: {$value["Total_Cost"]}</p>
                <p>Notes: {$value["Notes"]}</p>
                <p>Customer ID: {$value["Customer_ID"]}</p>";
        echo "<table><th>Item ID</th><th>Quantity</th><th>Item Page</th>";
        foreach ($value["Order_Items"] as $itemKey => $itemValue) {
            echo "<tr><td>{$itemValue["ProductID"]}</td>
                    <td>{$itemValue["Quantity"]}</td>
                    <td><a href=\"Item.php?ID={$itemValue["ProductID"]}\">Item page</a></td></tr>";
        }
        echo "</table>";
        echo "<br/><br/>Update order status:<form method=\"POST\" action=\"./Managers/OrderManager.php\">
                <input type=\"hidden\" name=\"Action\" value=\"Update\"/>
                <select name=\"Status\"><option value=\"Purchased\">Purchased</option><option value=\"Shipped\">Shipped</option></select>
                <input type=\"submit\" value=\"Update status\"/>
                <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Order.php?ID={$_GET["ID"]}\"/></form>";
    }
} else {
    echo "That order does not exist!";
}

?></body></html>