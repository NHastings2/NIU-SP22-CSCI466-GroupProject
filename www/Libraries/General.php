<?php

if(!function_exists('GetData'))
{
    function GetData(string $URL, string $method, array $cookies=NULL, array $Payload=NULL)
    {
        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if($method == "POST")
        {
            curl_setopt($curl, CURLOPT_POST, true);  
        }

        if(isset($Payload) && !empty($Payload))
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($Payload));

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
}

?>