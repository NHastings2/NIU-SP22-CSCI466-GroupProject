<html><head><?php

include "Libraries/Customer.php";
include "Libraries/Order.php";

echo "<a href=\"Customers.php\">Back to customers page</a>";

$customer = GetCustomerByID($_GET["ID"]);
$json = json_decode($customer, true);

if (!empty($json)) {
    foreach ($json as $key => $value) {
        echo "<title>Game Shop {$value["Customer_Name"]}</title></head><body style=\"background-color:black; color:white;\">";
        echo "<h1>{$value["Customer_Name"]}</h1>";
        
        $orders = GetOrdersByCustomerID($value["Customer_ID"]);
        $ordersJson = json_decode($orders, true);

        $totalCost = 0;
        if (!empty($ordersJson)) {
            echo "<p>Orders:</p><table border bordercolor=\"white\">";
            foreach ($ordersJson as $orderKey => $orderValue) {
                echo "<tr><td>{$orderValue["Order_ID"]}</td>
                    <td>{$orderValue["Order_Date"]}</td>
                    <td>{$orderValue["Order_Status"]}</td>
                    <td>{$orderValue["Total_Cost"]}</td>
                    <td>{$orderValue["Notes"]}</td>
                    <td><a href=\"Order.php?ID={$orderValue["Order_ID"]}\">Order page</a></td></tr>";
                $totalCost += $orderValue["Total_Cost"];
            }
            echo "</table>";
        } else {
            echo "<p>This customer has no orders.</p>";
        }
        echo "<p>The total cost for all orders is: \${$orderValue["Total_Cost"]}";
    }
} else {
    echo "That item does not exist!";
}