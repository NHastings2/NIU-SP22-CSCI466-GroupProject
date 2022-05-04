<?php

include 'General.php';

function GetOrders()
{
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/OrderManager.php', 'GET');
}

function GetOrderByID(string $ID)
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/OrderManager.php?ID=$ID", 'GET');
}

function GetOrderByCustomerID(string $CustomerID)
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/OrderManager.php?CustomerID=$CustomerID", 'GET');
}

?>