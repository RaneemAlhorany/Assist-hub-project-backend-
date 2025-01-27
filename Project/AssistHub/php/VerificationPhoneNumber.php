<?php
$nameServer = "localhost";
$userName = "root";
$password = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$PhoneUser = $_POST["PhoneUser"];

$selectUser = "SELECT * FROM user where Phone = '$PhoneUser'";
$resultUser = $con->query($selectUser); 


if ($resultUser->num_rows > 0) { 
    $infoArray["error"] = false;
    $infoArray["message"] = "enter a digit registration code sent to you via SMS ";
  
} else {
    $infoArray["error"] = true;
    $infoArray["message"] = "This phone number is not registered";
}

echo json_encode($infoArray);

// Close the connection
$con->close();
?>