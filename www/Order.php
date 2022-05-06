<html><head><title>Game Shop Order</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Order.php";

echo "<a href=\"Orders.php\">Back to orders</a>";

$order = GetOrderByID($_GET["ID"]);
$json = json_decode($order, true);

if (!empty($json)) {
    foreach ($json as $key => $value) {
        echo "<table border bordercolor=\"white\"><tr><td>Order number</td><td>{$value["Order_ID"]}</td>
                <tr><td>Ordered on</td><td>{$value["Order_Date"]}</td>
                <tr><td>Ship to</td><td>{$value["Shipping_Address"]}</td></tr>
                <tr><td>Tracking number</td><td>{$value["Tracking_Num"]}</td></tr>
                <tr><td>Order status</td><td>{$value["Order_Status"]}</td></tr>
                <tr><td>Total Cost</td><td>{$value["Total_Cost"]}</td></tr>
                <tr><td>Notes</td><td>{$value["Notes"]}</td></tr>
                <tr><td>Customer ID</td><td>{$value["Customer_ID"]}</td></tr>";
        echo "<table border bordercolor=\"white\"><th>Item ID</th><th>Quantity</th><th>Item Page</th>";
        foreach ($value["Order_Items"] as $itemKey => $itemValue) {
            echo "<tr><td>{$itemValue["ProductID"]}</td>
                    <td>{$itemValue["Quantity"]}</td>
                    <td><a href=\"Item.php?ID={$itemValue["ProductID"]}\">Item page</a></td></tr>";
        }
        echo "</table>";
        echo "<br/><br/>Update order status:<form method=\"POST\" action=\"./Managers/OrderManager.php\">
                <input type=\"hidden\" name=\"ID\" value=\"{$value["Order_ID"]}\"/>
                <input type=\"hidden\" name=\"Action\" value=\"Update\"/>
                <select name=\"Status\"><option value=\"P\">Purchased</option><option value=\"S\">Shipped</option></select>
                <input type=\"submit\" value=\"Update status\"/>
                <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Order.php?ID={$_GET["ID"]}\"/></form>";
        echo "<br/><br/>Update order notes:<form method=\"POST\" action=\"./Managers/OrderManager.php\">
                <input type=\"hidden\" name=\"ID\" value=\"{$value["Order_ID"]}\"/>
                <input type=\"hidden\" name=\"Action\" value=\"Update\"/>
                <input type=\"text\" name=\"Notes\" placeholder=\"New note\">
                <input type=\"submit\" value=\"Update status\"/>
                <input type=\"hidden\" name=\"Redirect\" value=\"http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Order.php?ID={$_GET["ID"]}\"/></form>";
    }
} else {
    echo "That order does not exist!";
}

?></body></html>