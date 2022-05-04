<?php

include 'General.php';

function GetInventoryItems()
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php", "GET");
}

function GetInventoryItemByID(string $ID)
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php?ID=$ID", "GET");
}

?>