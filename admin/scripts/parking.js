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


    let add_image_form = document.getElementById('add_image_form');

    add_image_form.addEventListener('submit',function(e)
    {
    e.preventDefault();
    add_image();
    });

    function add_image()
    {
    let data = new FormData();
    // console.log(services_s_form.elements['services_name'].value);
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('parking_id',add_image_form.elements['parking_id'].value);

    data.append('add_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/parking.php",true);

    xhr.onload = function()
    {
        console.log(this.responseText);
        if(this.responseText == 'inv_img')
        {
        alert('error','Only PNG,JPG,webp images are allowed!','image-alert');
        }
        else if(this.responseText == 'inv_size'){
        alert('error','size should be <1MB allowed!','image-alert');
        }
        else if(this.responseText == 'upd_failed')
        {
        
        alert('error','Image upload failed. server down!','image-alert');
        }
        else
        {
        // console.log(this.responseText);
        alert('success','New image added','image-alert');
        parking_images(add_image_form.elements['parking_id'].value,document.querySelector("#parking-images .modal-title").innerText);
        add_image_form.reset();
        
        }

    }
    xhr.send(data);
    }

    function parking_images(id,pname)
    {
    document.querySelector("#parking-images .modal-title").innerText = pname;
    add_image_form.elements['parking_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/parking.php",true);
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded') ;

        xhr.onload = function(){
            document.getElementById('parking-image-data').innerHTML = this.responseText;
        }
        xhr.send('get_parking_images='+id);

    }

    function rem_image(img_id,parking_id)
    {

    let data = new FormData();
    // console.log(services_s_form.elements['services_name'].value);
    data.append('image_id',img_id);
    data.append('parking_id',parking_id);

    data.append('rem_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/parking.php",true);

    xhr.onload = function()
    {
        
        if(this.responseText == 1)
        {
        alert('success','Image removed Successful','image-alert');
        parking_images(parking_id,document.querySelector("#parking-images .modal-title").innerText);
        }
        else
        {
        // console.log(this.responseText);
        alert('error','Image removal failed','image-alert');
        add_image_form.reset();
        
        }

    }
    xhr.send(data);

    }

    function thumb_image(img_id,parking_id)
    {

    let data = new FormData();
    // console.log(services_s_form.elements['services_name'].value);
    data.append('image_id',img_id);
    data.append('parking_id',parking_id);

    data.append('thumb_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/parking.php",true);

    xhr.onload = function()
    {
        
        if(this.responseText == 1)
        {
        alert('success','Thumbnail Changed','image-alert');
        parking_images(parking_id,document.querySelector("#parking-images .modal-title").innerText);
        }
        else
        {
        // console.log(this.responseText);
        alert('error','Thumbnail failed','image-alert');
        add_image_form.reset();
        
        }

    }
    xhr.send(data);

    }


    function remove_parking(parking_id)
    {

    if(confirm("Are you sure, want to delete this parking"))
    {
        let data = new FormData();
        data.append('parking_id',parking_id);
        data.append('remove_parking','');
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/parking.php",true);

        xhr.onload = function()
        {
        
        if(this.responseText == 1)
        {
            alert('success','Parking removed');
            get_all_parking();           
        }
        else
        {
            alert('error','Parking removed failed!');
        }
        }
        xhr.send(data);
    }
    }

    window.onload = function(){
    get_all_parking();
    }