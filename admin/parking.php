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

    <?php require('inc/scripts.php'); ?>

    <script>

      let add_parking_form = document.getElementById('add_parking_form');

      add_parking_form.addEventListener('submit',function(e){
        e.preventDefault();
        add_parking();
      });

      function add_parking()
      {
          let data = new FormData();
          // console.log(services_s_form.elements['services_name'].value);
          data.append('add_parking','');
          data.append('name',add_parking_form.elements['name'].value);
          data.append('price',add_parking_form.elements['price'].value);
          data.append('quantity',add_parking_form.elements['quantity'].value);
          data.append('desc',add_parking_form.elements['desc'].value);

          let services = [];
          add_parking_form.elements['services'].forEach(el =>{
            if(el.checked){
              services.push(el.value);
            }
          });
          
          data.append('services',JSON.stringify(services));
          // console.log(data);

          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/parking.php",true);

          xhr.onload = function(){
          // console.log(this.responseText);

            var myModal = document.getElementById('add-parking');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1)
            {
              alert('success','New parking added');
            // console.log(this.responseText);
              add_parking_form.reset();
              get_all_parking();
            }
            else{
              alert('error','Server Down!');
            }

          }
          xhr.send(data);
      }

      function get_all_parking()
      {
        let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/parking.php",true);
          xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

          xhr.onload = function(){
            document.getElementById('parking-data').innerHTML = this.responseText;
          }
          xhr.send('get_all_parking');
      }
      
      let edit_parking_form = document.getElementById('edit_parking_form');

      function edit_details(id)
      {
        let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/parking.php",true);
          xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

          xhr.onload = function(){
              // console.log(JSON.parse(this.responseText));
              let data = JSON.parse(this.responseText);
              // console.log(data.parkingdata.name);

              edit_parking_form.elements['name'].value = data.parkingdata.name;
              edit_parking_form.elements['price'].value = data.parkingdata.price;
              edit_parking_form.elements['quantity'].value = data.parkingdata.quantity;
              edit_parking_form.elements['desc'].value = data.parkingdata.description;
              edit_parking_form.elements['parking_id'].value = data.parkingdata.id;

              edit_parking_form.elements['services'].forEach(el =>{
                if(data.services.includes(Number(el.value))){
                  el.checked = true;
                }
              });

          }
          xhr.send('get_parking='+id);
      }

      edit_parking_form.addEventListener('submit',function(e){
        e.preventDefault();
        submit_edit_parking();
      });

      function submit_edit_parking()
      {
        let data = new FormData();
          // console.log(services_s_form.elements['services_name'].value);
          data.append('edit_parking','');
          data.append('parking_id',edit_parking_form.elements['parking_id'].value);
          data.append('name',edit_parking_form.elements['name'].value);
          data.append('price',edit_parking_form.elements['price'].value);
          data.append('quantity',edit_parking_form.elements['quantity'].value);
          data.append('desc',edit_parking_form.elements['desc'].value);

          let services = [];
          edit_parking_form.elements['services'].forEach(el =>{
            if(el.checked){
              services.push(el.value);
            }
          });
          
          data.append('services',JSON.stringify(services));
          // console.log(data);

          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/parking.php",true);

          xhr.onload = function(){
          // console.log(this.responseText);

            var myModal = document.getElementById('edit-parking');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1)
            {
              alert('success','Parking data edited');
            // console.log(this.responseText);
              edit_parking_form.reset();
              get_all_parking();
            }
            else{
              alert('error','Server Down!');
            }

          }
          xhr.send(data);
      }

      function toggle_status(id,val)
      {
        let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/parking.php",true);
          xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

          xhr.onload = function(){
              if(this.responseText == 1)
              {
                alert('success','status toggle');
                get_all_parking();
              }
              else{
                alert('error','server down!');
              }
          }
          xhr.send('toggle_status='+id+'&value='+val);
      }

      window.onload = function(){
        get_all_parking();
      }
    </script>
</body>
</html>