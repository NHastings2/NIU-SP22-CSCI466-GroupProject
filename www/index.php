<form method="POST" action="http://students.cs.niu.edu/~z1929228/csci466/group_project/www/Managers/CartManager.php">
    <input type="hidden" id="Action" name="Action" value="Add">
    <input type="hidden" id="Redirect" name="Redirect" value="http://students.cs.niu.edu/~z1929228/csci466/group_project/www/">
    <input type="text" id="ProductID" name="ProductID"><br>
    <input type="text" id="Quantity" name="Quantity"><br>
    <button type="submit">Submit</button>
</form>

<?php
    include 'Libraries/Cart.php';
    include 'Libraries/Order.php';

    $cart = GetCart();

    //print_r($cart);

    $json = json_decode($cart, true);
    
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
    
?>