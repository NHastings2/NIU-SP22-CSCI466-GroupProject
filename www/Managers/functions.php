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

?>