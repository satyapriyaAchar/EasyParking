<?php

$hname = 'localhost'; // variable
$uname = 'root';
$pass = '';   //root password
$db = 'EasyParking'; // database name

$con = mysqli_connect($hname,$uname,$pass,$db); //for connect to db

if(!$con){
    die("cannot connect to database".mysqli_connect_error()); //die stop execution
}

function filteration($data){           // common filteration
    foreach($data as $key => $value){
        $data[$key] = trim($value); //extra space remove
        $data[$key] = stripslashes($value); //back slash remove
        $data[$key] = htmlspecialchars($value);// special char convert to html entities
        $data[$key] = strip_tags($value); //html tag remove
    }
    return $data;  // return to index.php filteration call
}

function select($sql,$values,$datatypes) //prepare
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
        die("Query cannot be executed - select");
       }
       
    }
    else{
        die("Query cannot be prepared - select");
    }
}

function update($sql,$values,$datatypes) //prepare
{
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){
       mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)){
         $res = mysqli_stmt_affected_rows($stmt);
         mysqli_stmt_close($stmt);
         return $res;
       }
       else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - update");
       }
       
    }
    else{
        die("Query cannot be prepared - update");
    }
}

?>