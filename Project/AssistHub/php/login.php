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

$selectUser = "SELECT * FROM user WHERE Phone = '$PhoneUser' AND password_User = '$passwordUser'  ";
$resultUser = $con->query($selectUser); 


if ($resultUser->num_rows > 0) { 

    $rowUser = $resultUser -> fetch_assoc();
    $idUser  = $rowUser["Id"];

    $selectUserInfo  = "SELECT * FROM user_information WHERE User_Id = $idUser";
    $resultUserInfo  = $con-> query ($selectUserInfo);

    if ($resultUserInfo->num_rows > 0) {
        $rowUserInfo = $resultUserInfo -> fetch_assoc();

        $user = array (
            "Id"                        => $rowUser["Id"],  
            "Name_User"                 => $rowUser["Name_User"], 
            "Phone"                     => $rowUser["Phone"],
           "Nationality"                => $rowUser["Nationality"],
           "password_User"              => $rowUser["password_User"],
           "NationaltyOrPassportNumber" => $rowUserInfo["NationaltyOrPassportNumber"],
           "Health_Insurance"           => $rowUserInfo["Health_Insurance"],
           "File_Name"                  => $rowUserInfo["File_Name"]
        );

        $infoArray ["error"]   = false;
        $infoArray ["message"] = "Log in successfully.";
        $infoArray ["User" ]   = $user;
      
        echo json_encode($infoArray);
    
    }else{

        $user = array (
            "Id"                           => 0,
            "Name_User"                    => "no data",
            "Phone"                        => "no data",
            "Nationality"                  => "no data",
            "password_User"                => "no data",
            "NationaltyOrPassportNumber"   => "no data",
            "Health_Insurance"             =>"no data",
            "File_Name"                    => "no data"
        );

        $infoArray = [
            "error"   => true,
            "message" => " Your password or phone is wrong, something wrong, try later",
            "User"    =>  $user
        ];
        
        echo json_encode($infoArray);
    }

} else {
    $user   = array (
        "Id"                         => 0,
        "Name_User"                  => "no data",
        "Phone"                      => "no data",
        "Nationality"                => "no data",
        "password_User"              => "no data",
        "NationaltyOrPassportNumber" => "no data",
        "Health_Insurance"           => "no data",
        "File_Name"                  =>"no data"
    );

    $infoArray = [
        "error"   => true,
        "message" => "Your password or phone is wrong, something wrong, try later",
        "User"    =>  $user
    ];
    
    echo json_encode($infoArray);
}


$con->close();
?>