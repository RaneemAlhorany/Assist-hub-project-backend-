<?php
$nameServar = "localhost";
$username = "root";
$password = "Dracula322003";
$namedatabase = "assist_hub";

include ('returnData.php');

$con = new mysqli($nameServar, $username, $password, $namedatabase);

if ($con->connect_error) 
    die("Something went wrong");

$idUser = $_POST["idUser"];

$select = "SELECT * FROM approved_bokking  WHERE User_id = $idUser";
$result = $con->query($select);

if ($result->num_rows > 0) {

    while( $row = $result->fetch_assoc()){
        
        $infoArray["DateBooking"]  = $row["DateBooking"];
        $infoArray["hospital"]     = returnHospital ($row["hospital_id"] , $con );
        $infoArray["Section"]      = returnSection  ( $row["Section_id"] , $con);
        $infoArray["Appointment_time"] = $row["Appointment_time"];
     
        if($row["id_doctor"] != null ){
            //here data doctor 
            $infoArray["doctor"] = returnDoctor ( $row["id_doctor"] ,  $con );
            $infoArray["bed"] =  null ;
            $infoArray["period"] = null;
        
        }
        else{
            $infoArray["doctor"]   = null;
            $infoArray["bed"]   =  returnBed  ($row["id_bed"], $con );
            $infoArray["period"] = $row["period"];
        }

        $AllArray[] = $infoArray;


    }

} else{
    $infoArray["DateBooking"]      = null;
    $infoArray["hospital"]         = null ;
    $infoArray["Section"]          = null;
    $infoArray["Appointment_time"] = null;
    $infoArray["doctor"]           = null;
    $infoArray["bed"]              = null ;
    $infoArray["period"]           = null;
    $AllArray[] = $infoArray;
}
echo json_encode($AllArray);
$con->close();

?>
