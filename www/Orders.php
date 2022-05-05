<html><head><title>Game Shop Orders</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Order.php";

$orders = GetOrders();
$json = json_decode($orders, true);

if (!empty($json)) {
    echo "<table border bordercolor=\"white\"><tr><th>Order ID</th><th>Date Ordered</th><th>Order Status</th><th>Notes</th></tr>";
    foreach ($json as $key => $value) {
        echo "<tr><td>{$value["Order_ID"]}</td>
                <td>{$value["Order_Date"]}</td>
                <td>{$value["Order_Status"]}</td>
                <td>{$value["Notes"]}</td>
                <td><a href=\"Order.php?ID={$value["Order_ID"]}\">Order page</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "There are no outstanding orders";
}

?></body></html>