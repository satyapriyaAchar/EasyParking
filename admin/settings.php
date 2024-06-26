<?php 
  require('inc/essential.php');
  adminLogin();
  session_regenerate_id(true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require('inc/links.php'); ?>
    
    
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid " id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">SETTING</h3>

          <!---------- General Settings ------------->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex align-item-center justify-content-between mb-3">
                <h5 class="card-title m-0">General Settings</h5>
                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                <i class="bi bi-pencil-square"></i>
                Edit
                </button>
              </div>
              <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
              <p class="card-text" id="site_title"></p>
              <h6 class="card-subtitle mb-1 fw-bold" >About Us</h6>
              <p class="card-text" id="site_about"></p>
            </div>
          </div>
          <!------- popup for edit dynamically(modal)for title and about ------->
          <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <form id="general_s_form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">General Settings</h5>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label fw-bold">Site Title</label>
                      <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-bold">About Us</label>
                      <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value =general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-none">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!----------- shutdown website ---------->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex align-item-center justify-content-between mb-3">
                <h5 class="card-title m-0">Shutdown Website</h5>
                <div class="form-check form-switch">
                  <form>
                  <input onchange="upd_shutdown(this.value)" class="form-check-input shadow-none" type="checkbox" id="shutdown_toggle">
                  </form>
                </div>
              </div>
              <p class="card-text" >
                No customers will allowed to book parking place, when shutdown mode is turned on.
              </p>
            </div>
          </div>

          <!----------- contacts settings ---------->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex align-item-center justify-content-between mb-3">
                <h5 class="card-title m-0">Contacts Settings</h5>
                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                <i class="bi bi-pencil-square"></i>
                Edit
                </button>
              </div>
              <div class="row">
                <!-- address,phn no, google map,email -->
                <div class="col-lg-6">
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                    <p class="card-text"></p>
                    <i class="fa-solid fa-address-card" style="color: green;"></i>
                    <span id="address"></span>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold" >Google Map</h6>
                    <p class="card-text"></p>
                    <i class="fa-solid fa-map-location-dot" style="color: blue"></i>
                    <span id="gmap"></span>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold" >Phone Number</h6>
                    <p class="card-text">
                    <i class="fa-solid fa-phone" style="color: green;" aria-hidden="true"></i>
                    <span id="pn1"></span>
                    </p>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold" >Email</h6>
                    <p class="card-text">
                    <i class="fa-solid fa-envelope" style="color: orange;" aria-hidden="true"></i>
                    <span id="email"></span>
                    </p>
                  </div>
                </div>

                <!-- socials links -->
                <div class="col-lg-6">
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold" >Social Links</h6>
                    <p class="card-text mb-1" >
                      <i class="fa-brands fa-linkedin" style="color: blue;" aria-hidden="true"></i>
                      <span id="linkd"></span>
                    </p>
                    <p class="card-text mb-1">
                      <i class="fa-brands fa-twitter" aria-hidden="true"></i>
                      <span id="tw"></span>
                    </p>
                    <p class="card-text mb-1">
                      <i class="fa-brands fa-youtube" style="color: red;" aria-hidden="true"></i>
                      <span id="yt"></span>
                    </p>
                    <p class="card-text mb-1">
                      <i class="fa-brands fa-whatsapp" style="color: green;" aria-hidden="true"></i> 
                      <span id="wp"></span>
                    </p>
                  </div>
                  <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold" >Links</h6>
                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!------- popup for edit dynamically(modal) for contact ------->
          <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <form id="contacts_s_form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Contacts Settings</h5>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid p-0">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label fw-bold">Address</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text">
                                  <i class="fa-solid fa-address-card" style="color: green;"></i>
                                </span>
                                <input type="text" name="address" id="address_inp" class="form-control shadow-none" required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-bold">Google Map Link</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text">
                                  <i class="fa-solid fa-map-location-dot" style="color: blue"></i>
                                </span>
                                <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-bold">Phone Number</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text">
                                  <i class="fa-solid fa-phone" style="color: green;" aria-hidden="true"></i>
                                </span>
                                <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-bold">Email</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text">
                                  <i class="fa-solid fa-envelope" style="color: orange;" aria-hidden="true"></i>
                                </span>
                                <input type="email" name="email" id="email_inp" class="form-control shadow-none" required>
                              </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label fw-bold">Social Links</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="fa-brands fa-linkedin" style="color: blue;" aria-hidden="true"></i>
                              </span>
                              <input type="text" name="linkd" id="linkd_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="fa-brands fa-twitter" aria-hidden="true"></i>
                              </span>
                              <input type="text" name="tw" id="tw_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="fa-brands fa-youtube" style="color: red;" aria-hidden="true"></i>
                              </span>
                              <input type="text" name="yt" id="yt_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="fa-brands fa-whatsapp" style="color: green;" aria-hidden="true"></i> 
                              </span>
                              <input type="text" name="wp" id="wp_inp" class="form-control shadow-none" required>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label fw-bold">iFrame src</label>
                            <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-none">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/settings.js"></script>

</body>
</html>