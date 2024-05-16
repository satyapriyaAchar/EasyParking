<?php
    require('../admin/inc/db_config.php');
    require('../admin/inc/essential.php');
    date_default_timezone_set("Asia/Kolkata");


    session_start();

    if(isset($_GET['fetch_parking']))
    {
        $chk_avail = json_decode($_GET['chk_avail'],true);

        if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
        {
            $today_date = new DateTime(date("Y-m-d"));
            $checkin_date = new DateTime($chk_avail['checkin']);
            $checkout_date = new DateTime($chk_avail['checkout']);

            if($checkout_date == $checkin_date){
                echo"<h3 class='text-center text-danger'>Invalid Dates</h3>";
                exit;
            }
            else if($checkout_date < $checkin_date){
                echo"<h3 class='text-center text-danger'>Invalid Dates</h3>";
                exit;
            }
            else if($checkin_date < $today_date){
                echo"<h3 class='text-center text-danger'>Invalid Dates</h3>";
                exit;
            }
        }

        //count numbers of parking slots and output varibale to parking cards
        $count_parking = 0;
        $output = "";

        //fetching settings table to check website is shutdown or not
        $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
        $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q));

        //query for parking cards
        $parking_res = select("SELECT * FROM `parking` WHERE `status`=? AND `removed`=?",[1,0],'ii');
                
        while($parking_data = mysqli_fetch_assoc($parking_res))
        {
        
            if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
            {
                $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` WHERE 
                `booking_status`=? AND parking_id=?
                 AND check_out > ? AND check_in < ? ";
    
                $values = ['booked',$parking_data['id'],$chk_avail['checkin'],$chk_avail['checkout']];

                $tb_fetch = mysqli_fetch_assoc(select($tb_query,$values,'siss'));

                if(($parking_data['quantity']-$tb_fetch['total_bookings']) == 0)
                {
                    continue;
                }
            }


            //get services of parking

            $fea_q = mysqli_query($con,"SELECT p.name FROM `services` p 
                INNER JOIN `parking_services` pser ON p.id = pser.services_id
                WHERE pser.parking_id = '$parking_data[id]'");

            $services_data = "";
            while($fea_row = mysqli_fetch_assoc($fea_q))
            {
                $services_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                    $fea_row[name]
                </span>";
                
            }

            //get thumbnail of parking

            $parking_thumb = PARKING_IMG_PATH."thumbnail.png";
            $thumb_q = mysqli_query($con,"SELECT * FROM `parking_image` 
                WHERE `parking_id`='$parking_data[id]' AND `thumb`='1'");

            if(mysqli_num_rows($thumb_q)>0)
            {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $parking_thumb = PARKING_IMG_PATH.$thumb_res['image'];
            }
            
            $book_btn ="";

            if(!$settings_r['shutdown']){
                $login = 0;
                if(isset($_SESSION['login']) && $_SESSION['login']==true)
                {
                    $login = 1;
                }
                $book_btn ="<button onclick='checkLoginToBook($login,$parking_data[id])' class='btn btn-primary w-100 shadow-none mb-2'>Book Now</button>";
            }

            $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
                WHERE `parking_id`='$parking_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

            $rating_res = mysqli_query($con,$rating_q);
            $rating_fetch = mysqli_fetch_assoc($rating_res);

            $rating_data = "";

            if($rating_fetch['avg_rating']!=NULL)
            {
                $rating_data .= "<div class='rating mb-4'>
                    <h6 class='mb-1'>Rating</h6>
                    <span class='badge rounded-pill bg-light'>
                ";
                for($i=0; $i< $rating_fetch['avg_rating']; $i++)
                {                    
                    $rating_data .="<i class='bi bi-star-fill text-warning'></i> ";
                }
                $rating_data .="</span>  
                </div>";
            }
            else
            {
                $rating_data .= "<div class='rating mb-4'>
                <h6 class='mb-1'>Rating</h6>
                <span class='badge rounded-pill bg-light pt-2'>
                <p class='text-warning'>No reviews Yet!</p>
                </span>  
                </div>
                ";            
            }

            //dynamic display parking card
            $output .="
                <div class='card mb-4 border-0 shadow'>
                    <div class='row g-0 p-3 align-items-center'>
                        <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                            <img src='$parking_thumb' class='img-fluid rounded'>
                        </div>
                        <div class='col-md-5 px-lg-5 px-md-5 px-0'>
                            <h5 class='mb-3'>$parking_data[name]</h5>
                            <div class='features mb-3'>
                                <h6 class='mb-1'>Services</h6>
                                $services_data
                            </div>
                            $rating_data
                        </div>
                        <div class='col-md-2 text-center'>
                            <h6 class='mb-4'>₹$parking_data[price] per Hour</h6>
                            $book_btn
                            <a href='parking_details.php?id=$parking_data[id]' class='btn btn-sm w-100 btn-outline-dark pt-2 shadow-none'>More details</a>
                        </div>
                    </div>
                </div>
            ";
            $count_parking++;
        }
        if($count_parking>0)
        {
            echo $output;
        }
        else{
            echo"<h3 class='text-center text-danger'>No parking found</h3>";
        }
    }




?>