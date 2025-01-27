<?php
$nameServar ="localhost";
$username ="root";
$password = "Dracula322003";
$namedatabase ="assist_hub";

$id_hospital_fk        = $_POST["id_hospital_fk"];
$section_id            = $_POST["section_id"];
$User_id               = $_POST["User_id"];
$id_doctor             = $_POST["id_doctor"];
$id_bed                = $_POST["id_bed"];
$period                = $_POST["period"];
$dateBed               = $_POST["dateBed"];
$cost                  = $_POST["cost"];


date_default_timezone_set('Asia/Amman');
$time = date("H:i:s"); // 24-hour format
$date = date("Y-m-d");

$connection = new mysqli ($nameServar,$username,$password,$namedatabase);

if ($connection->connect_error)
	die ("sothing wrong");
else { 
	

    if ($id_bed != 0 )
        $insert = "insert into booking_requests (dateBed ,period , id_bed  , User_id , section_id , id_hospital_fk , timeBooking , DateBooking , cost) 
        values ( '$dateBed', '$period '
         ,( select id from bed where id = $id_bed) 
         ,( select Id from user where Id = $User_id)
         ,( select id from sections_hospital where id = $section_id)
         ,( select id from hospital where id = $id_hospital_fk) 
         ,'$time' , '$date' , $cost ) ";  

    else  
            $insert = "insert into booking_requests (id_doctor , User_id , section_id , id_hospital_fk , timeBooking , DateBooking , cost) 
            values (
             ( select id from doctor where id = $id_doctor)
             ,( select Id from user where Id = $User_id)
             ,( select id from sections_hospital where id = $section_id)
             ,( select id from hospital where id = $id_hospital_fk) 
             , '$time' , '$date' ,  $cost) "; 
    
			
	
	if($connection -> query ($insert) == true){

		$infoArray ["error"]     = false ;
		$infoArray ["message"]   = "Your reservation has been successfully requested. Please check your reservation section after a short period of time.";
	}else{
		 $infoArray ["error"]    = true ;
		$infoArray ["message"]  = "Faield to pay , try later ";
	}

echo json_encode ($infoArray);
	

}

$connection -> close();
?>