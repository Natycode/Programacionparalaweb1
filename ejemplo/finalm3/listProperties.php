<?php
//endpoint
//http://localhost/finalm3/listProperties.php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'GET'){
    include_once('db_connector.php');
    $sql = "SELECT * FROM property";
    $result = $conn->query($sql);
    $property = array();
    if($result->num_rows >0){
        while($row = $result->fetch_assoc()){
            $property[] = $row;
        }
        echo json_encode(array('success'=>'true', 'property'=> $property, 'error'=>null));
    }
     
} else {
    echo json_encode(array('success'=>'false','property'=>null,'error'=> 'Bad request,try again'));
}