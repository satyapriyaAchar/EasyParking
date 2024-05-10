<?php

    require('admin/inc/db_config.php');
    require('admin/inc/essential.php');

    require('inc/paytm/config_paytm.php');
    require('inc/paytm/encdec_paytm.php');

    date_default_timezone_set("Asia/Kolkata");

    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true))
    {
        redirect('index.php');
    }

    if(isset($_POST['pay_now']))
    {
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");

        $checkSum = "";

        $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);
        $CUST_ID = $_SESSION['uId'];
        $INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
        $CHANNEL_ID = CHANNEL_ID;
        $TXN_AMOUNT = $_SESSION['parking']['payment'];


        // Create an array having all required parameters for creating checksum.
        $paramList = array();
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $ORDER_ID;
        $paramList["CUST_ID"] = $CUST_ID;
        $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
        $paramList["CHANNEL_ID"] = $CHANNEL_ID;
        $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
        $paramList["CALLBACK_URL"] = CALLBACK_URL;

        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

        //Insert payment Data into database

        $frm_data = filteration($_POST);

        $query1 = "INSERT INTO `booking_order`(`user_id`, `parking_id`, `check_in`, `check_out`, `order_id`) 1VALUES (?,?,?,?,?)";

        insert($query1,[$CUST_ID],$_SESSION['parking']['id'],$frm_data['checkin'],
            $frm_data['checkout'],$ORDER_ID,'issss');


        $booking_id = mysqli_insert_id($con);

        $query2 = "INSERT INTO `booking_details`(`booking_id`, `parking_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) 
            VALUES (?,?,?,?,?,?,?)";

        insert($query2,[$booking_id,$_SESSION['parking']['name'],$_SESSION['parking']['price'],
            $TXN_AMOUNT,$frm_data['name'],$frm_data['phonenum'],$frm_data['address']],'issssss');

    }
?>

<html>
    <head>
        <title>Processing</title>
    </head>

    <body>
        <h1>Please do not refresh this page...</h1>
        <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
            <?php
            foreach($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
            }
            ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </form>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </body>
</html>