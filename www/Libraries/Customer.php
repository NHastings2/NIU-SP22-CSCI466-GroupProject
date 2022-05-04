<?php

include 'General.php';

function GetCustomers()
{
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CustomerManager.php", "GET");
}

function GetCustomerByID(string $ID)
{
    $postData = array('ID' => $ID);
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CustomerManager.php", "GET",  null, $postData);
}

function CreateCustomer(string $name)
{
    $postData = array('Action' => 'Create', 'Name' => $name);
    return GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CustomerManager.php", "POST",  null, $postData);
}

?>