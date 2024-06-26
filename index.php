<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">  
    <?php require('inc/links.php');?>
    <title><?php echo $settings_r['site_title']?></title>
</head>
<body>

<!------------ nav bar ---------------->
  <?php require('inc/header.php');?>

<!------------- Home  ----------------->
  <div  id="header" class="pt-5">
    <div class="container">
      <div class="header-text text-center pt-5">
        <h1 class="fs-1 fw-bold shadow" style="color:rgb(0, 247, 128) ">Welcome to EasyParking</h1>
        <h4 style="color: #05eeff;">Park your vehicle easily & securely</h4>
        <br>
      </div>

      <!-- checking parking availabilty -->

      <div class="container availabilty-form">
        <div class="row">
          <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Check Parking</h5>
            <form action="parking.php">
              <div class="row align-items-end">
                <div class="col-lg-4 mb-3">
                  <label class="form-label" style="font-weight: 500;">Check-in</label>
                  <input type="date" class="form-control shadow-none" name="checkin" required>
                </div>
                <div class="col-lg-4 mb-3">
                  <label class="form-label" style="font-weight: 500;">Check-out</label>
                  <input type="date" class="form-control shadow-none" name="checkout" required>
                </div>
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Vehicle Type</label> 
                  <select class="form-select shadow-none" name="vname">
                      <option selected>choose</option>
                      <?php
                        $vname_q = selectAll('parking');
                        while($row = mysqli_fetch_assoc($vname_q))
                        {
                            echo<<<vname
                                <option value='$row[name]'>$row[name]</option>
                            vname;
                        } 
                      ?>
                  </select>
                </div>
                <input type="hidden" name="check_availability">
                <div class="col-lg-1 mb-lg-3 mt-2">
                <button type="submit" class="btn btn-warning shadow-none">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        </div>
    </div> 
  </div>
    
  <br><br><br>
<!-- --------- Parking -------------- -->
<div id="Parking" class="pt-5">
  <div class="container p-3 mb-5 bg-body rounded">
    <h1 class="sub-title mt-5 ">Parking</h1>
    <div class="row">
      <?php
        $parking_res = select("SELECT * FROM `parking` WHERE `status`=? AND `removed`=?  LIMIT 3",[1,0],'ii');
        
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
              $book_btn ="<button onclick='checkLoginToBook($login,$parking_data[id])' class='btn btn-primary shadow-none'>Book Now</button>";
            }

            $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
              WHERE `parking_id`='$parking_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

            $rating_res = mysqli_query($con,$rating_q);
            $rating_fetch = mysqli_fetch_assoc($rating_res);

            $rating_data = "";

            if($rating_fetch['avg_rating']!=NULL)
            {
              $rating_data = "<div class='rating mb-4'>
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
              $rating_data = "<div class='rating mb-4'>
              <h6 class='mb-1'>Rating</h6>
              <span class='badge rounded-pill bg-light pt-2'>
               <p class='text-warning'>No reviews Yet!</p>
               </span>  
              </div>
              ";            
            }


            //dynamic display parking card
            echo <<<data
              <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width:350px;margin: auto;">
                  <img src="$parking_thumb" class="card-img-top">
                    <div class="card-body">
                    <h5>$parking_data[name]</h5>
                    <h6 class="mb-4">₹$parking_data[price] per Hour</h6>
                    <div class="features mb-4">
                      <h6 class="mb-1">Services</h6>
                      $services_data
                    </div>
                    $rating_data
                    <div class="d-flex justify-content-evenly mb-2">
                    $book_btn
                    <a href="parking_details.php?id=$parking_data[id]" class="btn btn-sm btn-outline-dark pt-2 shadow-none">More details</a>
                    </div>
                    </div>
                </div>
              </div>        
            data;
        }

      ?>
 
      <div class="col-lg-12 text-center mt-5">
        <a href="parking.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More</a>
      </div>    
    </div>
  </div>
</div>

<!-----------about section------------ -->
<?php
  $about_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
  $values = [1];
  $about_r = mysqli_fetch_assoc(select($about_q,$values,'i'));
  
?>
<div id="about" class="pt-5">
  <div class="container p-3 mb-5 bg-body rounded">
    <div class="row2">
      <h1 class="sub-title mt-5 mb-5">About This Website</h1>
      <p><?php echo $about_r['site_about']?></p>
    </div>
  </div>
