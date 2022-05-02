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
    {
        $sql = "SELECT * FROM PRODUCT WHERE Product_ID = ?";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute([$_GET['ID']]);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }

        $data = $rows;
    }
    else
    {
        $sql = "SELECT * FROM PRODUCT";
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

        $sql = "INSERT INTO PRODUCT (Product_Name, Product_in_Stock, Product_Cost) VALUES ('?','?','?');";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute([$Name, $Quantity, $Cost]);
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }

        $sql = "SELECT * FROM PRODUCT;";
        try {
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            $data = $rows;
        } catch (PDOexception $e) {
            die("        <p>Query failed: ${$e->getMessage()}</p>\n");
        }

       
    
    }
    elseif($action == "Update")
    {
        
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