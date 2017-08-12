<html lang="es">
<head>
<title>Inicio de sesión</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
<link rel="stylesheet" href="css/login.css"/>
<script src="js/SendForm.js"></script>
<script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>

</head>
<header>
  <img src="assets/img/logo.png" width="60px" height="60px" class="header">
  <p>SISTEMA DE BECADOS</p>
  <small>BitSource</small>
</header>
<body class="full-cover-background" style="background-image:url(assets/img/material-750x500.jpg);">
    <div class="form-container">
        <p class="text-center" style="margin-top: 17px;">
           <i class="fa fa-user"style="font-size: 50px;" ></i>
       </p>
       <h4 class="text-center all-tittles" style="margin-bottom: 30px;">inicia sesión con tu cuenta</h4>
       <form action="login.php" method="post" class="form_SRCB" data-type-form="login" autocomplete="off">
         <center><img src="assets/img/logo3.png" class="imagencatolica"></center><br>
            <div class="group-material-login">
              <input type="text"  pattern="[0-9]{1,50}" class="material-login-control"  name="loginName" required="" maxlength="13">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-accoun"></i> &nbsp; Nombre</label>
            </div><br></br>
            <div class="group-material-login">
              <input type="password" pattern="[A-Za-z_0-9]{1,50}" class="material-login-control" name="loginPassword" required="" maxlength="70" >
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
            </div>
            <button class="btn-login" type="submit">Ingresar al sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
        </form>
    </div>
     <div class="msjFormSend hidden"></div>
</body>
</html>
