<html><head><title>Game Shop Customers</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Customer.php";

$customers = GetCustomers();
$json = json_decode($customers, true);

if (!empty($json)) {
    echo "<table border bordercolor=\"white\"><tr><th>Customer ID</th><th>Customer Name</th><th>Customer page</th></tr>";
    foreach ($json as $key => $value) {
        echo "<tr><td>{$value["Customer_ID"]}</td>
                <td>{$value["Customer_Name"]}</td>
                <td><a href=\"Customer.php?ID={$value["Customer_ID"]}\">Customer page</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "There are no customers!";
}

?></body></html>