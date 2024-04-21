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

window.onload = function()
{
  get_services();
}

