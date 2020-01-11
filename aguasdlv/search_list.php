<?php
  $page_title = 'Búsqueda de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_abc = find_all('abc');
  $principal_locations = find_location('1');
  $primary_locations = find_location('2');
  $secondary_locations = find_location('3');
  $all_photo = find_all('media');
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
            <span>Búsqueda de productos</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="result_search.php" class="clearfix">
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
                      <input type="text" class="form-control" name="product-barcode" placeholder="Referencia" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="product-title" placeholder="Nombre de producto" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="product-categorie" >
                        <option value="">Selecciona una familia</option>
                      <?php  foreach ($all_categories as $cat): ?>
                        <option value="<?php echo (int)$cat['id'] ?>">
                          <?php echo $cat['name'] ?></option>
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
                    <label class="control-label col-xs-3"><strong>Fecha de caducidad (Hasta)</strong></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="provider" placeholder="Proveedor">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" class="form-control" name="box" placeholder="Caja" >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="date" class="form-control" name="expiration_date" placeholder="Fecha caducidad" >
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
                        <option value="<?php echo (int)$ppal_loc['idlocation'] ?>">
                          <?php echo $ppal_loc['namelocation'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="primary_location" >
                        <option value="">Ubicación primaria</option>
                      <?php  foreach ($primary_locations as $prim_loc): ?>
                        <option value="<?php echo (int)$prim_loc['idlocation'] ?>">
                          <?php echo $prim_loc['namelocation'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <select class="form-control" name="secondary_location" >
                        <option value="">Ubicacion secundaria</option>
                      <?php  foreach ($secondary_locations as $sec_loc): ?>
                        <option value="<?php echo (int)$sec_loc['idlocation'] ?>">
                          <?php echo $sec_loc['namelocation'] ?></option>
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
                        <option value="<?php echo (int)$abc['id_abc'] ?>">
                          <?php echo $abc['name'] ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                 </div>
                 <div class="col-sm-3">
                   <div class="input-group">
                     <input type="number" min="1" max="5" class="form-control" name="minimum" placeholder="Mínimo">
                  </div>
                 </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="number" class="form-control" name="annual_loss" placeholder="Pérdida anual" >                   </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="number" min="0" max=10 class="form-control" name="amortization" placeholder="Amortización" >
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
                     <input type="number" min="0" class="form-control" name="product-quantity" placeholder="Unidades" >
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                       <i class="fa fa-euro fa-stack"></i>
                     <input type="number" min="0" class="form-control" name="buying-price" placeholder="Precio de compra" >
                     <i>.00</i>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                        <i class="fa fa-euro fa-stack"></i>
                      <input type="number" min="0" class="form-control" name="saleing-price" placeholder="Precio de venta" >
                      <i>.00</i>
                   </div>
                  </div>
                 
               </div>
              </div>

              

              <div class="col-md-4 offset-4">
              <button type="submit" name="search_product" class="btn btn-primary btn-lg btn-block">Buscar</button>
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