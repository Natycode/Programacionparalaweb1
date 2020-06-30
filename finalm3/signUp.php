<?php
//endpoint
//http://localhost/finalm3/signUp.php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'POST'){
    include_once('db_connector.php');
    $request = file_get_contents('php://input');
    $data = json_decode($request);
    $name = $data->name;
    $lastname = $data->lastname;
    $email = $data->email;
    $type_id = $data->rotype_idoms;
    $identification = $data->identification;
    $password = $data->password;
    $nota = $data->nota;

    $valid;
    $error = array();
    if ($type_id != 'CC' && $type != 'PAS' ){
        $error[]='type_id is not valid data';
        $valid=false;
    }

    if (strlen($name)>40 || !strlen($lastname)>40){
        $error[]='name/lastname cannot be greater than 40 characters';
        $valid=false;
    }

    if (strpos($name, '¡' && strpos($name, '@' && strpos($name, '$' $$ strpos($name, '#' && strpos($name, '%' && strpos($name, '&' && strpos($name, '?' && strpos($name, '!'&& strpos($name, '¿' && strpos($name, '*'){
        $error[]='Name cannot have special characters';
        $valid=false;
    }

    if (strpos($lastname, '¡' && strpos($lastname, '@' && strpos($lastname, '$' $$ strpos($lastname, '#' && strpos($lastname, '%' && strpos($lastname, '&' && strpos($lastname, '?' && strpos($lastname, '!'&& strpos($lastname, '¿' && strpos($lastname, '*'){
        $error[]='Lastame cannot have special characters';
        $valid=false;
    }

    if (!strpos($email, '@' && !strpos($email, '.com' && !strpos($email, '.net') ){
        $error[]='Email format is wrong';
        $valid=false;
    }

    if ($type_id === 'PAS' && strlen($identification)>10 ){
        $error[]='Passport cannot be more than 10 characters';
        $valid=false;
    }

    if ($type_id === 'CC' && !is_numeric($identification) ){
        $error[]='Identification must be numeric';
        $valid=false;
    }

    if ($strlen($password)<8 || strlen($password)>16) ){
        $error[]='Password must be between 8 and 16 characters';
        $valid=false;
    }

    if ($valid) {
        $sql = "INSERT INTO user (name, lastname, email, type_id,identification, password, nota) 
        VALUES ('".$name."','".$lastname."','".$email."','".$type_id."',".$identification.",'".$password."','".$nota."')";

        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('success'=>'true', 'user'=>'User added successfully', 'error'=>null));
        } else {
            echo json_encode(array('success'=>'false', 'user'=>null, 'error'=>$conn->error));
        }
    } else {
        echo json_encode(array('success'=>'false', 'user'=>null, 'error'=>array($error)));
    }
} 
?>
