<?php
$nameServer = "localhost";
$userName = "root";
$password = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$userId       = $_POST["UserId"] ;
$NameUser     = $_POST["NameUser"] ;
$PhoneUser    = $_POST["PhoneUser"] ;
$passwordUser = $_POST["passwordUser"] ;

// Check if phone number already exists for another user
$selectPhoneQuery = "SELECT * FROM user WHERE Phone = ? AND Id != ?";
$stmtPhone = $con->prepare($selectPhoneQuery);
$stmtPhone->bind_param("si", $PhoneUser, $userId);
$stmtPhone->execute();
$phoneResult = $stmtPhone->get_result();

if ($phoneResult->num_rows > 0) {
    $infoArray["error"] = true;
    $infoArray["message"] = "Another account exists with this number.";
    echo json_encode($infoArray);
    $stmtPhone->close();
    $con->close();
    exit;
}

$user =  array ();
$updateQuery = "UPDATE user SET Name_User = ?, Phone = ?, password_User = ? WHERE Id = ?";
$stmtUpdate = $con->prepare($updateQuery);
$stmtUpdate->bind_param("sssi", $NameUser, $PhoneUser, $passwordUser, $userId);

if ($stmtUpdate->execute()) {
    // Fetch updated user data
    $fetchUserQuery = "SELECT * FROM user WHERE Id = ?";
    $stmtFetchUser = $con->prepare($fetchUserQuery);
    $stmtFetchUser->bind_param("i", $userId);
    $stmtFetchUser->execute();
    $userResult = $stmtFetchUser->get_result();

    if ($userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();

        $fetchInfoQuery = "SELECT * FROM user_information WHERE User_Id = ?";
        $stmtFetchInfo = $con->prepare($fetchInfoQuery);
        $stmtFetchInfo->bind_param("i", $userId);
        $stmtFetchInfo->execute();
        $infoResult = $stmtFetchInfo->get_result();

        if ($infoResult->num_rows > 0) {
            $row2 = $infoResult->fetch_assoc();

            $user = array(
                "Id" => $row["Id"],
                "Name_User" => $row["Name_User"],
                "Phone" => $row["Phone"],
                "Nationality" => $row["Nationality"],
                "password_User" => $row["password_User"],
                "NationaltyOrPassportNumber" => $row2["NationaltyOrPassportNumber"],
                "Health_Insurance" => $row2["Health_Insurance"],
                "File_Name" => $row2["File_Name"]
            );

            $infoArray["error"] = false;
            $infoArray["message"] = "The information was updated successfully.";
            $infoArray["User"] = $user;

            echo json_encode($infoArray);
            $stmtFetchInfo->close();
            $stmtFetchUser->close();
            $stmtUpdate->close();
            $con->close();
            exit;
        } else {
            $infoArray["error"] = true;
            $infoArray["message"] = "Failed to fetch additional user information.";
            $infoArray["User"] = $user;
        }
        $stmtFetchInfo->close();
    } else {
        $infoArray["error"] = true;
        $infoArray["message"] = "Failed to fetch updated user data.";
        $infoArray["User"] = $user;
    }
    $stmtFetchUser->close();
} else {
    $infoArray["error"] = true;
    $infoArray["message"] = "Failed to update user information. Please try again.";
    $infoArray["User"] = $user;
}

echo json_encode($infoArray);

$stmtUpdate->close();
$con->close();

?>