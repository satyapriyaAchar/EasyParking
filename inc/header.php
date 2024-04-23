<?php
  require('admin/inc/db_config.php');
  require('admin/inc/essential.php');
?>
<nav class="navi">
        <a href="#"><img src="images/logo.png" class="logo"></a>
        <ul id="sidemenu">
            <li><a href="index.php">Home</a></li>
            <li><a href="parking.php">Parking</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#services">Services</a></li>
            <li><a href="index.php#question">FAQ</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="login.php"><button type="button"  class="btn btn-primary shadow-none">
                  Login
                </button></a>
            </li>
           
            <i class="fa-solid fa-xmark" onclick="closemenu()"></i>
        </ul>
        <i class="fa-solid fa-bars" onclick="openmenu()"></i>
</nav>
