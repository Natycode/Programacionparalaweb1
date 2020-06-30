<?php
//endpoint
//http://localhost/finalm3/addProperties.php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'POST'){
    include_once('db_connector.php');
    $request = file_get_contents('php://input');
    $data = json_decode($request);
    $id = $data->id_property;
    $title = $data->title;
    $address = $data->address;
    $rooms = $data->rooms;
    $price = $data->price;
    $area = $data->area;
    $type = $data->type;
    
    $valid=true;
    $error = array();
    if ($type != "casa" && $type != "habitacion" && $type != "hostal"){
        //echo json_encode(array('response'=>'Type is not valid data'));
        $valid=false;
        $error[]='Type is not valid data';
    }

    if (!is_numeric($rooms)){ 
        //echo json_encode(array('response'=>'Rooms is numeric data type'));
        $valid=false;
        $error[]='Rooms is numeric data type';
    }

    if (!is_numeric($price)){
        //echo json_encode(array('response'=>'Price is numeric data type'));
        $valid=false;
        //exit;
        $error[]='Price is numeric data type';
    }

    if (!is_numeric($area)){
        //echo json_encode(array('response'=>'Area is numeric data type'));
        $valid=false;
        $error[]='Area is numeric data type';
    }

    if ($title == '' || $address == '' ||$rooms == '' || $price == ''|| $area == '' || $type =='') {
        //echo json_encode(array('response'=>'Any field can be null'));
        $valid=false;
        $error[]='Any field can be null';
    }

    if ($valid){
        $sql = "UPDATE property SET title='{$title}',address='{$address}',rooms={$rooms},price={$price},area={$area}, type='{$type}' where id_property={$id}";
        //echo json_encode(array('response'=>$sql));
        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('success'=>'true','property'=>'property updated successfully', 'error'=>null));
        } else {
            echo json_encode(array('success'=>'false','property'=>null, 'error'=>$conn->error));
        }
    } else {
        echo json_encode(array('success'=>'false', 'property'=>null, 'error'=>array($error)));
    }
}

    