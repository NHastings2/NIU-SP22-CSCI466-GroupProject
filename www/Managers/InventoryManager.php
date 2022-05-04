<?php

include '/home/data/www/z1929228/php.inc/secrets.php';
include 'functions.php';
$dbname = 'z1929228';

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
        $data = ExecuteSQL("SELECT * FROM PRODUCT WHERE Product_ID = ?", array($_GET['ID']));
    else
        $data = ExecuteSQL("SELECT * FROM PRODUCT");
}
elseif($method == "POST")
{
    checkVariable('Action');

    $action = $_POST['Action'];
    if($action == "Create")
    {
        checkVariable('Name');
        checkVariable('Quantity');
        checkVariable('Cost');

        $Name = $_POST['Name'];
        $Quantity = $_POST['Quantity'];
        $Cost = $_POST['Cost'];

        $queryData = array($Name, $Quantity, $Cost);
        ExecuteSQL("INSERT INTO PRODUCT (Product_Name, Product_in_Stock, Product_Cost) VALUES (?,?,?);", $queryData);

        $data = ExecuteSQL("SELECT * FROM PRODUCT");
    }
    elseif($action == "Update")
    {
        checkVariable('ID');
        checkVariable('Quantity');

        $ID = $_POST['ID'];
        $Quantity = $_POST['Quantity'];

        ExecuteSQL("UPDATE PRODUCT SET Product_in_Stock=? WHERE Product_ID=?", array($Quantity, $ID));

        $data = ExecuteSQL("SELECT * FROM PRODUCT"); 
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