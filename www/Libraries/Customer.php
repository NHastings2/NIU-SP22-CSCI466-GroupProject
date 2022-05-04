<?php

include 'General.php';

function GetCustomers()
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CustomerManager.php", "GET");
}

function GetCustomerByID(string $ID)
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CustomerManager.php?ID=$ID", "GET");
}

?>