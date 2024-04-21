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
        $res = selectAll('parking');
        $i=1;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            if($row['status']==1){
                $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
            }
            else{
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
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
                            <i class='bi bi-pencil-square'></i> EDIT
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

?>