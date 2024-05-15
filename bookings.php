<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php');?>
    <title><?php echo $settings_r['site_title']?> -Bookings</title>

</head>

<body class="bg-light">

<?php 
    require('inc/header.php');

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
    {
        redirect('index.php');
    }

?>

<!---------------- parking --------------->
<div class="container">
    <div class="row">

        <!----------------- title ---------------->
        <div class="col-12 my-5 px-4">
            <h2 class="fw-bold">Bookings</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="parking.php" class="text-secondary text-decoration-none">Bookings</a>
            </div>
        </div>

    
        <?php

            $query = "SELECT bo.*,bd.* FROM `booking_order` bo
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE ((bo.booking_status = 'booked') 
            OR (bo.booking_status = 'cancelled')
            OR (bo.booking_status = 'payment failed'))
            AND (bo.user_id = ?)
            ORDER BY bo.booking_id DESC";


            $result = select($query,[$_SESSION['uId']],'i');

            while($data = mysqli_fetch_assoc($result))
            {
                $date = date("d-m-Y",strtotime($data['datentime']));
                $checkin = date("d-m-Y",strtotime($data['check_in']));
                $checkout = date("d-m-Y",strtotime($data['check_out']));

                $status_bg = "";
                $btn = "";

                if($data['booking_status']=='booked')
                {
                    $status_bg = "bg-success";

                    if($data['arrival']==1)
                    {
                        $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none'>Download pdf</a>
                        <button type='button'  class=' btn btn-dark btn-sm  shadow-none'>Rate & Review</button>
                        ";

                    }
                    else
                    {

                        $btn="<button onclick='cancel_booking($data[booking_id])' type='button'  class=' btn btn-danger btn-sm  shadow-none'>Cancel</button>";

                    }
                }
                else if($data['booking_status']=='cancelled')
                {
                    $status_bg = "bg-danger";

                    if($data['refund']==0)
                    {
                        $btn="<span class='badge bg-primary'>Refund in process!</span>";
                    }
                    else
                    {
                        $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none'>Download pdf</a>";
                    }
                }
                else
                {
                    $status_bg = "bg-warning";
                    $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm  shadow-none'>Download pdf</a>";
                }

                echo<<<bookings
                    <div class='col-md-4 px-4 mb-4'>
                        <div class='bg-white p-3 rounded shadow-sm'>
                            <h5 class='fw-bold'>$data[parking_name]</h5>
                            <p>₹$data[price] per day</p>
                            <p>
                                <b>Check in: </b> $checkin <br>
                                <b>Check out: </b> $checkout
                            </p>
                            <p>
                                <b>Amount: </b> ₹$data[price] <br>
                                <b>Order ID: </b> $data[order_id] <br>
                                <b>Date: </b> $date
                            </p>
                            <p>
                                <span class='badge $status_bg'>$data[booking_status]</span>
                            </p>
                            $btn
                        </div>
                    </div>
                bookings;

            }

        ?>
    </div>
</div>

<?php
    if(isset($_GET['cancel_status'])){
        alert('success','Booking Cancelled!');
    }

?>


<!--------------- footer ----------------->
    <?php require('inc/footer.php');?>
    
    <script>
        function cancel_booking(id)
        {
            if(confirm('Are you sure to cancel booking?'))
            {               
                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/cancel_booking.php",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;
                
                xhr.onload = function(){

                    if(this.responseText==1)
                    {
                        window.location.href="bookings.php?cancel_status=true";
                    }
                    else
                    {
                        alert('error','Cancellation Failed!');

                    }
                
                }
                xhr.send('cancel_booking&id='+id);
            }
        }
    </script>

</body>
</html>