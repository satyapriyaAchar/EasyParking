<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php');?>
    <title><?php echo $settings_r['site_title']?> -Booking Status</title>

</head>

<body class="bg-light">

<?php require('inc/header.php');?>

    <?php

        if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
        {
            redirect('index.php');
        }

        //filter and get parking and user data
        $data = filteration($_GET);

        $parking_res = select("SELECT * FROM `parking` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

        if(mysqli_num_rows($parking_res) == 0)
        {
            redirect('parking.php');
        }
        
        $parking_data = mysqli_fetch_assoc($parking_res);

        $_SESSION['parking'] =[
            "id" => $parking_data['id'],
            "name" => $parking_data['name'],
            "price" => $parking_data['price'],
            "payment" => null,
            "available" => false,
        ];

        $user_res = select("SELECT * FROM `user_cred` WHERE `id` = ?  LIMIT 1",
            [$_SESSION['uId']],"i");
        $user_data = mysqli_fetch_assoc($user_res);


    ?>

<!---------------- parking --------------->
<div class="container">
    <div class="row">

        <!----------------- title ---------------->
        <div class="col-12 my-5 mb-3 px-4">
            <h2 class="fw-bold">Payment Status</h2>
            
        </div>

        <?php

            $frm_data = filteration($_GET);
            if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
            {
                redirect('index.php');
            }

            $booking_q = "SELECT bo.*, bd.* FROM `booking_order` bo
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                WHERE bo.order_id=? AND bo.user_id=? AND bo.booking_status!=?";

            $booking_res = select($booking_q,[$frm_data['order'],$_SESSION['uId'],'pending'],'sis');

            if(mysqli_num_rows($booking_res)==0)
            {
                redirect('index.php');
            }

            $booking_fetch = mysqli_fetch_assoc($booking_res);

            if($booking_fetch['trans_status']=="TXN_SUCCESS")
            {
                echo<<<data
                    <div class="col-12 px-4">
                        <p class="fw-bold alert-success">
                            <i class="bi bi-check-circle-fill"></i>
                            Payment done! Booking successful.
                            <br><br>
                            <a href='bookings.php'>Go to Bookings</a>
                        </p>
                    </div>
                data;
            }
            else{

                echo<<<data
                    <div class="col-12 px-4">
                        <p class="fw-bold alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Payment failed! $booking_fetch[trans_resp_msg]
                            <br><br>
                            <a href='bookings.php'>Go to Bookings</a>
                        </p>
                    </div>
                data;

            }
        ?>


    </div>
</div>

<!--------------- footer ----------------->
    <?php require('inc/footer.php');?> 

    

</body>
</html>