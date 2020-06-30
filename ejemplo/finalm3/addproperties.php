<?php
//endpoint
//http://localhost/finalm3/addProperties.php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'POST'){
    include_once('db_connector.php');
    $request = file_get_contents('php://input');
    $data = json_decode($request);
    $title = $data->title;
    $type = $data->type;
    $address = $data->address;
    $rooms = $data->rooms;
    $price = $data->price;
    $area = $data->area;
    $id_user = $data->id_user;

    $valid=true;
    $error = array();
    if ($type != 'casa' && $type != 'habitacion' && $type != 'hostal'){
        $error[]='Type is not valid data';
        $valid=false;
    }

    if (!is_numeric($rooms)){
        $error[]='Room is numeric data type';
        $valid=false;
    }

    if (!is_numeric($price)){
        $error[]='Price is numeric data type';
        $valid=false;
    }

    if (!is_numeric($area)){
        $error[]='Area is numeric data type';
        $valid=false;
    }

    if ($title == '' || $address == '' ||$rooms == '' || $price == ''|| $area == '' || $type =='' || $id_user == '') {
        $error[]='Any field can be null';
        $valid=false;
    }

    if ($valid) {
        $sql = "INSERT INTO property (title, address, rooms, price,area,type, id_user) VALUES ('".$title."','".$address."',".$rooms.",".$price.",".$area.",'".$type."',".$id_user.")";

        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('success'=>'true', 'property'=>'property added successfully', 'error'=>null));
        } else {
            echo json_encode(array('success'=>'false', 'property'=>null, 'error'=>$conn->error));
        }
    } else {
        echo json_encode(array('success'=>'false', 'property'=>null, 'error'=>array($error)));
    }
} 
?>
