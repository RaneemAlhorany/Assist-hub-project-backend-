<?php
$nameServer   = "localhost";
$userName     = "root";
$password     = "Dracula322003";
$nameDatabase = "assist_hub";

$con = new mysqli($nameServer, $userName, $password, $nameDatabase);

if ($con->connect_error) 
    die("Connection failed: " . $con->connect_error);

$region         = $_GET["region"];
$TypeOfHospital = $_GET["TypeOfHospital"];

if ($region == 0  &&  $TypeOfHospital == 0)
{


    $select = "select * from hospital";
    $result = $con -> query( $select);

    if ($result -> num_rows > 0){

        while ($row = $result -> fetch_assoc()){

            $infoArray = [
                "id" => $row["id"],
                "name" => $row["name"],
                "image" => $row["image"],
                "fk_id_reigon" => $row["fk_id_reigon"],
                "fk_id_type" => $row["fk_id_type"]
            ];

            $allArray [] = $infoArray;      
        } 

        echo json_encode( $allArray);
    }
    else{

        $infoArray = [
            "id" => 0,
            "name" => null,
            "image" => null,
            "fk_id_reigon" => null,
            "fk_id_type" => null
        ];

        $allArray [] = $infoArray;
        echo json_encode( $allArray);   
    }
   
}
else if ($region != 0  && $TypeOfHospital == 0 )
{

   $select = "select * from hospital where fk_id_reigon = $region";
    $result = $con -> query( $select);

    if ($result -> num_rows > 0){

        while ($row = $result -> fetch_assoc()){
            $infoArray = [
                "id" => $row["id"],
                "name" => $row["name"],
                "image" => $row["image"],
                "fk_id_reigon" => $row["fk_id_reigon"],
                "fk_id_type" => $row["fk_id_type"]
            ];

            $allArray [] = $infoArray;      
        } 
        echo json_encode( $allArray);

    }
    else{
        $infoArray = [
            "id" => 0,
            "name" => null,
            "image" => null,
            "fk_id_reigon" => null,
            "fk_id_type" => null
        ];

        $allArray [] = $infoArray;
        echo json_encode( $allArray); 

    }

}
else if ($region == 0 && $TypeOfHospital != 0 )
{
    $select = "select * from hospital where fk_id_type = $TypeOfHospital";

    $result = $con -> query( $select);
    if ($result -> num_rows > 0)
    {
        while($row = $result -> fetch_assoc())
        {

            $infoArray = [
                "id" => $row["id"],
                "name" => $row["name"],
                "image" => $row["image"],
                "fk_id_reigon" => $row["fk_id_reigon"],
                "fk_id_type" =>$row["fk_id_type"]
            ];
            $allArray [] = $infoArray;    

        } 
        echo json_encode( $allArray);

    }
    else
    {
        $infoArray = [
            "id" => 0,
            "name" => null,
            "image" => null,
            "fk_id_reigon" => null,
            "fk_id_type" => null
        ];

        $allArray [] = $infoArray;
        echo json_encode( $allArray); 
    }

}
else
{
    $select = "select * from hospital where fk_id_type = $TypeOfHospital  and fk_id_reigon = $region ";
    $result = $con -> query( $select);

    if ($result -> num_rows > 0)
    {
        while ($row = $result -> fetch_assoc())
        {
            $infoArray = [
                "id" => $row["id"],
                "name" => $row["name"],
                "image" => $row["image"],
                "fk_id_reigon" => $row["fk_id_reigon"],
                "fk_id_type" => $row["fk_id_type"]
            ];
            $allArray [] = $infoArray;      
        } 
        echo json_encode( $allArray);
    }
    else
    {
        $infoArray = [
            "id" => 0,
            "name" => null,
            "image" => null,
            "fk_id_reigon" => null,
            "fk_id_type" => null
        ];
        $allArray [] = $infoArray;
        echo json_encode( $allArray); 

    }
}

$con -> close();
?>