</div>

<!--------services section--------------->
<div id="services" class="pt-5">
  <div class="container p-3 mb-5 bg-body rounded">
    <h1 class="sub-title mt-5">Our Services</h1>
    <div class="services-list">
      <?php
         $res = selectAll('services');
         $path = SERVICES_IMG_PATH;

         while($row = mysqli_fetch_assoc($res))
         {
          echo <<<data
          <div class="dynamic_services">
            <img src="$path$row[icon]" width="40px" style="margin-bottom: 30px">
            <h2>$row[name]</h2>
            <p>$row[description]</p>
            <a href="#">Learn more</a>
          </div>
          data;
         }
      ?>
    </div>
  </div>
</div>

<!--------testimonial--------------->
<!-- <div id="testimonial" class="pt-5">
  <div class="container p-3 mb-5 bg-body rounded">
    <h1 class="sub-title mt-5">Testimonial</h1>
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-item-center mb-3">
            <img src="images/services/IMG_37766.svg" width="30px">
            <h6 class="m-0 ms-2">USer 1</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, aliquid! Doloribus aspernatur officiis quia illum. Cum porro suscipit repellendus voluptate recusandae doloribus molestiae, delectus magni dignissimos molestias velit, voluptatibus accusantium?
          </p>
          <div class="rating">
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>
            <i class="bi bi-star-fill text-warning"></i>            
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->


<!-----------faq section------------------>
<div id="question" class="pt-5">
  <div class="container p-3 mb-5 bg-body rounded">
    <h1 class="sub-title mt-5 ">Frequently Asked Questions</h1>
    <div class="accordion mt-5" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            How do I make a parking reservation?  
        </button>
        </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Making a parking reservation is quick and easy. Simply visit our website, select your desired location, date, and duration, and follow the prompts to complete your reservation. You will receive a confirmation email with all the details 
            </div>
          </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Can I modify or cancel my parking reservation?
          </button>
        </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                Yes, you can modify or cancel your parking reservation depending on the terms and conditions of the specific parking location. Log in to your account on our website and navigate to the reservation management section to make any changes or cancellations 
            </div>
          </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          What happens if I arrive late or early for my reserved parking time?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            We understand that travel plans can change. In most cases, there is a grace period for early or late arrivals. However, it is always recommended to adhere to your reserved parking time to ensure a smooth experience. Check the specific parking location's terms and conditions for more details
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Is my vehicle safe at the parking facility?
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Yes, we prioritize the safety and security of your vehicle. Our parking facilities are carefully selected and equipped with advanced security measures, including surveillance cameras, well-lit areas, and on-site personnel. However, we recommend not leaving any valuable items in plain sight inside your vehicle         
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Are there any height or size restrictions for vehicles?      </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Some parking facilities may have height or size restrictions. During the reservation process, you will be able to view any limitations or restrictions specific to the chosen parking location. If you have a larger or oversized vehicle, it is recommended to check the available options or contact our customer support for assistance          
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
          <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseFour">
          What payment methods are accepted?
          </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            We accept various payment methods, including major credit cards, debit cards, and digital wallets. The accepted payment options will be displayed during the reservation process. Rest assured that your payment information is processed securely          
          </div>
        </div>
      </div>
    </div>
      
  </div>
</div>

<!----------contact section---------------->
<?php
  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $values = [1];
  $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
