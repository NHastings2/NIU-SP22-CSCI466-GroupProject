<html><head><title>NED Inventory</title></head><body><?php

include "Libraries/Inventory.php";

$inventory = GetInventoryItems();
$json = json_decode($inventory, true);

if (!empty($json)) {
    echo "<table border><tr><th>Name</th><th>Quantity</th><th>Price</th><th>Product Page</th></tr>";
    foreach ($json as $key => $value) {
        echo "<tr><td>{$value["Product_Name"]}</td>
                <td>{$value["Product_in_Stock"]}</td>
                <td>{$value["Product_Cost"]}</td>
                <td><a href=\"Item.php?ID={$value["Product_ID"]}\">Product page</a></td></tr>";
    }
    echo "</table>";
}

?></body></html>