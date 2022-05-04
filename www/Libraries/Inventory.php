<?php

include 'General.php';

function GetInventoryItems()
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php", "GET");
}

function GetInventoryItemByID(string $ID)
{
    $postData = array('ID' => $ID);
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php", "GET",  null, $postData);
}

function CreateInventoryItem(string $name, string $quantity, string $cost)
{
    $postData = array('Action' => 'Create', 'Name' => $name, 'Quantity' => $quantity, 'Cost' => $cost);
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php", "POST",  null, $postData);
}

function UpdateInventoryItem(string $ID, string $quantity)
{
    $postData = array('Action' => 'Update', 'ID' => $ID, 'Quantity' => $quantity);
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php", "POST",  null, $postData);
}

?>