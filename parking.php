<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php');?>
    <title><?php echo $settings_r['site_title']?> -Parking</title>

       
</head>
<body class="bg-light">

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
<?php require('inc/header.php');?>





<!----------------- title ---------------->
<div class="my-5 px-4">
    <h2 class="fw-bold text-center">Parking</h2>
    <!-- <div class="h-line bg-dark"></div> -->
</div>

<!---------------- parking --------------->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <h4 class="mt-2">FILTERS</h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size:18px">CHECK AVAILABILITY</h5>
                            <label class="form-label" style="font-weight: 500;">Search</label>
                            <input class="form-control me-2 mb-3 shadow-none" type="search" placeholder="Search" aria-label="Search">
                            <label class="form-label">Check-in</label>
                            <input type="date" class="form-control shadow-none mb-3">
                            <label class="form-label">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>  
                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size:18px">FACILITIES</h5>
                            <div class="mb-2">
                                <input type="checkbox" id=""f1 class="form-check-input shadow-none me-1">
                                <label class="form-label" for="f1">Facility one</label>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" id=""f2 class="form-check-input shadow-none me-1">
                                <label class="form-label" for="f2">Facility two</label>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" id=""f3 class="form-check-input shadow-none me-1">
                                <label class="form-label" for="f3">Facility three</label>
                            </div>
                        </div>  
                    </div>
                </div>
            </nav>
        </div>


        <!------------ Card ------------->
        <div class="col-lg-9 col-md-12 px-4">

            <?php
                $parking_res = select("SELECT * FROM `parking` WHERE `status`=? AND `removed`=?",[1,0],'ii');
                
                while($parking_data = mysqli_fetch_assoc($parking_res))
                {
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
                    //dynamic display parking card
                    echo <<<data
                        <div class="card mb-4 border-0 shadow">
                            <div class="row g-0 p-3 align-items-center">
                                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                    <img src="$parking_thumb" class="img-fluid rounded">
                                </div>
                                <div class="col-md-5 px-lg-5 px-md-5 px-0">
                                    <h5 class="mb-3">$parking_data[name]</h5>
                                    <div class="features mb-3">
                                        <h6 class="mb-1">Services</h6>
                                        $services_data
                                    </div>
                                    <div class="rating mb-4">
                                        <h6 class="mb-1">Rating</h6>
                                        <span class="badge rounded-pill bg-light">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                        </span>  
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h6 class="mb-4">₹$parking_data[price] per Hour</h6>
                                    $book_btn
                                    <a href="parking_details.php?id=$parking_data[id]" class="btn btn-sm w-100 btn-outline-dark pt-2 shadow-none">More details</a>
                                </div>
                            </div>
                        </div>
                    data;
                }
            ?>
        </div>
    </div>
</div>

<!--------------- footer ----------------->
<?php require('inc/footer.php');?> 

<script src="inc/common.js"></script>
</body>
</html>