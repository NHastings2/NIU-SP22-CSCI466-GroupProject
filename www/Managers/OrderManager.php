<?php

include '/home/data/www/z1929228/php.inc/secrets.php';
include 'functions.php';
$dbname = 'z1929228';

function gen_uid($l=5)
{
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 10, $l);
}

header('Content-type:application/json;charset=utf-8');

$data = "";

$method = $_SERVER['REQUEST_METHOD'];
if($method == "GET")
{
    $orders = "";
    if(isset($_GET["ID"]) && !empty($_GET['ID']))
    {
        $orders = ExecuteSQL("SELECT * FROM ORDERS WHERE Order_ID = ?", array($_GET["ID"]));
    }
    elseif (isset($_GET["CustomerID"]) && !empty($_GET['CustomerID'])) 
    { 
        $orders = ExecuteSQL("SELECT * FROM ORDERS WHERE Customer_ID = ?", array($_GET["CustomerID"]));
    }
    else
    { 
        $orders = ExecuteSQL("SELECT * FROM ORDERS");
    }

    foreach ($orders as $orderKey => $order) 
    {
        $orderItems = array();
        $orderQuery = ExecuteSQL("SELECT * FROM ORDER_PRODUCTS WHERE Order_ID = ?", array($order['Order_ID']));
        foreach ($orderQuery as $itemKey => $orderItem) 
        {
            array_push($orderItems, array('ProductID' => $orderItem['Product_ID'], 'Quantity' => $orderItem['QTY']));
        }

        $orders[$orderKey][] = ['Items' => $orderItems];
    }

    $data = $orders;
}
else if($method == "POST")
{
    checkVariable('Action');

    $action = $_POST['Action'];
    if($action == "Create")
    {
        date_default_timezone_set('America/Chicago');

        checkVariable('CC_Num');
        checkVariable('ShippingAddress');
        checkVariable('CustomerID');

        $orderDate = date('Y-m-d');
        $CCNum = $_POST['CC_Num'];
        $ShippingAddress = $_POST['ShippingAddress'];
        $TrackingNum = gen_uid(10);
        $OrderStatus = "P";
        $Customer_ID = $_POST["CustomerID"];

        $Order_Total = 0;
        $currentCart = json_decode(GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php", "GET"));
        if(count($currentCart) > 0)
        {
            foreach ($currentCart as $key => $item) {
                $itemID = $item["productID"];
                $storeItem = json_decode(GetData("https://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php?ID=$itemID", "GET"));

                $Order_Total += ($storeItem['Product_Cost'] * $item['quantity']);
            }

            $queryData = array($orderDate, $CCNum, $ShippingAddress, $TrackingNum, $OrderStatus, $Order_Total, $Customer_ID);
            ExecuteSQL("INSERT INTO ORDER (Order_Date, CC_Num, Shipping_Address, Tracking_Num, Order_Status, Total_Cost, Customer_ID) VALUES (?,?,?,?,?,?,?);", $queryData);

            $orderData = ExecuteSQL("SELECT * FROM ORDERS WHERE Customer_ID = ? ORDER BY Order_Date DESC LIMIT 1;", array($Customer_ID));  

            $orderID = $orderData[0]['Order_ID'];
            foreach ($currentCart as $key => $item) {
                ExecuteSQL("INSERT INTO ORDER_PRODUCTS (Order_ID, Product_ID, QTY) VALUES (?,?,?)", array($orderID, $item['productID'], $item['quantity']));
            }

            $data = ExecuteSQL("SELECT * FROM ORDERS WHERE Order_ID=?", array($orderID));
        }
        else 
        {
            $data = array('error' => "No Items in Cart" );
        }
    }
    elseif ($action == "Update") 
    {
        checkVariable("ID");

        if(isset($_POST["Notes"]) && !empty($_GET['Notes']))
            ExecuteSQL("UPDATE ORDERS SET Notes=? WHERE Order_ID=?", array($_POST['Notes'], $_POST['ID']));
        elseif(isset($_POST["Status"]) && !empty($_GET['Status']))
            ExecuteSQL("UPDATE ORDERS SET Order_Status=? WHERE Order_ID=?", array($_POST['Status'], $_POST['ID']));

        $data = ExecuteSQL("SELECT * FROM ORDERS WHERE Order_ID=?", array($_POST['ID']));
    }
    else 
    {
        $data = array('error' => "Unknown 'Action'" );
    }
}

echo json_encode($data);

if(isset($_POST["Redirect"]) && !empty($_POST["Redirect"]))
{
    $redirect = $_POST["Redirect"];
    header("Location:$redirect");
}

?>