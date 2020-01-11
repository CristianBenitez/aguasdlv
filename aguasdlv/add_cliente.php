<?php
  $page_title = 'Agregar Cliente';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);

  $all_rutas = find_all('rutas');
  $all_sectores = find_all('sectores');

?>
<?php
 if(isset($_POST['add_cliente'])){
   $req_fields = array( 'codigo','nombre','medidor','calle','altura','partida','ruta',
                        'orden','sector','est_ini','est_ant','est_actu','fec_lect_ant',
                        'fec_lect_actu','cant_dig_med',
                       );
   //validate_fields($req_fields);
   if(empty($errors)){
     $p_codigo       = remove_junk($db->escape($_POST['codigo']));
     $p_nombre        = remove_junk($db->escape($_POST['nombre']));
     $p_medidor       = remove_junk($db->escape($_POST['medidor']));
     $p_calle         = remove_junk($db->escape($_POST['calle']));
     $p_altura        = remove_junk($db->escape($_POST['altura']));
     $p_partida       = remove_junk($db->escape($_POST['partida']));
     $p_ruta          = remove_junk($db->escape($_POST['ruta']));
     $p_orden         = remove_junk($db->escape($_POST['orden']));
     $p_sector        = remove_junk($db->escape($_POST['sector']));
     $p_est_ini       = remove_junk($db->escape($_POST['est_ini']));
     $p_est_ant       = remove_junk($db->escape($_POST['est_ant']));
     $p_est_actu      = remove_junk($db->escape($_POST['est_actu']));
     $p_fec_lect_ant  = remove_junk($db->escape($_POST['fec_lect_ant']));
     $p_fec_lect_actu = remove_junk($db->escape($_POST['fec_lect_actu']));
     $p_cant_dig_med  = remove_junk($db->escape($_POST['cant_dig_med']));
     $date    = make_date();
     $query  = "INSERT INTO clientes (";
     $query .=" codigo,nombre,medidor,calle,numero,partida,ruta,orden,id_sector,est_ini,estadoAnterior,";
     $query .=" estadoActual,fecha_lect_ante,fecha_lect_act,fecha_Creacion,activo,cant_dig_med,";
     $query .=") VALUES (";
     $query .=" '{$p_codigo}', '{$p_nombre}', '{$p_medidor}', '{$p_calle}', '{$p_altura}', '{$p_partida}', '{$p_ruta}',";
     $query .=" '{$p_orden}', '{$p_sector}', '{$p_est_ini}', '{$p_est_ant}', '{$p_est_actu}',";
     $query .=" '{$p_fec_lect_ant}', '{$p_fec_lect_actu}', '{$date}', 1,  '{$p_cant_dig_med}'";
     $query .=")";
     if($db->query($query)){

       $session->msg('s',"Cliente agregado exitosamente. ");
       redirect('cliente.php', false);
     } else {
       $session->msg('d',' El cliente que intenta agregar ya existe.');
       redirect('cliente.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_clente.php',false);
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
            <span>Agregar Cliente</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_cliente.php" class="clearfix">
              <div class="form-group">
              <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Código</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Nombre</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Medidor</strong></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="number" class="form-control" name="codigo" placeholder="Código" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="medidor" placeholder="Número de Medidor" required>
                    </div>
                  </div>
                </div>
               </div>

               <div class="form-group">
               <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Calle</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Número</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Partida</strong></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="calle" placeholder="Calle">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="altura" placeholder="Número" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="partida" placeholder="Partida" required>
                    </div>
                  </div>
                </div>
               </div>

               <div class="form-group">
               <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Ruta</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Orden</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Sector</strong></label>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="ruta" >
                        <option value="">Ruta</option>
                      <?php  foreach ($all_rutas as $cbo_rutas): ?>
                        <option value="<?php echo (int)$cbo_rutas['id_ruta'] ?>">
                          <?php echo $cbo_rutas['descripcion'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                    <input type="text" class="form-control" name="orden" placeholder="Nro. de Orden" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="sector" >
                        <option value="">Sector</option>
                      <?php  foreach ($all_sectores as $cbo_sector): ?>
                        <option value="<?php echo (int)$cbo_sector['id_sector'] ?>">
                          <?php echo $cbo_sector['descripcion'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
               </div>

               <div class="form-group">
               <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xl-3"><strong>Estado Inicial</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xl-3"><strong>Estado Anterior</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xl-3"><strong>Estado Actual</strong></label>
                  </div>
                </div>                  
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <input type="text" class="form-control" name="est_ini" placeholder="Est. Inicial">
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" min="1" max="6" class="form-control" name="est_ant" placeholder="Est. Anterior" >                   </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" min="1" max="6" class="form-control" name="est_actu" placeholder="Est. Actual" >
                   </div>
                  </div>
               </div>
              </div>

              <div class="form-group">
              <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xl-3"><strong>Fecha Lectura Anterior</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xl-3"><strong>Fecha Lectura Actual</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xl-3"><strong>Cant. Dígitos Medidor</strong></label>
                  </div>
                </div>
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <input type="date" class="form-control" name="fec_lect_ant" placeholder="" >
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <input type="date" class="form-control" name="fec_lect_actu">
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="number" class="form-control" name="cant_dig_med" placeholder="Cant. dígitos medidor">
                   </div>
                  </div>

               </div>
              </div>
              <div class="col-md-4 offset-4">
              <button type="submit" name="add_cliente" class="btn btn-primary btn-lg btn-block">Agregar Cliente</button>
              </div>
              <div class="col-md-4 offset-4">
          <button class="btn btn-primary btn-lg btn-block" onclick="location.href='cliente.php'" type="">Volver</button>
          </div>
            </form>
            <hr class="mb-4">


         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
