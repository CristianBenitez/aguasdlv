<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
    echo remove_junk($page_title);
    elseif(!empty($user))
    echo ucfirst($user['name']);
    else echo "Medición Agua - PYC Sistemas";?>
</title>
<script src="libs/js/jquery.js"></script>
<link rel="icon" href="libs/images/favicon.png" type="image/png"/>
<link rel="stylesheet" href="libs/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
<link rel="stylesheet" href="libs/css/main.css" />

<script src="libs/js/popper.js"></script>

<!--APERTURA MODAL PARA MANEJO DE STOCK POR CANTIDAD-->
<script>
$(document).ready(function(){
    $('.openmodalquantity').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL,function(){
            $('#modal-quantity').modal({show:true});
        });
    });
});

function refreshTablaClientes() {
    //Funcion para refrescar la tabla a partir del input de busqueda
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("inputBusqueda");
    filter = input.value.toUpperCase();
    table = document.getElementById("clientes_table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
};
</script>
</head>
<body>
    <?php  if ($session->isUserLoggedIn(true)): ?>
        <header id="header">
            <div class="logo pull-left"> Gestión de Mediciones </div>
            <div class="header-content">
                <div class="header-date pull-left">
                    <strong><?php date_default_timezone_set('America/Argentina/Buenos_Aires');
                    echo date("d/m/Y  H:i");?></strong>
                </div>
                <div class="pull-right clearfix">
                    <!--<a href="logout.php" class="btn-lg btn-danger"  title="Salir" data-toggle="tooltip">
                    <span class="fa fa-sign-out"></span>
                </a> !-->
                <ul class="info-menu list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                            <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image" class="img-circle img-inline">
                            <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="edit_account.php" title="edit account">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Configuración
                                </a>
                            </li>
                            <li class="last">
                                <a href="logout.php">
                                    <i class="glyphicon glyphicon-off"></i>
                                    Salir
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="sidebar">
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
      <?php include_once('special_menu.php');?>

      <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
      <?php include_once('user_menu.php');?>

      <?php endif;?>
      <div class="footer">
           <img  src="libs/images/logo.png" alt="" width="165" height="114">
      </div>

   </div>
   <div class="page">
       <div class="container-fluid">
<?php else: ?>
<div class="page-login">
    <div class="container-fluid">
<?php endif;?>
