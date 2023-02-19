<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="../css/OfficehourPlus.css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/03a1b60f2c.js" crossorigin="anonymous"></script>
    <style>
    .loginbox{
        position: relative;
        width:800px;
        height:550px;
    
    }
    .logo{
        width: 150px;
        height: 100px;
        position:absolute;
        left:300px;
        top:215px;
        
    }
    span{
        position:absolute;
        left:465px;
        top:240px;
        font-size:40px;
        font-family: 'Lobster', cursive;
    }
    .intro{
        position:absolute;
        font-size:30px;
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        left:300px;
        top:320px;
    }
    .loginbutton{
        position:absolute;
        left:300px;
        top:420px;
        font-size:25px;
        width:130px;
        padding:5px 10px;
        opacity:0.5;
        border-radius: 15px;
        background-color:#f4b42f;
    }
    .loginbutton a{
        color: black;
        font-weight:bold;
        text-decoration: none;
    }
    footer{
        position:absolute;
        left:300px;
        top:560px;  
    }
    
body{
    background: url("../images/bg.png") no-repeat center center fixed;;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover;

}
@media (max-width: 1135px){
    .loginbox{
        
        width:700px;
    } 
    .loginbox span{
        top:245px;
        left:325px;
    }
    .logo{
        top:215px;
        left:180px;
    }
    .intro{
        font-size:26px;
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        left:220px;
        top:325px;
    }
    .loginbutton{
        left:220px;
        top:425px;
    }
    footer{
        left:220px;
        top:565px; 
    }
}
@media (max-width: 900px){
    
    body{
        background-image: url("../images/bg_sm.png");
        background-repeat: no-repeat;
    }

}
@media (max-width: 695px){
    .loginbox{
        
        width:500px;
    }
    .loginbox span{
        top:210px;
        left:225px;
    }
    .logo{
        top:200px;
        left:60px;
    }
    .intro{
        font-size:25px;
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        left:110px;
        top:310px;
    }
    .loginbutton{
        left:110px;
        top:410px;
    }
    footer{
        left:110px;
        top:550px; 
    }
    body{
        background: url("../images/bg_xs.png") no-repeat center center fixed;;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
    }
}
@media (max-width: 414px) {
    
    .loginbox span{
        top:310px;
        left:225px;
        font-size:40px;
    }
    .logo{
        top:300px;
        left:60px;
        transform: scale(0.8);
    }
    .intro{
        font-size:33px;
        font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        left:90px;
        top:410px;
    }
    .loginbutton{
        left:90px;
        top:550px;
    }
    footer{
        left:90px;
        top:670px; 
    }
}
    </style>

    <title>OfficeHourPlus</title>
    

</head>

<body>


    
    <div class="loginbox">
        <img class= "logo" src="../images/logo.png" alt=""> <span> OfficeHourPlus</span>
        <p class="intro">For Luddy school Students, Teaching Assistants, and Instructors</p>
        <p class="loginbutton"><a href="https://idp.login.iu.edu/idp/profile/cas/login?service=https://cgi.luddy.indiana.edu/~team63/IU_Login/user.php">
           Log in  <i class="fas fa-sign-in-alt"></i>
        </p>
        </a>
        <footer>

        <hr size="2" width="100%" color="black">  

        <p>Copyright &copy; 2021 Team63. All Right Reserved</p>

    </footer>
    </div>

</body>

</html>