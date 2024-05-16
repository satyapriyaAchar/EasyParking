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
                            <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:18px">
                                <span>CHECK AVAILABILITY</span>
                                <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn btn-primary btn-sm shadow-none d-none">Reset</button>
                            </h5>
                            <label class="form-label">Check-in</label>
                            <input type="date" class="form-control shadow-none mb-3" id="checkin" onchange="chk_avail_filter()">
                            <label class="form-label">Check-out</label>
                            <input type="date" class="form-control shadow-none" id="checkout" onchange="chk_avail_filter()">
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
        <div class="col-lg-9 col-md-12 px-4" id="parking-data">
            
        </div>
    </div>
</div>


<script>

    let parking_data = document.getElementById('parking-data');
    let checkin = document.getElementById('checkin');
    let checkout = document.getElementById('checkout');
    let chk_avail_btn = document.getElementById('chk_avail_btn');

    function fetch_parking()
    {
        let chk_avail = JSON.stringify({
            checkin: checkin.value,
            checkout: checkout.value
        });
        let xhr = new XMLHttpRequest();
        xhr.open("GET","ajax/parking.php?fetch_parking&chk_avail="+chk_avail,true);
    
        xhr.onprogress = function()
        {
            parking_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
                <span class="visually-hidden">loader</span>
            </div>`;
        }

        xhr.onload = function()
        {
            parking_data.innerHTML = this.responseText;
        }

        xhr.send();
    }

    function chk_avail_filter()
    {
        if(checkin.value != '' && checkout.value !=''){
            fetch_parking();
            chk_avail_btn.classList.remove('d-none');
        }
    }
    function chk_avail_clear()
    {
        checkin.value = '';
        checkout.value ='';
        chk_avail_btn.classList.remove('d-none');
        fetch_parking();
        
    }





    fetch_parking();
</script>

<!--------------- footer ----------------->
<?php require('inc/footer.php');?> 

<script src="inc/common.js"></script>
</body>
</html>