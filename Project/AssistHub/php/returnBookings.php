<?php
$nameServer = "localhost";
$userName = "root";
$password = "Dracula322003";
$nameDatabase = "assist_hub";


include ('returnData.php');

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);
  
   
$userId = $_POST["userId"];
$select = "select * from  booking_requests where User_id = $userId ";
$result = $con -> query($select);

if($result -> num_rows > 0){

    while($row = $result -> fetch_assoc()){


        $infoArray["id"]         = $row["id"]  ;
        $infoArray["hospital"]   = returnHospital ($row["id_hospital_fk"] , $con) ;
        $infoArray["section"]    = returnSection ($row["section_id"] , $con) ;
        $infoArray["period"]     = $row["period"] ; 
        $infoArray["state"]      = $row["state"] ; 
        $infoArray["dateBed"]    = $row["dateBed"] ; 
        $infoArray["cost"]       = $row["cost"] ; 

        if($row["id_doctor"] != null ){
            $infoArray["doctor"]  = returnDoctor ($row["id_doctor"]  , $con);
            $infoArray["bed"]     = null;
        }
        else
        {
            $infoArray["doctor"]  = null;
            $infoArray["bed"]     = returnBed ($row["id_bed"]  , $con);

        }

        $allArray [] =  $infoArray;
       
    }
}else{
    $infoArray["id"]         = 0  ;
    $infoArray["hospital"]   = null;
    $infoArray["section"]    = null;
    $infoArray["period"]     = null;
    $infoArray["state"]      = null;
    $infoArray["dateBed"]    = null;
    $infoArray["doctor"]     = null;
    $infoArray["bed"]        = null;
    $allArray [] =  $infoArray;
}


echo json_encode($allArray);

$con->close();

?>