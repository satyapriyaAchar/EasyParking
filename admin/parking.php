<?php 
  require('inc/essential.php');
  require('inc/db_config.php');
  adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Parking</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid " id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">PARKING</h3>

          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
    

              <div class="text-end mb-4">
                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-parking">
                  <i class="bi bi-pluus-square"></i> Add
                </button>
              </div>

              <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll">
                <table class="table table-hover border text-center">
                  <thead >
                    <tr class="bg-dark text-light">
                      <th scope="col">Sr</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="parking-data">
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        
        </div>
      </div>
    </div>

<!------------- Add parking Modal popup ----------------->
    <div class="modal fade" id="add-parking" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form id="add_parking_form" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add parking</h5>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Name</label>
                  <input type="text" name="name" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Price</label>
                  <input type="number" name="price" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Quantity</label>
                  <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label fw-bold">Services</label>
                  <div class="row">
                    <?php
                      $res = selectAll('services');
                      while($opt = mysqli_fetch_assoc($res)){
                        echo"
                          <div class='col-md-3'>
                            <label>
                              <input type='checkbox' name='services' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                          </div>
                        ";
                      }
                    ?>
                  </div>

                </div>
                <div class="col-12 mb-3">
                  <label class="form-label fw-bold">Description</label>
                  <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset"  class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary shadow-none">SUBMIT</button>
            </div>
          </div>
        </form>
      </div>
    </div>

<!------------- Edit parking Modal popup ----------------->
    <div class="modal fade" id="edit-parking" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form id="edit_parking_form" autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit parking</h5>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Name</label>
                  <input type="text" name="name" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Price</label>
                  <input type="number" name="price" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-bold">Quantity</label>
                  <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label fw-bold">Services</label>
                  <div class="row">
                    <?php
                      $res = selectAll('services');
                      while($opt = mysqli_fetch_assoc($res)){
                        echo"
                          <div class='col-md-3'>
                            <label>
                              <input type='checkbox' name='services' value='$opt[id]' class='form-check-input shadow-none'>
                              $opt[name]
                          </div>
                        ";
                      }
                    ?>
                  </div>

                </div>
                <div class="col-12 mb-3">
                  <label class="form-label fw-bold">Description</label>
                  <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                </div>
                <input type="hidden" name="parking_id">
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset"  class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary shadow-none">SUBMIT</button>
            </div>
          </div>
        </form>
      </div>
    </div>

<!------------- Manage parking images Modal popup ----------------->

    <div class="modal fade" id="parking-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Parking Name</h5>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="image-alert">

            </div>
            <div class="border-bottom border-3 pb-3 mb-3">
              <form id="add_image_form">
                <label class="form-label fw-bold">Add Image</label>
                <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3 " required >
                <button type="submit" class="btn btn-primary shadow-none">ADD</button>
                <input type="hidden" name="parking_id">
              </form>
            </div>
            <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll">
              <table class="table table-hover border text-center">
                <thead >
                  <tr class="bg-dark text-light sticky-top">
                    <th scope="col" width="60%">Image</th>
                    <th scope="col">Thumb</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody id="parking-image-data">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php require('inc/scripts.php'); ?>

    <script src="scripts/parking.js"></script>
</body>
</html>