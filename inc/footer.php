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

    function alert(type,msg,position='body')
    {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML =`
            <div class="alert ${bs_class}  alert-dismissible fade show " role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        if(position == 'body')
        {
            document.body.append(element);
            element.classList.add('custom-alert');
        }
        else{
            document.getElementById(position).appendChild(element);
        }
        
        setTimeout(remAlert,3000);
    }

    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }

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
            if(this.responseText == 'pass_mismatch'){
                alert('error',"Password Mismatch");
            }
            else if(this.responseText == 'email_already'){
                alert('error',"Email is already registered");
            }
            else if(this.responseText == 'phone_already'){
                alert('error',"Phone number is already registered");
            }
            else if(this.responseText == 'inv_img'){
                alert('error',"only jpg,jpeg,png & webp are allowed");
            }
            else if(this.responseText == 'upd_failed'){
                alert('error',"Image upload failed");
            }
            else if(this.responseText == 'mail_failed'){
                alert('error',"cannot send confirmation mail! server down");
            }
            else if(this.responseText == 'ins_failed'){
                alert('error',"registration failed! server down");
            }
            else{
               
                alert('success',"Registration successful.. confirmation sent to email");
                register_form.reset();
            }
        }
        xhr.send(data);


    });

    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit',(e)=>{
        e.preventDefault();

        let data = new FormData();

        data.append('email_mob',login_form.elements['email_mob'].value);
        data.append('pass',login_form.elements['pass'].value);

        data.append('login','');

        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/login_register.php",true);

        xhr.onload = function(){

            if(this.responseText == 'inv_email_mob'){
                alert('error',"Invalid Email or Mobile Number!");
            }
            else if(this.responseText == 'not_verified'){
                alert('error',"Email is not verified");
            }
            else if(this.responseText == 'inactive'){
                alert('error',"Account Suspended! please contact Admin ");
            }
            else if(this.responseText == 'invalid_pass'){
                alert('error',"Invalid Password!");
            }
            else{ 
                window.location = window.location.pathname;
            }
        }
        xhr.send(data);
    });    

</script>