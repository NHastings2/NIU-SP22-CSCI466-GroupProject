<html><head><?php

include "Libraries/Customer.php";
include "Libraries/Order.php";

$customer = GetCustomerByID($_GET["ID"]);
$json = json_decode($customer, true);

if (!empty($json)) {
    foreach ($json as $key => $value) {
        echo "<title>Game Shop {$value["Customer_Name"]}</title></head><body style=\"background-color:black; color:white;\">";
        echo "<h1>{$value["Customer_Name"]}</h1>";
        
        $orders = GetOrdersByCustomerID($value["Customer_ID"]);
        $ordersJson = json_decode($orders, true);

        if (!empty($ordersJson)) {
            echo "<table border bordercolor=\"white\">";
            foreach ($ordersJson as $orderKey => $orderValue) {
                echo "<tr><td>{$orderValue["Order_ID"]}</td>
                    <td>{$orderValue["Order_Date"]}</td>
                    <td>{$orderValue["Order_Status"]}</td>
                    <td>{$orderValue["Notes"]}</td>
                    <td><a href=\"Order.php?ID={$orderValue["Order_ID"]}\">Order page</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>This customer has no orders.</p>";
        }
    }
} else {
    echo "That item does not exist!";
}