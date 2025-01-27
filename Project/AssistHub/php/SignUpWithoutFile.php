<?php

$nameServer   = "localhost";
$userName     = "root";
$password     = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$NameUser                       = $_POST["NameUser"];
$PhoneUser                      = $_POST["PhoneUser"];
$passwordUser                   = $_POST["passwordUser"] ;
$NationalityUser                = $_POST["NationalityUser"] ;
$Nationality_Or_Passport_Number = $_POST["Nationality_Number"] ;
$Health_Insurance               = $_POST["Health_Insurance"] ;


// Check if phone number already exists
$select = "SELECT * FROM user WHERE Phone = ?";
$stmt = $con->prepare($select);
$stmt->bind_param("s", $PhoneUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $infoArray["error"] = true;
    $infoArray["message"] = "There is another account with this phone number.";
    echo json_encode($infoArray);
    exit;
}

//check if Nationalty Or Passport Number already exists
$select = "SELECT * FROM user_information WHERE NationaltyOrPassportNumber = ?";
$stmt = $con->prepare($select);
$stmt->bind_param("s", $Nationality_Or_Passport_Number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $infoArray["error"]    = true;
    $infoArray["message"]  = "There is another account with this nationality\pasport number.";
    echo json_encode($infoArray);
    exit;
}

  // Insert new user data
  $insertUser = "INSERT INTO user (Name_User, Phone, Nationality, password_User) VALUES (?, ?, ?, ?)";
  $stmt = $con->prepare($insertUser);
  $stmt->bind_param("ssss", $NameUser, $PhoneUser, $NationalityUser, $passwordUser);

  
if ($stmt->execute()) {
    // Get the ID of the newly inserted user
    $lastUserId = $con->insert_id;

    // Insert data into user_information
    $insertInfo = "INSERT INTO user_information (Health_Insurance, NationaltyOrPassportNumber,  User_Id) 
                   VALUES (?, ?, ?)";
    $stmtInfo = $con->prepare($insertInfo);
    $stmtInfo->bind_param("ssi", $Health_Insurance, $Nationality_Or_Passport_Number, $lastUserId);

    if ($stmtInfo->execute()) {
        $infoArray["error"] = false;
        $infoArray["message"] = "User registered successfully. " . $fileResponse["message"];
    } else {
        $infoArray["error"] = true;
        $infoArray["message"] = "Error registering user information: " . $stmtInfo->error;
    }
    
} else {
    $infoArray["error"] = true;
    $infoArray["message"] = "Error registering user: " . $stmt->error;
}

echo json_encode ($infoArray);
$con->close();
?>