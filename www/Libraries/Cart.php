<?php

include 'General.php';

function GetCart()
{
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php', 'GET');
}

function ClearCart()
{
    $postData = array('Action' => 'Clear' );
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php', 'POST', null, $postData);
}

function AddToCart(string $productID, int $quantity)
{
    $postData = array('Action' => 'Add', 'ProductID' => $productID, 'Quantity' => $quantity);
    $result = GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php', 'POST', null, $postData);
    return $result;
}

function RemoveToCart(string $productID)
{
    $postData = array('Action' => 'Remove', 'ProductID' => $productID);
    $result = GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php', 'POST', null, $postData);
    return $result;
}

function UpdateCart(string $productID, int $quantity)
{
    $postData = array('Action' => 'Update', 'ProductID' => $productID, , 'Quantity' => $quantity);
    $result = GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php', 'POST', null, $postData);
    return $result;
}

?>