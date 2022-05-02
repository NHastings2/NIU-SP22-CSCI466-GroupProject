<?php

session_start();

$cart = $_SESSION["CART"];

$method = $_SERVER['REQUEST_METHOD'];
if($method == 'GET')
{
    $data = $cart;
}
elseif ($method == 'POST')
{
    $productID = $_POST['ProductID'];
    $quantity = $_POST['Quantity'];

    $productData = array("productID" => $productID, "quantity" => $quantity);
    array_push($cart, $productData);

    $_SESSION["CART"] = $cart;
}
elseif ($method == 'PATCH')
{
    $productID = $_POST['ProductID'];
    $quantity = $_POST['Quantity'];

    foreach ($cart as $item) {
        if($item['productID'] == $productID)
            $item['quantity'] = $quantity;
    }

    $_SESSION["CART"] = $cart;
}
else if($method == 'DELETE')
{
    $productID = $_GET['ProductID'];

    foreach ($cart as $item) {
        if($item['productID'] == $productID)
            unset($cart[$item]);
    }

    $_SESSION["CART"] = $cart;
}

header('Content-type:application/json;charset=utf-8');
echo json_encode($data);

session_write_close();

?>