<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php');?>
    <title><?php echo $settings_r['site_title']?> -Confirm Booking  ew</title>

</head>

<body class="bg-light">

<?php require('inc/header.php');?>

    <?php

        /*
            check parking id from url is present or not
            shutdown mode is active or not
            user is logged in or not
        */
        if(!isset($_GET['id']) || $settings_r['shutdown']==true)
        {
            redirect('parking.php');
        }
        else if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
        {
            redirect('parking.php');
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
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">Confirm Booking</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="parking.php" class="text-secondary text-decoration-none">PARKING</a>
                <span class="text-secondary"> > </span>
                <a href="parking.php" class="text-secondary text-decoration-none">CONFIRM</a>
            </div>
        </div>

        <!-- thumbnail -->
        <div class="col-lg-6 col-md-12 px-4">
           <?php
                $parking_thumb = PARKING_IMG_PATH."thumbnail.png";
                $thumb_q = mysqli_query($con,"SELECT * FROM `parking_image` 
                    WHERE `parking_id`='$parking_data[id]' AND `thumb`='1'");

                if(mysqli_num_rows($thumb_q)>0)
                {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $parking_thumb = PARKING_IMG_PATH.$thumb_res['image'];
                }

                echo<<<data
                    <div class="card p-3 shadow-sm rounded">
                        <img src="$parking_thumb" class="img-fluid rounded mb-3">
                        <h5>$parking_data[name]</h5>
                        <h6>₹$parking_data[price] per hour</h6>
                    </div>
                data;
           ?>
        </div>

        <!-- card body -->

        <div class="col-lg-6 col-md-12 px-4">
          <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-body">
                <form action="#">
                    <h6 class="mb-3">BOOKING DETAILS</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>      
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>      
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['address']?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Check-in</label>
                            <input name="checkin" type="date"  class="form-control shadow-none" required>      
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Check-out</label>
                            <input name="checkout" type="date"  class="form-control shadow-none" required>      
                        </div>
                        <div class="col-12">
                            <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                <span class="visually-hidden">lod</span>
                            </div>
                            <h6 class="mb-3 text-danger" id="pay_info">Provide check-in & check-out date</h6>
                            <button name="pay_now" class="btn btn-primary w-100 text-white  shadow-none mb-1 disabled">Pay Now</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>

    </div>
</div>

<!--------------- footer ----------------->
<?php require('inc/footer.php');?> 
</body>
</html>