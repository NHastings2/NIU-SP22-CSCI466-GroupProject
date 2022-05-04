<?php

include 'General.php';

function GetCart()
{
    return GetData('http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php', 'GET');
}

?>