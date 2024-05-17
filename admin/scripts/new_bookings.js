
    function get_bookings(search='')
    {
        let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/new_bookings.php",true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

            xhr.onload = function(){
            document.getElementById('table-data').innerHTML = this.responseText;
            }
            xhr.send('get_bookings&search='+search);
    }

    let assign_parking_form = document.getElementById('assign_parking_form');

    function assign_parking(id)
    {
        assign_parking_form.elements['booking_id'].value=id;    
    }
    assign_parking_form.addEventListener('submit',function(e){
        e.preventDefault();

        let data = new FormData();
        // console.log(services_s_form.elements['services_name'].value);
        data.append('parking_no',assign_parking_form.elements['parking_no'].value);
        data.append('booking_id',assign_parking_form.elements['booking_id'].value);    
        data.append('assign_parking','');
    
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/new_bookings.php",true);
    
        xhr.onload = function(){
        // console.log(this.responseText);
    
            var myModal = document.getElementById('assign-parking');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1)
            {
                alert('success','Parking number alloted! Booking finalized');
                assign_parking_form.reset();
                get_bookings();
            }
            else{
                alert('error','server down')
            }
        }
        xhr.send(data);
    });


    function cancel_booking(id)
    {
        if(confirm("Are you sure, you want to cancel this booking?"))
        {
            let data = new FormData();
            data.append('booking_id',id);
            data.append('cancel_booking','');

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/new_bookings.php",true);

            xhr.onload = function()
            {
                if(this.responseText == 1)
                {
                    alert('success','Booking Cancelled!');
                    get_bookings();           
                }
                else
                {
                    alert('error','Sever Down!');
                }
            }
            xhr.send(data);
        }
    }


    window.onload = function(){
        get_bookings();
    }