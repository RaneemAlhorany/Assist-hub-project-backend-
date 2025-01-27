<?php
$nameServer = "localhost";
$userName = "root";
$password = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$select = "SELECT * FROM volunteer";
$Result = $con->query($select);

$AllArray = []; 

if ($Result->num_rows > 0) {

    while ($row = $Result->fetch_assoc()) {
        $infoArray = [
            "id"    => $row["id"],
            "name"  => $row["name"],
            "image" => $row["image"],
            "note"  => $row["note"],
            "link"  => $row["link"] ];
        $AllArray[] = $infoArray; 
    }

} else {
    $infoArray = [
        "id"    => 0,
        "name"  => null,
        "image" => null,
        "note"  => null,
        "link"  => null];
    $AllArray[] = $infoArray; 
}

echo json_encode($AllArray);
$con->close();
?>







