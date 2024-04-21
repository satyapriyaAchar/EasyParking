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
    <title>Admin Panel - Services</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid " id="main-content">
      <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
          <h3 class="mb-4">SERVICES</h3>

          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
    

              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0">Services</h5>
                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#services-s">
                  <i class="bi bi-pluus-square"></i> Add
                </button>
              </div>

              <div class="table-responsive-md" style="height: 350px; overflow-y: scroll">
                <table class="table table-hover border">
                  <thead >
                    <tr class="bg-dark text-light">
                      <th scope="col">Sr</th>
                      <th scope="col">Icon</th>
                      <th scope="col">Name</th>
                      <th scope="col" width="40%">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="services-data">
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        
        </div>
      </div>
    </div>

<!------------- Our services Modal popup ----------------->
    <div class="modal fade" id="services-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="services_s_form">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Services Settings</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text" name="services_name" class="form-control shadow-none" required>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Icon</label>
                <input type="file" name="services_icon" accept=".svg" class="form-control shadow-none" >
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="services_desc"  class="form-control shadow-none" rows="3" required></textarea>
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

    <?php require('inc/scripts.php'); ?>

    <script>

      let services_s_form = document.getElementById('services_s_form');
      
      services_s_form.addEventListener('submit',function(e){
        // console.log(services_s_form);
        e.preventDefault();
        add_services();
      });

      function add_services()
      {
        let data = new FormData();
        // console.log(services_s_form.elements['services_name'].value);
        data.append('name',services_s_form.elements['services_name'].value);
        data.append('icon',services_s_form.elements['services_icon'].files[0]);
        data.append('desc',services_s_form.elements['services_desc'].value);
        
        data.append('add_services','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/services.php",true);
        
        xhr.onload = function(){
          // console.log(this.responseText);
          
          var myModal = document.getElementById('services-s');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          if(this.responseText == 'inv_img')
          {
            alert('error','Only SVG images are allowed!');
          }
          else if(this.responseText == 'inv_size'){
            alert('error','size should be <1MB allowed!');
          }
          else if(this.responseText == 'upd_failed')
          {
            alert('error','Image upload failed. server down!');
          }
          else
          {
            alert('success','New Service added');
            // console.log("no changes made");
            services_s_form.reset();
            // console.log(this.responseText);
            get_services();
          }
          
        }
        xhr.send(data);
      }
      
      function get_services()
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/services.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
        
        xhr.onload = function(){
          document.getElementById('services-data').innerHTML = this.responseText;
        }
        xhr.send('get_services');
      }

      function rem_services(val)
      {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/services.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

        xhr.onload = function(){
          if(this.responseText == 1)
          {
            alert('success','services removed!');
            get_services();
          }
          else if(this.responseText == 'parking_added'){
            alert('error','services is added in parking');
          }
          else{
            alert('error','server down!');
          }
        }
        xhr.send('rem_services='+val);
      }

      window.onload = function(){
        get_services();
      }
      
    </script>
</body>
</html>