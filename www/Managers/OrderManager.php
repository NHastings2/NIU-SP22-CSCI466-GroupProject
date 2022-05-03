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

}

echo json_encode($data);

if(isset($_POST["Redirect"]) && !empty($_POST["Redirect"]))
{
    $redirect = $_POST["Redirect"];
    header("Location:$redirect");
}


?>