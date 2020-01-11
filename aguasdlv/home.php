<?php
$page_title = 'Inicio';
require_once('includes/load.php');
if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<div class="container">
    <div class="py-5 text-center">
        <img  src="libs/images/sierra.jpg" alt="" width="550" height="350">
        <hr class="mb-4">
        <h2>Bienvenido</h2>
        <div class="col-md-12">
            <?php echo display_msg($msg); ?>
        </div>
        <p class="lead">Sistema para la gestión de Mediciones de Agua Corriente.</p>

    </div>
    <!-- aca le saque los iconos !-->

    <?php include_once('layouts/footer.php'); ?>
</div>
