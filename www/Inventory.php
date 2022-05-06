<html><head><title>Game Shop Inventory</title></head><body style="background-color:black; color:white;"><?php

include "Libraries/Inventory.php";

echo "<a href=\".\">Back to home page</a>";

$inventory = GetInventoryItems();
$json = json_decode($inventory, true);

if (!empty($json)) {
    echo "<table border bordercolor=\"white\"><tr><th>Name</th><th>Quantity</th><th>Price</th><th>Item Page</th></tr>";
    foreach ($json as $key => $value) {
        echo "<tr><td>{$value["Product_Name"]}</td>
                <td>{$value["Product_in_Stock"]}</td>
                <td>\${$value["Product_Cost"]}</td>
                <td><a href=\"Item.php?ID={$value["Product_ID"]\"} style=\"color: white\">Item page</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "The inventory is empty!";
}

?></body></html>