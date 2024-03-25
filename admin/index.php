<?php
    require('inc/essential.php'); 
    require('inc/db_config.php'); 

    session_start();
    if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
        redirect('dashboard.php'); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="admin.css">
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <div class="login-form shadow">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_id" required type="text" class="form-control shadow-none text-center" placeholder="Admin userId">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn btn-success shadow-none">LOGIN</button>
            </div>
        </form>
    </div>
    <?php
      
      if(isset($_POST['login']))
      {
        $frm_data = filteration($_POST);
        // echo"<h1>$frm_data[admin_id]</h1>";
        // echo"<h1>$frm_data[admin_pass]</h1>";
        $query = "SELECT * FROM `admin` WHERE `admin_id`=? AND `admin_pass`=?";
        $values=[$frm_data['admin_id'],$frm_data['admin_pass']];
        // $datatypes ="ss";
        $res = select($query,$values,"ss");
        // print_r($res); 
        if($res->num_rows == 1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('dashboard.php');
        }     
        else{
            alert('error','Login failed - Invalid Credentials!');
        }
        // print_r($frm_data);
      }
    ?>

    <?php require('inc/scripts.php') ?>
</body>
</html>