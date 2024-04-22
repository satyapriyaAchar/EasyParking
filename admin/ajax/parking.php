<?php
    require('../inc/db_config.php');
    require('../inc/essential.php');
    adminLogin();

    if(isset($_POST['add_parking']))
    {

       $services = filteration(json_decode(($_POST['services'])));
       $frm_data = filteration($_POST);
       $flag = 0;

       //print_r($frm_data);

        $q1 = "INSERT INTO `parking`(`name`, `price`, `quantity`, `description`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['price'],$frm_data['quantity'],$frm_data['desc']];

        if(insert($q1,$values,'siis')){
            $flag = 1;
        }

        $parking_id = mysqli_insert_id($con);

        $q2 = "INSERT INTO `parking_services`(`parking_id`, `services_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($con,$q2))
        {
            foreach($services as $f)
            {
                mysqli_stmt_bind_param($stmt,'ii',$parking_id,$f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            $flag=0;
            die('query cannot be prepared - insert');
        }


        if($flag ){
            echo 1;
        }
        else{
            echo 0;
        }
       


    }

    if(isset($_POST['get_all_parking']))
    {
        $res = select("SELECT * FROM `parking` WHERE `removed`=?",[0],'i');
        $i=1;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['status']==1){
                $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";
            }
            else{
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Inactive</button>";
            }


            $data.="
                <tr class='align-middle'>
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>$row[price]</td>
                    <td>$row[quantity]</td>
                    <td>$status</td>
                    <td>
                        <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-parking'>
                            <i class='bi bi-pencil-square'></i> Edit
                        </button>
                        <button type='button' onclick=\"parking_images($row[id],'$row[name]')\" class='btn btn-info shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#parking-images'>
                            <i class='bi bi-images'></i> Img
                        </button>
                        <button type='button' onclick='remove_parking($row[id])' class='btn btn-danger shadow-none btn-sm'>
                            <i class='bi bi-trash'></i> Delete
                        </button>
                    </td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }

    if(isset($_POST['get_parking']))
    {
        $frm_data = filteration($_POST);

        $res1 = select("SELECT * FROM `parking` WHERE `id`=?",[$frm_data['get_parking']],'i');
        $res2 = select("SELECT * FROM `parking_services` WHERE `parking_id`=?",[$frm_data['get_parking']],'i');

        $parkingdata = mysqli_fetch_assoc($res1);
        $services = [];

        if(mysqli_num_rows($res2)>0){
            while($row = mysqli_fetch_assoc($res2)){
                array_push($services,$row['services_id']);
            }
        }

        $data =["parkingdata" => $parkingdata, "services"=> $services];

        $data = json_encode($data);
        
        echo $data;
    }

    if(isset($_POST['edit_parking']))
    {
        $services = filteration(json_decode(($_POST['services'])));
        $frm_data = filteration($_POST);
        $flag = 0;
 
        //print_r($frm_data);
 
         $q1 = "UPDATE `parking` SET `name`=?,`price`=?,`quantity`=?,`description`=? WHERE `id`=?";
         $values = [$frm_data['name'],$frm_data['price'],$frm_data['quantity'],$frm_data['desc'],$frm_data['parking_id']];
 
         if(update($q1,$values,'siisi')){
             $flag = 1;
         }
 
         $del_services = delete("DELETE FROM `parking_services` WHERE `parking_id`=?",[$frm_data['parking_id']],'i');
        
         if(!($del_services)){
            $flag = 0;
         }
        //  $parking_id = mysqli_insert_id($con);
 
         $q2 = "INSERT INTO `parking_services`(`parking_id`, `services_id`) VALUES (?,?)";
 
         
         if($stmt = mysqli_prepare($con,$q2))
         {
             foreach($services as $f)
             {
                 mysqli_stmt_bind_param($stmt,'ii',$frm_data['parking_id'],$f);
                 mysqli_stmt_execute($stmt);
             }
             $flag = 1;
             mysqli_stmt_close($stmt);
         }
         else{
             $flag=0;
             die('query cannot be prepared - insert');
         }
 
 
         if($flag ){
             echo 1;
         }
         else{
             echo 0;
         }
        
    }


    if(isset($_POST['toggle_status']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `parking` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q,$v,'ii'))
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }


    if(isset($_POST['add_image']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['image'],PARKING_FOLDER);
        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{ 
            
            $q = "INSERT INTO `parking_image`(`parking_id`,`image`) VALUES (?,?)";
            $values = [$frm_data['parking_id'],$img_r];
            $res = insert($q,$values,'is');
            echo $res;
            
        }
        

    }


    if(isset($_POST['get_parking_images']))
    {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `parking_image` WHERE `parking_id`=?",[$frm_data['get_parking_images']],'i');
        
        $path = PARKING_IMG_PATH;
        
        while($row = mysqli_fetch_assoc($res))
        {
            if($row['thumb'] == 1)
            { 
                $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
            }
            else{
                $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[parking_id])' class='btn btn-secondary shadow-none'>
                    <i class='bi bi-check-lg'></i>
                </button>";
            }

            echo <<<data
            <tr class='align-middle'>
                <td><img src='$path$row[image]' class='img-fluid'></td>
                <td>$thumb_btn</td>
                <td>
                    <button onclick='rem_image($row[sr_no],$row[parking_id])' class='btn btn-danger  shadow-none'>
                      <i class='bi bi-trash'></i>
                    </button>

                </td>
            </tr>
            data;
        }
        

    }

    if(isset($_POST['rem_image']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['image_id'],$frm_data['parking_id']];

        $pre_q = "SELECT * FROM `parking_image` WHERE `sr_no`=? AND `parking_id`=?";
        $res = select($pre_q,$values,'ii');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['image'],PARKING_FOLDER)){
            $q = "DELETE FROM `parking_image` WHERE `sr_no`=? AND `parking_id`=?";
            $res = delete($q,$values,'ii');
            echo $res;   
        }
        else{
            echo 0;
        }
        
        
        
    }

    if(isset($_POST['thumb_image']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['image_id'],$frm_data['parking_id']];

        $pre_q = "UPDATE `parking_image` SET `thumb`=? WHERE `parking_id`=?";
        $pre_v = [0,$frm_data['parking_id']];
        $pre_res = update($pre_q,$pre_v,'ii');

        $q = "UPDATE `parking_image` SET `thumb`=? WHERE `sr_no`=? AND `parking_id`=?";
        $v = [1,$frm_data['image_id'],$frm_data['parking_id']];
        $res = update($q,$v,'iii');

        echo $res;
    }

    if(isset($_POST['remove_parking']))
    {
        $frm_data = filteration($_POST);
        
        $res1 = select("SELECT * FROM `parking_image` WHERE `parking_id`=?",[$frm_data['parking_id']],'i');

        while($row = mysqli_fetch_assoc($res1))
        {
            deleteImage($row['image'],PARKING_FOLDER);
        }

        $res2 = delete("DELETE FROM `parking_image` WHERE `parking_id`=?",[$frm_data['parking_id']],'i');
        $res3 = delete("DELETE FROM `parking_services` WHERE `parking_id`=?",[$frm_data['parking_id']],'i');
        $res4 = update("UPDATE `parking` SET `removed`=? WHERE `id`=?",[1,$frm_data['parking_id']],'ii');
        

        if($res2 || $res3 || $res4)
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }


?>