?>
<div id="contact" class="pt-5">
  <div class="container p-3 mb-5 bg-body rounded">
    <div class="row2">
      <div class="contact-left">
        <h1 class="sub-title mt-5">Contact Us</h1>
        <div class="row">
          <div class="col-6">
          <h2>Address</h2>
          <p ><?php echo $contact_r['address']?></p>
          <div class="gmap">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3688.0448925267874!2d87.85924817424544!3d22.42733607959538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02980f71daa971%3A0xd8a291eb93011bcf!2sCollege%20Of%20Engineering%20%26%20Management%2C%20Kolaghat!5e0!3m2!1sen!2sin!4v1713462232878!5m2!1sen!2sin" width="80%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>          </div>
          <h2><i class="fa-solid fa-envelope"></i>Email</h2>
          <p><?php echo $contact_r['email']?></p>
          <h2><i class="fa-solid fa-phone"></i>Phone</h2>
          <p><?php echo $contact_r['pn1']?></p>
          <div class="social-icons">
            <a href="<?php echo $contact_r['linkd']?>"><i class="fa-brands fa-linkedin" style="color: blue;"></i></a>
            <a href="<?php echo $contact_r['tw']?>"><i class="fa-brands fa-twitter"></i></a>
            <a href="<?php echo $contact_r['yt']?>"><i class="fa-brands fa-youtube" style="color: #e54b24;"></i></a>
            <a href="<?php echo $contact_r['wp']?>"><i class="fa-brands fa-whatsapp" style="color: #16ac34;"></i></a>
          </div>
          </div>
          <div class="col-6">
          <h2>Connect us</h2>
            <form method="POST">
              <label class="form-label" for="form4Example1">Name</label> 
              <div data-mdb-input-init class="form-outline mb-4">
                <input name="name" type="text" id="form4Example1" class="form-control shadow-none" required />
              </div>
              <!-- Email input -->
              <label class="form-label" for="form4Example2">Email address</label>
              <div data-mdb-input-init class="form-outline mb-4">
                <input name="email" type="email" id="form4Example2" class="form-control shadow-none" required  />
              </div>
              <label class="form-label" for="form4Example3">Subject</label> 
              <div data-mdb-input-init class="form-outline mb-4">
                <input name="subject" type="text" id="form4Example3" class="form-control shadow-none" required />
              </div>
              <!-- Message input -->
              <label class="form-label" for="form4Example4">Message</label>
              <div data-mdb-input-init class="form-outline mb-4">
                <textarea name="message" class="form-control shadow-none" id="form4Example4" rows="4"></textarea>               
              </div>
              <button name="send" type="submit" class="btn btn-primary">SEND</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
   if(isset($_POST['send']))
   {
    $frm_data = filteration($_POST);

    $q = "INSERT INTO `user_queries`(`name`, `email`,`subject`,`message`) VALUES (?,?,?,?)";
    $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

    $res = insert($q,$values,'ssss');
    if($res == 1)
    {
      alert('success','Mail sent!');
    }
    else{
      alert('error','server Down! Try again later');
    }
   }
?> 
  <!-- Password reset modal -->

  <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="recovery-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-shield-lock fs-3 me-2"></i>Set new Password
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">New Password</label>
                        <input type="password" name="pass" class="form-control shadow-none" required>
                        <input type="hidden" name="email">
                        <input type="hidden" name="token">
                    </div>
                    <div class=" mb-2 text-end">
                        <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">
                           cancel
                        </button>  
                        <button type="submit" class="btn btn-primary shadow-none" >Submit</button>
                    </div>
                </div>   
            </form>
        </div>
    </div>
  </div>

<!----------- footer section ---------------->
<?php require('inc/footer.php');?>

<?php 

   if(isset($_GET['account_recovery']))
   {
    $data = filteration($_GET);

    $t_date = date("Y-m-d");

    $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
      [$data['email'],$data['token'],$t_date],'sss');

      if(mysqli_num_rows($query)==1)
      {
        echo<<<showModal
          <script>
            var myModal = document.getElementById('recoveryModal');

            myModal.querySelector("input[name='email']").value = '$data[email]';
            myModal.querySelector("input[name='token']").value = '$data[token]';

            var modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
          </script>
        showModal;
      }
      else{
        alert("error","Invalid or Expired Link!");
      }
   }

?>



<!------------- responsive nav bar ----------->
<script src="inc/common.js"></script>

<script>
  //recover account

  let recovery_form = document.getElementById('recovery-form');

  recovery_form.addEventListener('submit',(e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('email',recovery_form.elements['email'].value);
    data.append('token',recovery_form.elements['token'].value);
    data.append('pass',recovery_form.elements['pass'].value);

    data.append('recover_user','');

    var myModal = document.getElementById('recoveryModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){

        if(this.responseText == 'failed'){
            alert('error',"Account reset failed");
        }
        else{
            alert('success',"Account Reset Successful");
            recovery_form.reset();

        }
    }
    xhr.send(data);
  });  

</script>

</body>
</html>