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
        if(isset($postPayload) && !empty($postPayload))
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postPayload));
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
    echo $resp;
}

?>