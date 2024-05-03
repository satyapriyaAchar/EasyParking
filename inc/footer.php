<div class="copyright text-white bg-dark mt-5 pb-1 text-center">
    <p class="pt-4" >copyright <i class="fa-regular fa-copyright"></i> 
    <span id="demo"></span>
        <script>
            const d = new Date();
            let year = d.getFullYear();
            document.getElementById("demo").innerHTML = year;
        </script>EasyParking Limited | All rights reserved
    </p>
</div>  

<script>
    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit',(e)=>{
        e.preventDefault();

        let data = new FormData();

        data.append('name',register_form.elements['name'].value);
        data.append('email',register_form.elements['email'].value);
        data.append('phonenum',register_form.elements['phonenum'].value);
        data.append('address',register_form.elements['address'].value);
        data.append('pass',register_form.elements['pass'].value);
        data.append('cpass',register_form.elements['cpass'].value);
        data.append('profile',register_form.elements['profile'].files[0]);
        data.append('register','');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/login_register.php",true);

        xhr.onload = function(){
        }
        xhr.send(data);


    });
</script>