<?php
    require('../admin/inc/db_config.php');
    require('../admin/inc/essential.php');

    if(isset($_POST['register']))
    {
        $data = filteration($_POST);
        
        //check password and confirm password

        if($data['pass'] != $data['cpass'])
        {
            echo 'pass_mismatch';
            exit;
        }
        // check user exists or not
    }
?>