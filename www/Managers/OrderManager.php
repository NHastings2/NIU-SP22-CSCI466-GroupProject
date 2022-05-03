<?php

include '/home/data/www/z1929228/php.inc/secrets.php';
include 'functions.php';
$dbname = 'z1929228';

function gen_uid($l=5){
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 10, $l);
 }

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOexception $e) {
   die("        <p>Connection to database failed: ${$e->getMessage()}</p>\n");
}

header('Content-type:application/json;charset=utf-8');

$data = "";

$method = $_SERVER['REQUEST_METHOD'];
if($method == "GET")
{
    if(isset($_GET["ID"]) && !empty($_GET['ID']))
    {
        $result = ExecuteSQL("SELECT * FROM ORDERS WHERE Order_ID = ?", array($_GET["ID"]));
        $data = $result;

        // $sql = "SELECT * FROM ORDERS WHERE Order_ID = ?";
        // try {
        //     $statement = $pdo->prepare($sql);
        //     $statement->execute([$_GET['ID']]);
        //     $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        // } catch (PDOexception $e) {
        //     die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        // }

        // $data = $rows;
    }
    elseif (isset($_GET["CustomerID"]) && !empty($_GET['CustomerID'])) 
    {
        $result = ExecuteSQL("SELECT * FROM ORDERS WHERE Customer_ID = ?", array($_GET["CustomerID"]));
        $data = $result;

        // $sql = "SELECT * FROM ORDERS WHERE Customer_ID = ?";
        // try {
        //     $statement = $pdo->prepare($sql);
        //     $statement->execute([$_GET['CustomerID']]);
        //     $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        // } catch (PDOexception $e) {
        //     die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        // }

        // $data = $rows;
    }
    else 
    {
        $result = ExecuteSQL("SELECT * FROM ORDERS");
        $data = $result;

        // $sql = "SELECT * FROM ORDERS";
        // try {
        //     $statement = $pdo->prepare($sql);
        //     $statement->execute();
        //     $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        // } catch (PDOexception $e) {
        //     die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        // }

        // $data = $rows;
    }
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
        foreach ($currentCart as $key => $item) {
            $itemID = $item["productID"];
            $storeItem = json_decode(GetData("https://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/InventoryManager.php?ID=$itemID", "GET"));

            $Order_Total += ($storeItem['Product_Cost'] * $item['quantity']);
        }

        $sql = "INSERT INTO ORDER (Order_Date, CC_Num, Shipping_Address, Tracking_Num, Order_Status, Total_Cost, Customer_ID) VALUES (?,?,?,?,?,?,?);";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute(array($orderDate, $CCNum, $ShippingAddress, $TrackingNum, $OrderStatus, $Order_Total, $Customer_ID));
        } catch (PDOexception $e) {
            echo "        <p>Query failed: ${$e->getMessage()}</p>\n";
        }

        $sql = "SELECT * FROM ORDERS WHERE Customer_ID = ? ORDER BY Order_Date DESC LIMIT 1;";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute(array($Customer_ID));
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            $data = $rows;
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }   

        $orderID = $rows[0]['Order_ID'];
        foreach ($currentCart as $key => $item) {
            $sql = "INSERT INTO ORDER_PRODUCTS (Order_ID, Product_ID, QTY) VALUES (?,?,?)";
            try {
                $statement = $pdo->prepare($sql);
                $statement->execute(array($orderID, $item['productID'], $item['quantity']));
            } catch (PDOexception $e) {
                echo "        <p>Query failed: ${$e->getMessage()}</p>\n";
            }
        }

    }
    elseif ($action == "Update") 
    {
        
    }
}

echo json_encode($data);

if(isset($_POST["Redirect"]) && !empty($_POST["Redirect"]))
{
    $redirect = $_POST["Redirect"];
    header("Location:$redirect");
}


?>