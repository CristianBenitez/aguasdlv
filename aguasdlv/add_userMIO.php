<?php
  $page_title = 'Alta Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_levels = find_all('user_groups');
?>
<?php
 if(isset($_POST['add_user'])){
   $req_fields = array('nombre','username','password',
                      'nivel_usuario'
                       );
   //validate_fields($req_fields);
   if(empty($errors)){
     $p_nombre  = remove_junk($db->escape($_POST['nombre']));
     $p_username  = remove_junk($db->escape($_POST['username']));
     $p_password   = sha1(remove_junk($db->escape($_POST['password'])));
     $p_nivel_usuario   = remove_junk($db->escape($_POST['nivel_usuario']));

     $query  = "INSERT INTO users (";
     $query .=" name,username,password,user_level,status";
     $query .=") VALUES (";
     $query .=" '{$p_nombre}', '{$p_username}', '{$p_password}', '{$p_nivel_usuario}', '1'";
     $query .=")";
     if($db->query($query)){

       $session->msg('s',"Usuario creado exitosamente. ");
       redirect('home.php', false);
     } else {
       $session->msg('d',' El usuario que intenta crear ya existe.' . $query);
       redirect('home.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_user.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="fa fa-th"></span>
            <span>Alta Usuario</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_user.php" class="clearfix">
              <div class="form-group">
              <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Nombre</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Usuario</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Contraseña</strong></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="username" placeholder="Usuario" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                  </div>
                </div>
               </div>

               <div class="form-group">
               <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Nivel de usuario</strong></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-control" name="nivel_usuario" required>
                            <option value="">Seleccione Nivel</option>
                                <?php foreach ($all_levels as $cat): ?>
                            <option value="<?php echo (int)$cat['group_level'] ?>">
                                <?php echo $cat['group_name'] ?></option>
                                <?php endforeach; ?>
                        </select>
                      <!--input type="text" class="form-control" name="nivel_usuario" placeholder="Nivel de usuario"!-->
                    </div>
                  </div>
                </div>
               </div>

               </div>
              </div>



              <div class="col-md-4 offset-4">
              <button type="submit" name="add_user" class="btn btn-primary btn-lg btn-block">Crear Usuario</button>
              </div>
            </form>
            <hr class="mb-4">

          <div class="col-md-4 offset-4">
          <button class="btn btn-primary btn-lg btn-block" onclick="location.href='home.php'" type="">Volver</button>
          </div>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
