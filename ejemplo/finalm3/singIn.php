<?php
//endpoint
//http://localhost/finalm3/signIn.php
$method =$_SERVER['REQUEST_METHOD'];
if($method === 'GET'){
    include_once('db_connector.php');
    $request = file_get_contents('php://input');
    $data = json_decode($request);
    $email = $data->email;
    $password = $data->password;
    $sql = "SELECT * FROM user where email='".$email."' and password = '".$password."'";
    
    $valid;
    $error = array();
    if ($email == '' || $password == ''){
        $error[]='Fields are empty';
        $valid=false;
    }

    if (!strpos($email, '@' && !strpos($email, '.com' && !strpos($email, '.net') ){
        $error[]='Email format is wrong';
        $valid=false;
    }
    
    $result = $conn->query($sql);
    
    if($result->num_rows >0){
        echo json_encode(array('success'=>'true', 'signin'=> 'Sign in', 'error'=>null));
    } else {
        echo json_encode(array('success'=>'false', 'signin'=> 'Sign in', 'error'=>'User or password are wrong'));
    }
} else {
    echo json_encode(array('success'=>'false','signin'=>null,'error'=> 'Bad request,try again'));
}