<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_abc = find_all('abc');
$principal_locations = find_location('1');
$primary_locations = find_location('2');
$secondary_locations = find_location('3');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-barcode','product-title','product-categorie','product-quantity','buying-price', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){

       $p_cat   = (int)$_POST['product-categorie'];
      $p_barcode  = remove_junk($db->escape($_POST['product-barcode']));
      $p_name  = remove_junk($db->escape($_POST['product-title']));
      $p_prov   = remove_junk($db->escape($_POST['provider']));
      $p_box   = remove_junk($db->escape($_POST['box']));
      $p_expdate   = remove_junk($db->escape($_POST['expiration_date']));
      $p_pploc   = (int)$_POST['principal_location'];
      $p_prloc   = (int)$_POST['primary_location'];
      $p_secloc   = (int)$_POST['secondary_location'];
      $p_abc   = (int)$_POST['product_abc'];
      $p_min   = remove_junk($db->escape($_POST['minimum']));
      $p_loss   = remove_junk($db->escape($_POST['annual_loss']));
      $p_amor   = remove_junk($db->escape($_POST['amortization']));
      $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
      $p_buy   = remove_junk($db->escape($_POST['buying-price']));
      $p_sale  = remove_junk($db->escape($_POST['saleing-price']));


       $query   = "UPDATE products SET";
       $query  .=" barcode ='{$p_barcode}', name ='{$p_name}', quantity ='{$p_qty}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',";
       $query  .=" expiration_date ='{$p_expdate}', provider ='{$p_prov}', box ='{$p_box}',";
       $query  .=" abc ='{$p_abc}', location ='{$p_pploc}', minimum ='{$p_min}',";
       $query  .=" amortization ='{$p_amor}', annual_loss ='{$p_loss}', primary_location ='{$p_prloc}',";
       $query  .=" secondary_location ='{$p_secloc}'";
       $query  .=" WHERE id ='{$product['id']}'";
       
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"El producto ha sido actualizado. ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' La actualización falló.');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
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
            <span>Editar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              

           <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Referencia</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Nombre</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Familia</strong></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="product-barcode" placeholder="Referencia" value="<?php echo remove_junk($product['barcode']);?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="product-title" placeholder="Nombre de producto" value="<?php echo remove_junk($product['name']);?>" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="product-categorie" required>
                        <option value="">Selecciona una familia</option>
                      <?php  foreach ($all_categories as $cat): ?>
                        <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>


              <div class="form-group">
              <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Proveedor</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Caja</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Fecha de caducidad</strong></label>
                  </div>
                </div>
                <div class="row">
                
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="provider" placeholder="Proveedor" value="<?php echo remove_junk($product['provider']); ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="box" placeholder="Caja" value="<?php echo remove_junk($product['box']); ?>" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="date" class="form-control" name="expiration_date" placeholder="Fecha caducidad" value="<?php echo remove_junk($product['expiration_date']); ?>"required>
                    </div>
                  </div>
                </div>
               </div>

               <div class="form-group">
               <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Ubicación principal</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Ubicación primaria</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Ubicación secundaria</strong></label>
                  </div>
                </div>
                <div class="row">
                
                <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="principal_location" >
                        <option value="">Ubicacion principal</option>
                      <?php  foreach ($principal_locations as $ppal_loc): ?>
                        <option value="<?php echo (int)$ppal_loc['idlocation'] ?>" <?php if($product['location'] === $ppal_loc['idlocation']): echo "selected"; endif; ?>>
                          <?php echo remove_junk($ppal_loc['namelocation']); ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="primary_location" >
                        <option value="">Ubicación primaria</option>
                      <?php  foreach ($primary_locations as $prim_loc): ?>
                        <option value="<?php echo (int)$prim_loc['idlocation'] ?>" <?php if($product['primary_location'] === $prim_loc['idlocation']): echo "selected"; endif; ?>>
                          <?php echo remove_junk($prim_loc['namelocation']); ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="secondary_location" >
                        <option value="">Ubicacion secundaria</option>
                      <?php  foreach ($secondary_locations as $sec_loc): ?>
                        <option value="<?php echo (int)$sec_loc['idlocation'] ?>" <?php if($product['secondary_location'] === $sec_loc['idlocation']): echo "selected"; endif; ?>>
                          <?php echo remove_junk($sec_loc['namelocation']); ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
               </div>
              
               <div class="form-group">
               <div class="row">
                  <div class="col-sm-3">
                    <label class="control-label col-xs-3"><strong>A/B/C</strong></label>
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label col-xs-3"><strong>Mínimo</strong></label>
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label col-xs-3"><strong>Pérdida anual</strong></label>
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label col-xs-3"><strong>Amortización</strong></label>
                  </div>
                </div>
               <div class="row">
               
                 <div class="col-sm-3">
                   <div class="input-group">
                      <select class="form-control" name="product_abc">
                        <option value="">A/B/C</option>
                      <?php  foreach ($all_abc as $abc): ?>
                        <option value="<?php echo (int)$abc['id_abc'] ?>" <?php if($product['abc'] === $abc['id_abc']): echo "selected"; endif; ?>>
                          <?php echo remove_junk($abc['name']); ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                 </div>
                 <div class="col-sm-3">
                   <div class="input-group">
                     <input type="number" min="0" max="5" class="form-control" name="minimum" placeholder="Mínimo" value="<?php echo remove_junk($product['minimum']); ?>">
                  </div>
                 </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="number" class="form-control" name="annual_loss" placeholder="Pérdida anual" value="<?php echo remove_junk($product['annual_loss']); ?>" >                  
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="number" min="0" max=10 class="form-control" name="amortization" placeholder="Amortización" value="<?php echo remove_junk($product['amortization']); ?>" >
                   </div>
                  </div>
               </div>
              </div>

              <div class="form-group">
              <div class="row">
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Unidades</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Precio de compra</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label col-xs-3"><strong>Precio de venta</strong></label>
                  </div>
                </div>
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <input type="number" min="0" class="form-control" name="product-quantity" placeholder="Unidades" value="<?php echo remove_junk($product['quantity']); ?>" readonly>
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                       <i class="fa fa-euro fa-stack"></i>
                     <input type="number" min="0" class="form-control" name="buying-price" placeholder="Precio de compra" value="<?php echo remove_junk($product['buy_price']);?>" required>
                     <i>.00</i>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                        <i class="fa fa-euro fa-stack"></i>
                      <input type="number" min="0" class="form-control" name="saleing-price" placeholder="Precio de venta" value="<?php echo remove_junk($product['sale_price']);?>" required>
                      <i>.00</i>
                   </div>
                  </div>
                 
               </div>
              </div>

              </div>
              <div class="col-md-4 offset-4">
              <button type="submit" name="product" class="btn btn-primary btn-lg btn-block">Actualizar</button>
              </div>
          </form>
          <hr class="mb-4">

          <div class="col-md-4 offset-4">
             <button class="btn btn-primary btn-lg btn-block" onclick="location.href='product.php'" type="">Volver</button>
          </div>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
