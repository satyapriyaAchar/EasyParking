<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking</title>
    <?php require('inc/links.php');?>
    
</head>
<body class="bg-light">

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid justify-content-center">
  <a href="index.php"><img src="images/logo.png" class="logo mx-3" style="width:80px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </div>
  </div>
</nav>
    <div class="my-5 px-4">
        <h2 class="fw-bold text-center">Parking</h2>
     </div>
    <div class="container">
         <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
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
                              <input class="form-control me-2 mb-3" type="search" placeholder="Search" aria-label="Search">
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
            <div class="col-lg-9 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/1.webp" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-5 px-md-5 px-0">
                            <h5 class="mb-3">Two Wheeler</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    Cleaning
                                </span>
                                <span class="badge rounded-pill  bg-light text-dark text-wrap">
                                    security
                                </span>
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
                          <h6 class="mb-4">₹5 per Hour</h6>
                          <a href="#" class="btn btn-primary w-100 shadow-none mb-2">Book Now</a>
                          <a href="#" class="btn btn-sm w-100 btn-outline-dark pt-2 shadow-none">More</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/3.webp" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-5 px-md-5 px-0">
                            <h5 class="mb-3">Three Wheeler</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    Cleaning
                                </span>
                                <span class="badge rounded-pill  bg-light text-dark text-wrap">
                                    security
                                </span>
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
                          <h6 class="mb-4">₹10 per Hour</h6>
                          <a href="#" class="btn btn-primary w-100 shadow-none mb-2">Book Now</a>
                          <a href="#" class="btn btn-sm w-100 btn-outline-dark pt-2 shadow-none">More</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/2.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-5 px-md-5 px-0">
                            <h5 class="mb-3">Four Wheeler</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    Cleaning
                                </span>
                                <span class="badge rounded-pill  bg-light text-dark text-wrap">
                                    security
                                </span>
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
                          <h6 class="mb-4">₹20 per Hour</h6>
                          <a href="#" class="btn btn-primary w-100 shadow-none mb-2">Book Now</a>
                          <a href="#" class="btn btn-sm w-100 btn-outline-dark pt-2 shadow-none">More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <?php require('inc/footer.php');?> 
</body>
</html>