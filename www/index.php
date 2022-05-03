<form method="POST" action="http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php">
    <input type="hidden" id="Action" name="Action" value="Add">
    <input type="hidden" id="Redirect" name="Redirect" value="http://students.cs.niu.edu/~z1929228/csci466/group_project/www/">
    <input type="text" id="ProductID" name="ProductID"><br>
    <input type="text" id="Quantity" name="Quantity"><br>
    <button type="submit">Submit</button>
</form>

<?php
    date_default_timezone_set("America/Chicago");
    $time = time('h:mm:ss');
    echo $time;
    $url = "http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if(isset($_COOKIE['PHPSESSID']))
    {
        $SESSID = $_COOKIE['PHPSESSID'];
        curl_setopt($curl, CURLOPT_COOKIE, "PHPSESSID=$SESSID");
    }
    
    $resp = curl_exec($curl);
    $endTime = time('h:mm:ss');
    echo $endTime;
    $json = json_decode($resp, true);
    
    //print_r($resp);
    if(!empty($json))
    {
        foreach ($json as $key => $value) 
        {
            echo "Product: ";
            echo $value["productID"];
            echo " - Quantity: ";
            echo $value["quantity"];
            echo "<br>";
        }
    }   
    curl_close($curl);
?>