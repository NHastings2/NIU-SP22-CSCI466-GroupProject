<?php

include 'General.php';

function GetOrders()
{
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/OrderManager.php', 'GET');
}

function GetOrderByID(string $ID)
{
    $postData = array('ID' => $ID );
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/OrderManager.php', 'GET', null, $postData);
}

function GetOrderByCustomerID(string $CustomerID)
{
    $postData = array('CustomerID' => $CustomerID);
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/OrderManager.php', 'GET', null, $postData);
}

?>