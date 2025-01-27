<?php
$nameServar = "localhost";
$username = "root";
$password = "Dracula322003";
$namedatabase = "assist_hub";

$con = new mysqli($nameServar, $username, $password, $namedatabase);

if ($con->connect_error) 
    die("Something went wrong");

$idRequest  = $_POST["idRequest"];

$updateQuery = "UPDATE rejected_reservations SET IsReturnPayment = 1 WHERE Id = $idRequest ";

if($con -> query($updateQuery ) == true){

    $infoArray["error"] = false;
    $infoArray["message"] = "The operation was successful.";
}else{

    $infoArray["error"] = true;
    $infoArray["message"] = "Failed. Please try later.";
}

echo json_encode($infoArray);
$con->close();

?>