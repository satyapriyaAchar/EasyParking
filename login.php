<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">    
    <script src="https://kit.fontawesome.com/2285a15cc8.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navi">
        <a href="index.php"><img src="images/logo.png" class="logo"></a>
        <ul id="sidemenu">
            <i class="fa-solid fa-house" style="color: azure;"></i>
            <li><a href="index.php">Home</a></li>
            <i class="fa-solid fa-xmark" onclick="closemenu()"></i>
        </ul>
        <i class="fa-solid fa-bars" onclick="openmenu()"></i>
        
    </nav>

     <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn"onclick="register()">Sign Up</button>
            </div>
            <!------ login --------->
            <form class="input-group" id="login">
                <input type="text" class="input-field" placeholder="user Id"required>
                <input type="text" class="input-field" placeholder="Password"required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Log in</button>
                <p>---------------------or---------------------</p>
                <button type="submit" class="submit-btn">Continue with google</button>
            </form>
            <!------ register --------->
            <form class="input-group" id="register">
                <input type="text" class="input-field" placeholder="user Id"required>
                <input type="text" class="input-field" placeholder="Name"required>
                <input type="text" class="input-field" placeholder="Email"required>
                <input type="text" class="input-field" placeholder="Phone"required>
                <input type="text" class="input-field" placeholder="Password"required>
                <input type="text" class="input-field" placeholder="Confirm Password"required>
                <input type="checkbox" class="check-box"><span id="term"><a href="">terms & conditions</a></span>
                <button type="submit" class="submit-btn">Register</button>
            </form>
        </div>
       
     </div>
     
     <script>
        var x=document.getElementById("login");
        var y=document.getElementById("register");
        var x=document.getElementById("login");
        var z=document.getElementById("btn");
        function register(){
            x.style.left="-400px";
            y.style.left="50px";
            z.style.left="110px";
        }
        function login(){
            x.style.left="50px";
            y.style.left="450px";
            z.style.left="0px";
        }

        
     </script>
    
</body>
</html>