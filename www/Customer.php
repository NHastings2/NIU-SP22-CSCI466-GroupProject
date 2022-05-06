<html><head><?php

include "Libraries/Customer.php";
include "Libraries/Order.php";

echo "<a style=\"color:#ADD8E6\" href=\"Customers.php\">Back to customers page</a>";

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
            echo "<p>Orders:</p><table border bordercolor=\"white\"><tr><th>Order ID</th><th>Date ordered</th><th>Status</th><th>Cost</th><th>Notes</th><th>Order page</th></tr>";
            foreach ($ordersJson as $orderKey => $orderValue) {
                echo "<tr><td>{$orderValue["Order_ID"]}</td>
                    <td>{$orderValue["Order_Date"]}</td>
                    <td>{$orderValue["Order_Status"]}</td>
                    <td>\${$orderValue["Total_Cost"]}</td>
                    <td>{$orderValue["Notes"]}</td>
                    <td><a style=\"color:#ADD8E6\" href=\"Order.php?ID={$orderValue["Order_ID"]}\">Order page</a></td></tr>";
                $totalCost += $orderValue["Total_Cost"];
            }
            echo "</table>";
        } else {
            echo "<p>This customer has no orders.</p>";
        }
        echo "<p>The total cost for all orders is: \$$totalCost";
    }
} else {
    echo "That item does not exist!";
}