<?php

$hname = 'localhost'; // variable
$uname = 'root'; //user
$pass = '';   //root password
$db = 'EasyParking'; // database name

$con = mysqli_connect($hname,$uname,$pass,$db); //for connect to db

if(!$con){
    die("cannot connect to database".mysqli_connect_error()); //die stop execution
}

function filteration($data){           // common filteration
    foreach($data as $key => $value){
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}

function select($sql,$values,$datatypes)
{
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){
       mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)){
         $res = mysqli_stmt_get_result($stmt);
         mysqli_stmt_close($stmt);
         return $res;
       }
       else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Select");
       }
       
    }
    else{
        die("Query cannot be prepared - Select");
    }
}

?>