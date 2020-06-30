<?php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'DELETE'){
    include_once('db_connector.php');
    //get incoming data
    $request = file_get_contents('php://input');
    $data = json_decode($request);
    $id = $data->id_property;       
    $sql = "DELETE FROM property WHERE id_property={$id}";
    $result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success'=>'true', 'property'=>'property deleted successfully', 'error'=>null));
    } else {
        echo json_encode(array('success'=>'false','property'=>null,'error'=>$conn->error));
    }
}

    
?>
