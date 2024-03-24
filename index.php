<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>EasyParking</title>
    
    <link rel="stylesheet" href="common.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2285a15cc8.js" crossorigin="anonymous"></script>

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
      <div class="container availabilty-form">
        <div class="row">
          <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Check Parking</h5>
            <form>
              <div class="row align-items-end">
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Search</label>
                  <input class="form-control me-2 shadow-none" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Check-in</label>
                  <input type="date" class="form-control shadow-none">
                </div>
                <div class="col-lg-3 mb-3">
                  <label class="form-label" style="font-weight: 500;">Check-out</label>
                  <input type="date" class="form-control shadow-none">
                </div>
                <div class="col-lg-2 mb-3">
                  <label class="form-label" style="font-weight: 500;">Vehicle Type</label> 
                  <select class="form-select shadow-none">
                      <option selected>choose</option>
                      <option value="1">2 Wheeler</option>
                      <option value="2">3 wheeler</option>
                      <option value="2">4 wheeler</option>
                  </select>
                </div>
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
<!-- ---------- Parking -------------- -->

<div id="Parking" class="pt-5">
 <div class="container">
 <h1 class="sub-title mt-5 ">Parking</h1>
   <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
     <div class="card border-0 shadow" style="max-width:350px;margin: auto;">
       <img src="images/1.webp" class="card-img-top">
        <div class="card-body">
         <h5>Two Wheeler</h5>
         <h6 class="mb-4">₹5 per Hour</h6>
         <div class="features mb-4">
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
         <div class="d-flex justify-content-evenly mb-2">
         <a href="#" class="btn btn-primary shadow-none">Book Now</a>
         <a href="#" class="btn btn-sm btn-outline-dark pt-2 shadow-none">More</a>
        </div>
        </div>
     </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
     <div class="card border-0 shadow" style="max-width:350px;margin: auto;">
       <img src="images/3.webp" class="card-img-top" alt="...">
        <div class="card-body">
         <h5>Three Wheeler</h5>
         <h6 class="mb-4">₹10 per Hour</h6>
         <div class="features mb-4">
           <h6 class="mb-1">Facilities</h6>
           <span class="badge rounded-pill bg-light text-dark text-wrap">
            Cleaning
           </span>
           <span class="badge rounded-pill bg-light text-dark text-wrap">
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
         <div class="d-flex justify-content-evenly mb-2">
         <a href="#" class="btn btn-primary shadow-none">Book Now</a>
         <a href="#" class="btn btn-sm btn-outline-dark pt-2 shadow-none">More details</a>
        </div>
        </div>
     </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
     <div class="card border-0 shadow" style="max-width:350px;margin: auto;">
       <img src="images/2.jpg" class="card-img-top" alt="...">
        <div class="card-body">
         <h5>Four Wheeler</h5>
         <h6 class="mb-4">₹20 per Hour</h6>
         <div class="features mb-4">
           <h6 class="mb-1">Facilities</h6>
           <span class="badge rounded-pill bg-light text-dark text-wrap">
            Car Wash
           </span>
           <span class="badge rounded-pill bg-light text-dark text-wrap">
            Charging
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
         <div class="d-flex justify-content-evenly mb-2">
         <a href="#" class="btn btn-primary shadow-none">Book Now</a>
         <a href="#" class="btn btn-sm btn-outline-dark pt-2 shadow-none">More details</a>
        </div>
        </div>
     </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More</a>
    </div>
    
   </div>
 </div>
</div>

<!-- ---------------about----------------- -->
<div id="about" class="pt-5">
  <div class="container">
    <div class="row2">
      <h1 class="sub-title mt-5 mb-5">About This Website</h1>
      <p>Welcome to EasyParking - Your Ultimate Vehicle Parking Solution!<br><br>At EasyParking, we understand the frustrations and challenges that come with finding a convenient and secure parking spot for your vehicle. That's why we've designed a cutting-edge parking system that takes the hassle out of parking, giving you peace of mind and a seamless parking experience.<br><br>With EasyParking, you can say goodbye to circling around busy streets or wasting time searching for available parking spaces. Our advanced technology allows you to effortlessly locate and reserve parking spots in real-time, right from the convenience of your phone or computer.</p>
    </div>
  </div>
</div>

