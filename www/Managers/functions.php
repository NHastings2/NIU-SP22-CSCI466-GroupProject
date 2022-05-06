<?php

function checkVariable(string $variableName)
{
    if(!isset($_POST[$variableName]) || empty($_POST[$variableName]))
    {
        $data = array("error" => "Missing '$variableName'");
        echo json_encode($data);
        exit();
    }
}

function GetData(string $URL, string $method, array $cookies=NULL, array $postPayload=NULL)
{
    $curl = curl_init($URL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if($method == "POST")
    {
        curl_setopt($curl, CURLOPT_POST, true);     
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postPayload); 
    }

    

    if(isset($_COOKIE['PHPSESSID']) && !empty($_COOKIE['PHPSESSID']))
    {
        $PHPSESS = $_COOKIE['PHPSESSID'];
        curl_setopt($curl, CURLOPT_COOKIE, "PHPSESSID=$PHPSESS");
    }

    if(isset($cookies) && !empty($cookies))
    {
        foreach ($cookies as $key => $cookie) {
            $cookieKey = $cookie['Key'];
            $cookieValue = $cookie['Value'];

            curl_setopt($curl, CURLOPT_COOKIE, "$cookieKey=$cookieValue");
        }
    }

    $resp = curl_exec($curl);
    return $resp;
}

function ExecuteSQL(string $Command, array $data=array())
{
    include "/home/data/www/z1929228/php.inc/secrets.php";
    $dbname = 'z1929228';

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOexception $e) {
        die("        <p>Connection to database failed: ${$e->getMessage()}</p>\n");
    }

    try {
        $statement = $pdo->prepare($Command);
        $statement->execute($data);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOexception $e) {
        die("        <p>Query failed: ${$e->getMessage()}</p>\n");
    }

    return $rows;
}

?>