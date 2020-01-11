<?php
  $page_title = 'Listado de clientes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $all_clientes = join_clientes_table();
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <button class="btn-primary btn-lg btn-block" onclick="location.href='add_cliente.php'" type="">Agregar cliente</button>
         </div>
        </div>
        <div class="panel-body">
          <div class="form-group has-search col-md-8">
            <input type="text" class="form-control" id="inputBusqueda" onkeyup="refreshTablaClientes()" onchange="refreshTablaClientes()" placeholder="Introduzca código del cliente">
          </div>
          <table class="table table-bordered table-striped table-hover" id="clientes_table">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">Cod.</th>
                <th class="text-center" style="width: 100px;"> Ruta </th>
                <th class="text-center" style="width: 50px;"> Orden </th>
                <th class="text-center" style="width: 10%;"> Nombre </th>
                <th class="text-center" style="width: 8%;"> Medidor </th>
                <th class="text-center" style="width: 5%;"> Partida </th>
                <th class="text-center" style="width: 10%;"> Direccion </th>
                <th class="text-center" style="width: 10%;"> Sector </th>
                <th class="text-center" style="width: 175px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($all_clientes as $cliente):?>
              <tr>
                <th class="text-center"><?php echo remove_junk($cliente['codigo']);?></td>
                <td> <?php echo remove_junk($cliente['ruta']); ?></td>
                <td> <?php echo remove_junk($cliente['orden']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['nombre']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['medidor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['partida']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['calle']) . remove_junk($cliente['numero']); ?></td>
                <td class="text-center"> <?php echo remove_junk($cliente['sector']); ?></td>
                <td class="text-center">
                    <a href="search_product.php?id=<?php echo (int)$product['id'];?>" class="btn-sm btn-warning"  title="Consultar producto" data-toggle="tooltip">
                      <i class="fa fa-search"></i>
                    </a>
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn-sm btn-info"  title="Editar producto" data-toggle="tooltip">
                      <i class="fa fa-edit"></i>
                    </a>
                    <!--<a href="javascript:void(0);" data-href="modif_quant.php?id=< ? php echo (int)$product['id'];?>&action=0" class="btn-sm btn-light openmodalquantity"  title="Entrada de stock">
                     <i class="fa fa-plus"></i>
                    </a>
                    <a href="javascript:void(0);" data-href="modif_quant.php?id=< ?php echo (int)$product['id'];?>&action=1" class="btn-sm btn-dark openmodalquantity"  title="Salida de stock">
                      <i class="fa fa-minus"></i>
                    </a>!-->
                     <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn-sm btn-danger"  title="Eliminar producto" data-toggle="tooltip">
                      <span class="fa fa-trash"></span>
                    </a>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
          <div class="col-md-4 offset-4">
          <button class="btn btn-primary btn-lg btn-block" onclick="location.href='home.php'" type="">Volver</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  
<!-- modal edit user -->
<div class="modal fade" id="modal-quantity">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="needs-validation" method="POST" action="modif_quant.php">
        <div class="modal-header">
        <h4 class="modal-title" id="modal-quantity-title">Entrada y Salida de Stock</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="submit" name="grabar_cantidad" id="grabar_cantidad" class="btn btn-primary btn-lg btn-block">Actualizar</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <?php include_once('layouts/footer.php'); ?>