<!-- ----------------------------services----------------------- -->
<div id="services" class="pt-5">
  <div class="container">
    <h1 class="sub-title mt-5">Our Services</h1>
    <div class="services-list">
      <div>
        <i class="fa-solid fa-square-parking" style="color: #d24314;"></i>
        <h2>Parking</h2>
        <p>At EasyParking, we offer a comprehensive vehicle parking service that prioritizes convenience, security, and ease of use. Our network of parking locations ensures that you can find a spot near your destination, whether you're heading to a busy city center, an event venue, or an airport</p>
        <a href="#">Learn more</a>
      </div>
      <div>
        <i class="fa-solid fa-charging-station" style="color: #d24314;"></i>
        <h2>EV Charging</h2>
        <p>EasyParking is committed to supporting sustainable transportation options. That's why we provide access to Electric Vehicle (EV) charging stations at select parking locations. With our EV charging services, you can conveniently charge your electric vehicle while it's parked, ensuring you have a fully charged battery when you're ready to hit the road</p>
        <a href="#">Learn more</a>
      </div>
      <div>
        <i class="fa-solid fa-car-side" style="color: #d24314;"></i>
        <h2>Car Washing</h2>
        <p>At EasyParking, we understand the importance of maintaining a clean and presentable vehicle. That's why we offer on-site vehicle washing and detailing services at select parking locations. Whether you're looking for a quick wash or a thorough detailing, our professional car care partners are ready to meet your needs</p>
        <a href="#">Learn more</a>
      </div>
    </div>
  </div>
</div>

<!-- ---------------faq------------------------- -->
<div id="question" class="pt-5">
  <div class="container">
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
              <strong>Making a parking reservation is quick and easy. Simply visit our website, select your desired location, date, and duration, and follow the prompts to complete your reservation. You will receive a confirmation email with all the details.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
                <strong>Yes, you can modify or cancel your parking reservation depending on the terms and conditions of the specific parking location. Log in to your account on our website and navigate to the reservation management section to make any changes or cancellations</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
            <strong>We understand that travel plans can change. In most cases, there is a grace period for early or late arrivals. However, it is always recommended to adhere to your reserved parking time to ensure a smooth experience. Check the specific parking location's terms and conditions for more details</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
            <strong>Yes, we prioritize the safety and security of your vehicle. Our parking facilities are carefully selected and equipped with advanced security measures, including surveillance cameras, well-lit areas, and on-site personnel. However, we recommend not leaving any valuable items in plain sight inside your vehicle</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
            <strong>Some parking facilities may have height or size restrictions. During the reservation process, you will be able to view any limitations or restrictions specific to the chosen parking location. If you have a larger or oversized vehicle, it is recommended to check the available options or contact our customer support for assistance</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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
            <strong>We accept various payment methods, including major credit cards, debit cards, and digital wallets. The accepted payment options will be displayed during the reservation process. Rest assured that your payment information is processed securely</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
          </div>
        </div>
      </div>
    </div>
      
  </div>
</div>

<!-- -------------------contact------------------- -->
<div id="contact" class="pt-5">
  <div class="container">
    <div class="row2">
      <div class="contact-left">
        <h1 class="sub-title mt-5">Contact Us</h1>
        <h2>Address</h2>
        <p>CVJ6+9PC,Kolaghat Thermal Power Plant Township,Kolaghat,West Bengal 721171</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3688.0447607907377!2d87.8592481742656!3d22.427341038280616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02980f71daa971%3A0xd8a291eb93011bcf!2sCollege%20Of%20Engineering%20%26%20Management%2C%20Kolaghat!5e0!3m2!1sen!2sin!4v1702967233669!5m2!1sen!2sin" width="700" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <h2><i class="fa-solid fa-envelope"></i>Email</h2>
        <p>easyparking@gmail.com</p>
        <h2><i class="fa-solid fa-phone"></i>Phone</h2>
        <p>91-33-1234 5678</p>
        <div class="social-icons">
          <a href="https://www.linkedin.com/in/satyapriya-achar-520342196/"><i class="fa-brands fa-linkedin" style="color: blue;"></i></a>
          <a href="https://twitter.com/SatyapriyaAchar"><i class="fa-brands fa-twitter"></i></a>
          <a href="https://youtube.com/@living_ideal?si=HE2vIMn0sFGfagvY"><i class="fa-brands fa-youtube" style="color: #e54b24;"></i></a>
          <a href=""><i class="fa-brands fa-whatsapp" style="color: #16ac34;"></i></a>
        </div>
      </div>
    </div>
  </div>
  <?php require('inc/footer.php');?>
</div>

<!--------------------- responsive nav bar --------------->
<script>
     var sidemenu =document.getElementById("sidemenu");
     function openmenu()
     {
        sidemenu.style.right="0";
     }
     function closemenu()
     {
        sidemenu.style.right="-200px";
     }
</script>

</body>
</html>