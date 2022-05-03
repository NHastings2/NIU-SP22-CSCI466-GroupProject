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
        $sql = "SELECT * FROM ORDERS WHERE Order_ID = ?";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute([$_GET['ID']]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }

        $data = $rows;
    }
    elseif (isset($_GET["CustomerID"]) && !empty($_GET['CustomerID'])) 
    {
        $sql = "SELECT * FROM ORDERS WHERE Customer_ID = ?";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute([$_GET['CustomerID']]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }

        $data = $rows;
    }
    else 
    {
        $sql = "SELECT * FROM ORDERS";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }

        $data = $rows;
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

        $cookies = array(
            {
                'Key' => 'PHPSESSID',
                'Value' => $_COOKIE['PHPSESSID']
            });
        $currentCart = GetData("http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php", "GET", $cookies);

        $sql = "INSERT INTO ORDER (Order_Date, CC_Num, Shipping_Address, Tracking_Num, Order_Status, Total_Cost, Customer_ID) VALUES (?,?,?,?,?,?,?);";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute(array($orderDate, $CCNum, $ShippingAddress, $TrackingNum, $OrderStatus, , $Customer_ID));
        } catch (PDOexception $e) {
            echo "        <p>Query failed: ${$e->getMessage()}</p>\n";
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