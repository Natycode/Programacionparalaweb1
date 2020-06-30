<?php
//endpoint
//http://localhost/finalm3/getProperties.php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'GET'){
    include_once('db_connector.php');
    $request = file_get_contents('php://input');
    $data = json_decode($request);
    $id_user = $data->id_user;
    $sql = "SELECT * FROM property where id_user = ".$id_user;
    $result = $conn->query($sql);
    $property = array();
    if($result->num_rows >0){
        while($row = $result->fetch_assoc()){
            $property[] = $row;
        }
        echo json_encode(array('success'=>'true', 'property'=> $property, 'error'=>null));
    }
     
} else {
    echo json_encode(array('success'=>'false', 'property'=> null, 'error'=> 'Bat request,try again'));
}