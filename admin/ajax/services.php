<?php
    require('../inc/db_config.php');
    require('../inc/essential.php');
    adminLogin();

    if(isset($_POST['add_services']))
    {
        
        $frm_data = filteration($_POST);

        $img_r = uploadSVGImage($_FILES['icon'],SERVICES_FOLDER);
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
            
            $q = "INSERT INTO `services`(`name`, `icon`, `description`) VALUES (?,?,?)";
            $values = [$frm_data['name'],$img_r,$frm_data['desc']];
            $res = insert($q,$values,'sss');
            echo $res;
        }
        

    }

    if(isset($_POST['get_services']))
    {
        $res = selectAll('services');
        $i=1;
        $path = SERVICES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
            <tr class='align-middle'>
                <td>$i</td>
                <td><img src="$path$row[icon]" width="60px"></td>
                <td>$row[name]</td>
                <td>$row[description]</td>
                <td>
                    <button type="button" onclick="rem_services($row[id])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </td>
            </tr>
            data;
            $i++;
        }

    }

    if(isset($_POST['rem_services']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_services']];

        $check_q = select('SELECT * FROM `parking_services` WHERE `services_id`=?',[$frm_data['rem_services']],'i');

        if(mysqli_num_rows($check_q)==0)
        {
            $pre_q = "SELECT * FROM `services` WHERE `id`=?";
            $res = select($pre_q,$values,'i');
            $img = mysqli_fetch_assoc($res);

            if(deleteImage($img['icon'],SERVICES_FOLDER)){
            $q = "DELETE FROM `services` WHERE `id`=?";
            $res = delete($q,$values,'i');
            echo $res;   
            }
            else{
                echo 0;
            }
        }
        else{
            echo 'parking_added';
        }
        
    }
    
    

    
?>