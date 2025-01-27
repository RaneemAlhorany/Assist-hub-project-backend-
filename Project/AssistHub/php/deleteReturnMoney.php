<?php
$nameServar   = "localhost";
$username     = "root";
$password     = "Dracula322003";
$namedatabase = "assist_hub";

$connection = new mysqli($nameServar, $username, $password, $namedatabase);

if ($connection->connect_error) 
    die("Something went wrong");

$idRequset = $_POST["idRequset"];

     $delete = "DELETE FROM booking_requests WHERE id = $idRequset";

     if ($connection->query($delete) == true) {
        $infoArray["error"] = false;
        $infoArray["message"] = "The operation was successful.";
     } 
     else {
        $infoArray["error"] = true;
        $infoArray["message"] = "Failed. Please try later.";
     }
    
echo json_encode($infoArray);
$connection->close();
?>
