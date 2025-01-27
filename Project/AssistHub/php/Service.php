<?php
$nameServer   = "localhost";
$userName     = "root";
$password     = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$idHospital     = $_POST["IDHospital"];
$idChooseDoctor = $_POST["idChooseDoctor"];
$idChooseBed    = $_POST["idChooseBed"];
$SectionsDoctor = $_POST["IDSectionDoctor"];
$SectionsBed    = $_POST["IDSectionBed"];


// Default case
if ($idChooseDoctor == 1 ) {

   if($SectionsDoctor == 0){

    $select = "SELECT * FROM doctor WHERE hospital_fk_id = $idHospital AND Available = 1";
    $result = $con->query($select);
    $allData = [];
     
    if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $doctorData = [
                    "idDoctor" => $row["id"],
                    "nameDoctor" => $row["name"],
                    "DoctorType" => $row["DoctorType"],
                    "imageDoctor" => $row["image"],
                    "AvailableDoctor" => $row["Available"],
                    "TimeAvailable" => $row["TimeAvailable"],
                    "Day" => $row["Day"],
                    "CostDoctor" => $row["Cost"],
                    "hospital_fk_id" =>  $idHospital];
                $allData[] = $doctorData;
          }

          echo json_encode($allData);
    }
    else
        noDataDoctor();

   }
   else {

        $select = "SELECT * FROM doctor WHERE hospital_fk_id = $idHospital AND Available = 1 AND Sections_fk_id = $SectionsDoctor";
        $result = $con->query($select);
        $allData = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctorData = [
                    "idDoctor" => $row["id"],
                    "nameDoctor" => $row["name"],
                    "DoctorType" => $row["DoctorType"],
                    "imageDoctor" => $row["image"],
                    "AvailableDoctor" => $row["Available"],
                    "TimeAvailable" => $row["TimeAvailable"],
                    "Day" => $row["Day"],
                    "CostDoctor" => $row["Cost"],
                    "hospital_fk_id" =>  $idHospital , 
                    "Sections_fk_id" =>  $SectionsDoctor
                ];
                $allData[] = $doctorData;
            }
            echo json_encode($allData);

        }else
            noDataDoctor();  
   }














}else if ($idChooseBed == 1) {

    if ($SectionsBed == 0) {

        $select = "SELECT * FROM bed WHERE hospital_fk_id = $idHospital 
        AND IsFull = 0 ";
        $result = $con->query($select);
        $allData = [];



        if ($result->num_rows > 0) {
            
            $select = "SELECT * FROM bed WHERE hospital_fk_id = $idHospital 
            AND ( night < TotalAvailableBedsForBooking or morning < TotalAvailableBedsForBooking )";
            $result = $con->query($select);
            $allData = [];



            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bedData = [
                        "idBed" => $row["id"],
                        "imageBed" => $row["image"],
                        "nameBed" => $row["name"],
                        "CostBed" => $row["CostBed"],
                        "hospital_fk_id" =>  $idHospital,
                        "IsFull" => $row["IsFull"]];
                    $allData[] = $bedData;
                }
                echo json_encode($allData);
            }else
                noDataBed();
            
               
        }else{
            $bedData = [
                "idBed" => 0,
                "imageBed" => null,
                "nameBed" => null,
                "CostBed" => null,
                "hospital_fk_id" =>  0,
                "IsFull" => 1
            ];

            $allData[] = $bedData;
            echo json_encode($allData);
        }
    
    }else {

        $select = "SELECT * FROM bed WHERE hospital_fk_id = $idHospital 
        AND IsFull =  0 AND section_fk_id = $SectionsBed ";
        $result = $con->query($select);
        $allData = [];
        
        if($result->num_rows>0){

            $select = "SELECT * FROM bed WHERE hospital_fk_id = $idHospital AND section_fk_id = $SectionsBed
            AND ( night < TotalAvailableBedsForBooking or morning < TotalAvailableBedsForBooking )";
            $result = $con->query($select);
            $allData = [];
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bedData = [
                        "idBed" => $row["id"],
                        "imageBed" => $row["image"],
                        "nameBed" => $row["name"],
                        "hospital_fk_id" =>  $idHospital,
                        "Sections_fk_id" =>  $SectionsBed];
                    $allData[] = $bedData;
                }
                echo json_encode($allData);
            }else
              noDataBed();
        }else{
            $bedData = [
                "idBed" => 0,
                "imageBed" => null,
                "nameBed" => null,
                "CostBed" => null,
                "hospital_fk_id" =>  0,
                "IsFull" => 1
            ];

            $allData[] = $bedData;
            echo json_encode($allData);
        }  
    }




} else {

    $doctorAndBedData = [
        "idDoctor" => 0,
        "nameDoctor" => null,
        "DoctorType" => null,
        "imageDoctor" => null,
        "AvailableDoctor" => null,
        "TimeAvailable" => null,
        "Day" =>null,
        "CostDoctor" => 0,
        "hospital_fk_id" => 0 ,
        "idBed" => 0,
        "imageBed" => null,
        "nameBed" => null,
        "CostBed" => null,
        "hospital_fk_id" =>  0,
        "IsFull" => 0
    ];
    echo json_encode($doctorAndBedData);
}
   


function  noDataDoctor() {
    $doctorData = [
        "idDoctor" => 0,
        "nameDoctor" => null,
        "DoctorType" => null,
        "imageDoctor" => null,
        "AvailableDoctor" => null,
        "TimeAvailable" => null,
        "Day" =>null,
        "CostDoctor" => 0,
        "hospital_fk_id" => 0 
    ];
    $allData[] = $doctorData;

    echo json_encode($allData);
}

function  noDataBed() {

    $bedData = [
        "idBed" => -1,
        "imageBed" => null,
        "nameBed" => null,
        "CostBed" => null,
        "hospital_fk_id" =>  0
    ];
    $allData[] = $bedData;


    echo json_encode($allData);
}
$con->close();

?>


