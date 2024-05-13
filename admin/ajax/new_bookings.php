<?php
    require('../inc/db_config.php');
    require('../inc/essential.php');
    adminLogin();

  
    if(isset($_POST['get_bookings']))
    {
        $frm_data = filteration($_POST);

        $query = "SELECT bo.*,bd.* FROM `booking_order` bo
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
            AND (bo.booking_status = ? AND bo.arrival = ?) ORDER BY bo.booking_id ASC";

        $res = select($query,
            ["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","booked",0],'sssss');
        $i = 1;
        $table_data = "";

        if(mysqli_num_rows($res)==0){
            echo"<b>No Data Found!</b>";
            exit;
        }

        while($data = mysqli_fetch_assoc($res))
        {
            $data = date("d-m-Y",strtotime($data['datentime']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));


            $table_data .="
                <tr>
                    <td>
                        <span class='badge bg-primary'>
                            Order Id: $data[order_id]
                        </span>
                        <br>
                        <b>Name :</b> $data[user_name]
                        <br>
                        <b>Phone :</b> $data[phonenum]
                    </td>
                    <td>
                        <b>Parking :</b> $data[parking_name]
                        <br>
                        <b>Price :</b> ₹$data[price]
                    </td>
                    <td>
                        <b>Check-in:</b> $checkin
                        <br>
                        <b>Check-out:</b> $checkout
                        <br>
                        <b>Paid :</b> ₹$data[trans_amt]
                        <br>
                        <b>Date:</b> $date
                    </td>
                    <td>
                        <button type='button' onclick='assign_parking($data[booking_id])' class='btn text-white btn-sm fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assign-parking'>
                            <i class='bi bi-check2-square'></i> Assign parking
                        </button>
                        <br>
                        <button type='button' onclick='cancel_booking($data[booking_id])' class='mt-2 btn btn-outline-danger btn-sm fw-bold shadow-none'>
                            <i class='bi bi-trash'></i> Cancel Booking
                        </button>
                    </td>
                </tr>
            ";
            $i++;
        }
        echo $table_data;
    }

    if(isset($_POST['assign_parking']))
    {
        $frm_data = filteration($_POST);

        $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd
            ON bo.booking_id = bd.booking_id
            SET bo.arrival = ?, bd.parking_no= ?
            WHERE bo.booking_id = ?";
    
        $value = [1,$frm_data['parking_no'],$frm_data['booking_id']];
        $res = update($query,$value,'isi'); // it will update 2 rows so it will return 2

        echo ($res==2) ? 1 : 0 ;

    }

    if(isset($_POST['cancel_booking']))
    {
        $frm_data = filteration($_POST);

        $query = "UPDATE `booking_order` SET `booking_status`=?, `refund`=? WHERE booking_id = ?";
        $value = ['cancelled',0,$frm_data['booking_id']];
        $res = update($query,$value,'sii');

        echo $res;
       
    }


?>