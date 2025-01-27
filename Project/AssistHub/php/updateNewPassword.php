<?php
$nameServer   = "localhost";
$userName     = "root";
$password     = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$PhoneUser    = $_POST["PhoneUser"] ;
$passwordUser = $_POST["passwordUser"] ;

$updateQuery = $con->prepare("UPDATE user SET password_User = ? WHERE Phone = ?");
$updateQuery->bind_param("ss", $passwordUser, $PhoneUser);

if ($updateQuery->execute()) 
    echo json_encode(["error" => false, "message" => "Password updated successfully."]);
 else 
    echo json_encode(["error" => true, "message" => "Something went wrong: " . $con->error]);

$con->close();
?>
