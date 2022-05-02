<?php

include 'functions.php';

session_start();

if(!isset($_SESSION["CART"]))
    $_SESSION["CART"] = array();

$cart = $_SESSION["CART"];
header('Content-type:application/json;charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
if($method == 'GET')
{
    $data = $cart;
}
elseif ($method == 'POST')
{
    checkVariable('Action');
    $action = $_POST['Action'];

    if($action == "Add")
    {
        checkVariable('ProductID');
        checkVariable('Quantity');

        $productID = $_POST['ProductID'];
        $quantity = $_POST['Quantity'];

        $found = false;
        foreach ($cart as $key => $item) {
            if($item['productID'] == $productID)
            {
                $cart[$key]['quantity'] = $item['quantity'] + $quantity; 
                $found = true;
            }
        }

        if(!$found)
        {
            $productData = array("productID" => $productID, "quantity" => $quantity);
            array_push($cart, $productData);
        }
    }
    elseif($action == "Update")
    {
        checkVariable('ProductID');
        checkVariable('Quantity');

        $productID = $_POST['ProductID'];
        $quantity = $_POST['Quantity'];

        foreach ($cart as $key => $item) {
            if($item['productID'] == $productID)
                $cart[$key]['quantity'] = $quantity;
        }
    }
    elseif($action == "Remove")
    {
        checkVariable('ProductID');

        $productID = $_POST['ProductID'];

        foreach ($cart as $key => $item) {
            if($item['productID'] == $productID)
                unset($cart[$key]);
        }
    }
    elseif($action == "Clear")
    {
        foreach($cart as $key => $item)
            unset($cart[$key]);
    }
    else 
    {
        $data = array('error' => "Unknown 'Action'" );
    }
}

$data = $cart;
$_SESSION["CART"] = $cart;
echo json_encode($data);

if(isset($_POST["Redirect"]) && !empty($_POST["Redirect"]))
{
    $redirect = $_POST["Redirect"];
    header("Location:$redirect");
}

?>