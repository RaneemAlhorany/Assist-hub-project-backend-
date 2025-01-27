<?php
$nameServar   = "localhost";
$username     = "root";
$password     = "Dracula322003";
$namedatabase = "assist_hub";

include ('returnData.php');

$con = new mysqli($nameServar, $username, $password, $namedatabase);

if ($con->connect_error) 
    die("Something went wrong");

$idUser = $_POST["idUser"];

$select = "SELECT * FROM rejected_reservations  WHERE User_id = $idUser";
$result = $con->query($select);

if ($result->num_rows > 0) {

    while( $row = $result->fetch_assoc()){
        
        $infoArray["Id"]              = $row["Id"];
        $infoArray["Hospital"]        = returnHospital ($row["Hospital_id"] , $con );
        $infoArray["Section"]         = returnSection  ( $row["Section_id"] , $con);
        $infoArray["message"]         = $row["message"];
        $infoArray["refundAmount"]    = $row["refundAmount"];
        $infoArray["IsReturnPayment"] = $row["IsReturnPayment"];
     
        if($row["id_doctor"] != null ){
            //here data doctor 
            $infoArray["doctor"] = returnDoctor ( $row["id_doctor"] ,  $con );
            $infoArray["bed"] =  null ;
        
        }else{

            $infoArray["doctor"]   = null;
            $infoArray["bed"]      =  returnBed  ($row["id_bed"], $con );
        }

        $AllArray[] = $infoArray;

    }

} else{
    $infoArray["Id"]                 = 0 ;
    $infoArray["Hospital"]           = null ;
    $infoArray["Section"]            = null ;
    $infoArray["message"]            = null ;
    $infoArray["refundAmount"]       = null ;
    $infoArray["IsReturnPayment"]    = null ;
    $infoArray["doctor"]             = null ;
    $infoArray["bed"]                = null ;
    $AllArray[] = $infoArray;
}


echo json_encode( $AllArray);


$con->close();
?>
