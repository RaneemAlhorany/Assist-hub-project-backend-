<?php
$nameServer = "localhost";
$userName = "root";
$password = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);
  
function returnHospital ($id , $con){
    $select = "select * from hospital where id = $id ";
    $result = $con -> query($select);
    $row    = $result -> fetch_assoc();

    return $row["name"];
}

function returnSection ($id , $con){
    $select = "select * from sections_hospital where id = $id ";
    $result = $con -> query($select);
    $row    = $result -> fetch_assoc();

    return $row["name"];
}

function returnDoctor ($id , $con){
    $select = "select * from doctor where id = $id ";
    $result = $con -> query($select);
    $row    = $result -> fetch_assoc();

    return $row["name"];
}

function returnBed ($id , $con){
    $select = "select * from bed where id = $id ";
    $result = $con -> query($select);
    $row    = $result -> fetch_assoc();

    return $row["name"];
}
$con->close();
?>