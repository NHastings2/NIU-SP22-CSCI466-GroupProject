<html><head><title>Game Shop Customers</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Customer.php";

echo "<a style=\"color:#ADD8E6\" href=\".\">Back to home page</a>";

$customers = GetCustomers();
$json = json_decode($customers, true);

if (!empty($json)) {
    echo "<table border bordercolor=\"white\"><tr><th>Customer Name</th><th>Customer ID</th><th>Customer page</th></tr>";
    foreach ($json as $key => $value) {
        echo "<tr><td>{$value["Customer_Name"]}</td>
                <td>{$value["Customer_ID"]}</td>
                <td><a style=\"color:#ADD8E6\" href=\"Customer.php?ID={$value["Customer_ID"]}\">Customer page</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "There are no customers!";
}

?></body></html>