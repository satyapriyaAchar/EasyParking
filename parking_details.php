<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php');?>
    <title><?php echo $settings_r['site_title']?> -Parking Details</title>

</head>

<body class="bg-light">

<?php require('inc/header.php');?>

    <?php

        if(!isset($_GET['id']))
        {
            redirect('parking.php');
        }

        $data = filteration($_GET);

        $parking_res = select("SELECT * FROM `parking` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

        if(mysqli_num_rows($parking_res) == 0)
        {
            redirect('parking.php');
        }
        
        $parking_data = mysqli_fetch_assoc($parking_res);

    ?>
<!---------------- nav-bar ---------------->
<!-- <nav class="navi">
        <a href="index.php"><img src="images/logo.png" class="logo"></a>
        <ul id="sidemenu">
            <i class="fa-solid fa-house" style="color: azure;"></i>
            <li><a href="index.php">Home</a></li>
            <i class="fa-solid fa-xmark" onclick="closemenu()"></i>
        </ul>
        <i class="fa-solid fa-bars" onclick="openmenu()"></i>
        
</nav> -->



<!---------------- parking --------------->
<div class="container">
    <div class="row">

        <!----------------- title ---------------->
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold"><?php echo $parking_data['name']?></h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="parking.php" class="text-secondary text-decoration-none">PARKING</a>
            </div>
        </div>

        <!-- thumbnail -->
        <div class="col-lg-6 col-md-12 px-4">
            <div id="parkingCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        $parking_img = PARKING_IMG_PATH."thumbnail.png";
                        $img_q = mysqli_query($con,"SELECT * FROM `parking_image` 
                            WHERE `parking_id`='$parking_data[id]'");

                        if(mysqli_num_rows($img_q)>0)
                        {
                            $active_class ='active';

                            while($img_res = mysqli_fetch_assoc($img_q))
                            {
                                echo"
                                    <div class='carousel-item $active_class'>
                                    <img src='".PARKING_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded' height='300'>
                                    </div>
                                ";
                                $active_class = '';
                            }



                            $parking_thumb = PARKING_IMG_PATH.$thumb_res['image'];
                        }
                        else
                        {
                            echo"<div class='carousel-item active'>
                            <img src='$parking_img' class='d-block w-100'>
                            </div>";
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#parkingCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#parkingCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- card body -->

        <div class="col-lg-6 col-md-12 px-4">
          <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-body">
                <?php

                    echo<<<price
                     <h4>₹$parking_data[price] per Hour</h4>
                    price;

                    $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
                        WHERE `parking_id`='$parking_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

                    $rating_res = mysqli_query($con,$rating_q);
                    $rating_fetch = mysqli_fetch_assoc($rating_res);

                    $rating_data = "";

                    if($rating_fetch['avg_rating']!=NULL)
                    {
                        for($i=0; $i< $rating_fetch['avg_rating']; $i++)
                        {                    
                            $rating_data .="<i class='bi bi-star-fill text-warning'></i> ";
                        }
                    }
                    else
                    {
                        $rating_data .= "<p class='text-warning'>No reviews Yet!</p>";            
                    }

                    echo<<<rating
                       $rating_data
                    rating;

                    
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

                    echo<<<services
                        <div class="mb-3">
                            <h6 class="mb-1">Services</h6>
                            $services_data
                        </div>
                    services;

                    if(!$settings_r['shutdown']){
                        $login = 0;
                            if(isset($_SESSION['login']) && $_SESSION['login']==true)
                            {
                                $login = 1;
                            }
                            echo<<<book
                                <button onclick='checkLoginToBook($login,$parking_data[id])' class='btn btn-primary w-100 shadow-none mb-2'>Book Now</button>
                            book;
                    }
                ?>
            </div>
          </div>
        </div>


        <!------------ Card rating ------------->
        <div class="col-12 mt-4 px-4">
            <div class="mb-5">
                <h5>Description</h5>
                <p>
                    <?php echo $parking_data['description'] ?>
                </p>
            </div>
            <div>
                <h5 class="mb-3">Review & Rating</h5>
                <?php
                    $review_q = "SELECT rr.*,uc.name AS uname, uc.profile, p.name AS rname FROM `rating_review` rr 
                    INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                    INNER JOIN `parking` p ON rr.parking_id = p.id 
                    WHERE rr.parking_id = '$parking_data[id]'                       
                    ORDER BY `sr_no` DESC LIMIT 15";

                    $review_res = mysqli_query($con,$review_q);
                    $img_path = USERS_IMG_PATH;

                    if(mysqli_num_rows($review_res)==0)
                    {
                        echo<<<reviews
                             <p class='text-warning'>No reviews Yet!</p>
                             reviews;
                    }
                    else{
                        while($row = mysqli_fetch_assoc($review_res))
                        {
                            $stars = "<i class='bi bi-star-fill text-warning'></i> ";
                            for($i=1; $i< $row['rating']; $i++)
                            {                    
                                $stars .="<i class='bi bi-star-fill text-warning'></i> ";
                            }
                            echo<<<reviews
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="30px">
                                        <h6 class="m-0 ms-2">$row[uname]</h6>
                                    </div>
                                    <p class="mb-1">$row[review]</p>
                                    <div>
                                        $stars
                                    </div> 
                                </div>
                            reviews;
                        }
                    }
                ?>

                
            </div>
        
        </div>
    </div>
</div>

<!--------------- footer ----------------->
<?php require('inc/footer.php');?> 
</body>
</html>