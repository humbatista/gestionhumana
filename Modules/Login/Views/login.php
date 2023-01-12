<head>
<link rel="stylesheet" id="theme-style" href="<?php echo base_url('/public/assets/css/login.css');?>">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <h1 class="titulo">Direcci&oacute;n Regional 11 de Educaci&oacute;n, Puerto Plata</h1>
    <h2 class="titulo">Sistema de Gesti&oacute;n Humana</h2>
<div class="col-md-12">
    <div class="login_page">
        <div class="form">
            <form action="<?php echo base_url('/login') ?>" method="POST" class="form-signin">
                <img class="img_form" src="<?php echo base_url('/public/assets/img/logo4.jpg');?>">
                <input type="text" placeholder="Usuario" name="usuario" class="form-control"> 
                <input type="password" placeholder="Password" name="password" class="form-control"> <button>Iniciar Sesi&oacute;n</button>
            </form>
        </div>
    </div>
</div>
</body>
