<?php

//frontend purpose data

define('SITE_URL','http://127.0.0.1/EasyParking/');
// define('ABOUT_IMG_PATH',SITE_URL.'images');
define('SERVICES_IMG_PATH',SITE_URL.'images/services/');
define('PARKING_IMG_PATH',SITE_URL.'images/parking/');


// backend upload process needs this data

define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/EasyParking/images/');
// define('ABOUT_FOLDER','about/');
define('SERVICES_FOLDER','services/');
define('PARKING_FOLDER','parking/');


function adminLogin()
{
    session_start(); //to check validation
    if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
        echo"<script>
          window.location.href='index.php';
        </script>"; 
        exit;
    }
    // session_regenerate_id(true); //new session id created for security
}

  function redirect($url)
  {
    echo"<script>
          window.location.href='$url';
        </script>";
        exit;
  }

 function alert($type,$msg)
  {
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
  }

  function uploadImage($image,$folder)
  {
    $valid_mime = ['image/jpeg','image/png','image/jpg','image/webp'];
    $img_mime = $image['type'];
    $img_s = $image['size'];

    if(!in_array($img_mime,$valid_mime)){
      return 'inv_img'; //invalid image mime or format
    }
    else if(($img_s/(1024*1024))>3){
      return 'inv_size'; //invalid size greater than 1mb
    }
    else{
      $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
      $rname = 'IMG_'.random_int(11111,99999).".$ext";
    

      $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
      if(move_uploaded_file($image['tmp_name'],$img_path))
      {
        return $rname;
      }
      else{
        // return $rname;
        // return $image['tmp_name'];
        
        return 'upd_failed';
      }
    }
  }

  function uploadSVGImage($image,$folder)
  {
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];
    $img_s = $image['size'];

    if(!in_array($img_mime,$valid_mime)){
      return 'inv_img'; //invalid image mime or format
    }
    else if(($img_s/(1024*1024))>3){
      return 'inv_size'; //invalid size greater than 1mb
    }
    else{
      $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
      $rname = 'IMG_'.random_int(11111,99999).".$ext";
  

      $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
      if(move_uploaded_file($image['tmp_name'],$img_path))
      {
        return $rname;
      }
      else{
        // return $rname;
        // return $image['tmp_name'];
        
        return 'upd_failed';
      }
    }
  }

  function deleteImage($image,$folder)
  {
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
      return true;
    }
    else{
      return false;
    }
  }

?>