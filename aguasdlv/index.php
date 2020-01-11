<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <img class="mb-4" src="libs/images/logo.png" alt="" width="300" height="120">
    </div>
    <div class="text-center">
       <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="sr-only">Usuario</label>
              <input type="name" class="form-control" name="username" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label for="Password" class="sr-only">Contraseña</label>
            <input type="password" name= "password" class="form-control" placeholder="Contraseña">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Ingresar</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
