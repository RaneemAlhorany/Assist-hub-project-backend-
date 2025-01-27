<?php
$nameServar = "localhost";
$username = "root";
$password = "Dracula322003";
$namedatabase = "assist_hub";

$connection = new mysqli($nameServar, $username, $password, $namedatabase);

if ($connection->connect_error) 
    die("Something went wrong");

// Set the default time zone to Jordan
date_default_timezone_set('Asia/Amman');    

$idRequset = $_POST["idRequset"];

$select = "SELECT * FROM booking_requests WHERE id = $idRequset";

$result = $connection->query($select);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $date = $row["DateBooking"];


    // Convert the DateBooking to a timestamp (midnight) for comparison
    $bookingTime = strtotime($date . " 00:00:00"); // Ensure timestamp is treated as midnight
    $currentTime = time(); // Current timestamp

    // Check if the current date is after the booking date
    if (strtotime($date) < strtotime(date('Y-m-d'))) 
        $infoArray["returnMoney"] = false; // Booking date is in the past

    else if ($currentTime - $bookingTime < 24 * 60 * 60) 
        $infoArray["returnMoney"] = true; 

    else 
        $infoArray["returnMoney"] = false; 

    // Delete the booking from the database
     $delete = "DELETE FROM booking_requests WHERE id = $idRequset";

     if ($connection->query($delete) == true) {
         $infoArray["error"] = false;
         $infoArray["message"] = "Your reservation has been successfully deleted";
     } 
     else {
         $infoArray["error"] = true;
         $infoArray["message"] = "Failed to delete, try again later";
     }
    
} 
else {
    $infoArray["error"] = true;
    $infoArray["message"] = "This failed, try again later";
    $infoArray["returnMoney"] = false;
}

echo json_encode($infoArray);
$connection->close();
?>
