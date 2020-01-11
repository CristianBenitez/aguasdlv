<?php
  $page_title = 'Entrada y Salida de Stock';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

if(isset($_GET['id'])){
    $product = find_by_id('products',(int)$_GET['id']);
    $action = $_GET['action'];
    if(!$product){
        $session->msg("d","Missing product id.");
        redirect('product.php');
    }
    ?>
    <input type="hidden" id="idproducto" name="idproducto" value="<?php echo $_GET['id'];?>">
    <input type="hidden" id="action" name="action" value="<?php echo $_GET['action'];?>">
    <div class="form-group">
        <div class="input-group">
            <i class="fa fa-barcode fa-stack"></i>
            <input type="text" class="form-control" name="product-barcode" value="<?php echo remove_junk($product['barcode']);?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <i class="fa fa-th fa-stack"></i>
            <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']);?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <i class="fa fa-shopping-cart fa-stack"></i>
            <input type="number" min="0" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>" readonly >
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <?php
            if($action==0){
                echo '<i class="fa fa-plus fa-stack"></i>';
                echo '<input type="number" min="0" class="form-control" name="new-quantity" placeholder="Cantidad Entrada" required>';   
            }else{
                echo '<i class="fa fa-minus fa-stack"></i>';
                echo '<input type="number" min="0" class="form-control" name="new-quantity" placeholder="Cantidad Salida" required>';   
            }
            ?>
        </div>
    </div>
    <?php
}

if(isset($_POST['grabar_cantidad'])){
    
        $p_id = $_POST['idproducto'];
        $p_action = $_POST['action'];
        $p_barcode  = remove_junk($db->escape($_POST['product-barcode']));
        $p_name  = remove_junk($db->escape($_POST['product-title']));
        $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
        $p_inoutqty   = remove_junk($db->escape($_POST['new-quantity']));
        
        if($p_action == 0){
            $newqty = suma($p_qty, $p_inoutqty);
        }else{
            $newqty = resta($p_qty, $p_inoutqty);
        }        
        
        if($newqty < 0){
            $session->msg('d','No hay suficiente stock para ese producto.');
            redirect('product.php', false); 
        }else{
            $query   = "UPDATE products SET";
            $query  .=" quantity ='{$newqty}'";
            $query  .=" WHERE id ='{$p_id}'";
            $result = $db->query($query);
            if($result && $db->affected_rows() === 1){
                $session->msg('s',"El producto ha sido actualizado. ");
                redirect('product.php', false);
            } else {
                $session->msg('d',' La actualización falló.');
                redirect('product.php', false);
            }
        }
        
 
       
}

?>
