<?php

include '/home/data/www/z1929228/php.inc/secrets.php';
include 'functions.php';

header('Content-type:application/json;charset=utf-8');

$data = "";

$method = $_SERVER['REQUEST_METHOD'];
if($method == "GET")
{
    if(isset($_GET['ID']) && !empty($_GET['ID']))
        $data = ExecuteSQL("SELECT * FROM CUSTOMER WHERE Customer_ID = ?", array($_GET['ID']));
    else
        $data = ExecuteSQL("SELECT * FROM CUSTOMER");
}
elseif($method == "POST")
{
    checkVariable('Action');

    $action = $_POST['Action'];
    if($action == "Create")
    {
        checkVariable('Name');

        $result = ExecuteSQL("INSERT INTO CUSTOMER (Customer_Name) VALUES (?)", array($_POST['Name']));
        print_r($result);

        $data = ExecuteSQL("SELECT * FROM CUSTOMER");
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