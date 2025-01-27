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
$passwordUser                   = $_POST["passwordUser"];
$NationalityUser                = $_POST["NationalityUser"];
$Nationality_Or_Passport_Number = $_POST["Nationality_Or_Passport_Number"];
$Health_Insurance               = $_POST["Health_Insurance"];

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
    $infoArray["error"] = true;
    $infoArray["message"] = "There is another account with this nationality\pasport number.";
    echo json_encode($infoArray);
    exit;
}

// Allowed file extensions
$allowedFileExtensions = ['pdf'];

$infoArray = array();

// Handle file upload
$nameFile = $Nationality_Or_Passport_Number . '.pdf';
$fileResponse = uploadFile($con, $allowedFileExtensions, $nameFile);

// Check if file upload was successful
if ($fileResponse["success"]) {
    // Insert new user data
    $insertUser = "INSERT INTO user (Name_User, Phone, Nationality, password_User) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($insertUser);
    $stmt->bind_param("ssss", $NameUser, $PhoneUser, $NationalityUser, $passwordUser);

    if ($stmt->execute()) {
        // Get the ID of the newly inserted user
        $lastUserId = $con->insert_id;

        // Insert data into user_information
        $insertInfo = "INSERT INTO user_information (Health_Insurance, NationaltyOrPassportNumber, File_Name, User_Id) 
                       VALUES (?, ?, ?, ?)";

        $stmtInfo = $con->prepare($insertInfo);
        $stmtInfo->bind_param("sssi", $Health_Insurance, $Nationality_Or_Passport_Number, $nameFile, $lastUserId);

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
} else {
    $infoArray["error"] = true;
    $infoArray["message"] = "User registration failed during file upload: " . $fileResponse["message"];
}


// Function to handle file upload
function uploadFile($con, $allowedFileExtensions, $nameFile) {
    $response = array("success" => false, "message" => "");

    if (isset($_FILES['file'])) {
        $fileError = $_FILES['file']['error'];

        if ($fileError === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if (in_array($fileExtension, $allowedFileExtensions)) {
                $uploadFileDir = '../file/';

                // Ensure directory is writable
                if (!is_writable($uploadFileDir)) {
                    $response["message"] = "Directory is not writable.";
                    return $response;
                }

                $targetFilePath = $uploadFileDir . $nameFile;

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $response["success"] = true;
                    $response["message"] = "File uploaded successfully.";
                } else {
                    $response["message"] = "Error moving the uploaded file.";
                }
            } else {
                $response["message"] = "Invalid file extension. Only PDF files are allowed.";
            }
        } else {
            $response["message"] = "File upload error. Error code: " . $fileError;
        }
    } else {
        $response["message"] = "Required file missing.";
    }

    return $response;
}

// Output the response
echo json_encode($infoArray);
$con->close();
?>
