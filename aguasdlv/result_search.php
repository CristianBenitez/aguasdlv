<?php
  $page_title = 'Resultados de búsqueda';
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
<?php
 if(isset($_POST['search_product'])){
     $p_barcode  = remove_junk($db->escape($_POST['product-barcode']));
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_prov   = remove_junk($db->escape($_POST['provider']));
     $p_box   = remove_junk($db->escape($_POST['box']));
     $p_expdate   = remove_junk($db->escape($_POST['expiration_date']));
     if($p_expdate==""){
        $p_expdate = make_date();
        $p_expdate = date('Y/m/d', strtotime($p_expdate. "+15 year")); 
     }
     $p_pploc   = remove_junk($db->escape($_POST['principal_location']));
     $p_prloc   = remove_junk($db->escape($_POST['primary_location']));
     $p_secloc   = remove_junk($db->escape($_POST['secondary_location']));
     $p_abc   = remove_junk($db->escape($_POST['product_abc']));
     $p_min   = remove_junk($db->escape($_POST['minimum']));
     $p_loss   = remove_junk($db->escape($_POST['annual_loss']));
     $p_amor   = remove_junk($db->escape($_POST['amortization']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
 }else{
    $p_barcode  = ""; $p_name  = ""; $p_cat   = ""; $p_prov   = ""; $p_box   = ""; 
    $p_expdate = make_date();
    $p_expdate = date('Y/m/d', strtotime($p_expdate. "+15 year")); 
    $p_pploc   = ""; $p_prloc   = ""; $p_secloc   = ""; $p_abc   = ""; $p_min   = ""; $p_loss   = "";
    $p_amor   = ""; $p_qty   = ""; $p_buy   = ""; $p_sale = "";
 }
 
     $query  = "SELECT p.id, p.barcode, p.name , c.name as categorie, p.provider, p.box, p.expiration_date, 
     l.namelocation as location , lp.namelocation as primarylocation, ls.namelocation as secondarylocation, 
     abc.name as abc, p.minimum, p.annual_loss, p.amortization, p.quantity, p.buy_price, p.sale_price
     FROM products p 
     LEFT JOIN categories c ON c.id = p.categorie_id 
     LEFT JOIN location l ON l.idlocation = p.location 
     LEFT JOIN location lp ON lp.idlocation = p.primary_location 
     LEFT JOIN location ls ON ls.idlocation = p.secondary_location 
     LEFT JOIN abc abc ON abc.id_abc = p.abc 
     WHERE p.barcode like '%$p_barcode%' and p.name like '%$p_name%' and p.quantity like '%$p_qty%' 
     and p.buy_price like '%$p_buy%' and p.sale_price like '%$p_sale%' and p.categorie_id like '%$p_cat%' 
     and p.expiration_date <= '$p_expdate' and p.provider like '%$p_prov%' and p.box like '%$p_box%' 
     and p.abc like '%$p_abc%' and p.location like '%$p_pploc%' and p.minimum like '%$p_min%' and p.amortization like '%$p_amor%'
     and p.annual_loss like '%$p_loss%' and p.primary_location like '%$p_prloc%' and p.secondary_location like '%$p_secloc%'
     ORDER BY p.expiration_date asc";

     $products = join_product_table_filter($query);
?>
        <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        
        <div class="panel-body">
          
          <table class="table table-bordered table-striped table-hover" id="product_table">
            <thead>
              <tr>
                <th class="text-center" style="width: 40px;">#</th>
                <th> Código </th>
                <th> Descripción </th>
                <th class="text-center" style="width: 10%;"> U. Principal </th>
                <th class="text-center" style="width: 10%;"> U. Primaria </th> 
                <th class="text-center" style="width: 10%;"> U. Secundaria </th> 
                <th class="text-center" style="width: 10%;"> Familia </th>
                <th class="text-center" style="width: 10%;"> Proveedor </th>
                <th class="text-center" style="width: 5%;"> ABC </th>
                <th class="text-center" style="width: 5%;"> Stock </th>
                <th class="text-center" style="width: 5%;"> Compra </th>
                <th class="text-center" style="width: 5%;"> Venta </th>
                <th class="text-center" style="width: 10%;"> Caducidad </th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <th class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($product['barcode']); ?></td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['location']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['primarylocation']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['secondarylocation']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['provider']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['abc']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php $dateProduct=new DateTime(read_date($product['expiration_date'])); echo $dateProduct->format("d/m/Y") ; ?></td>
                
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
          <div class="col-md-4 offset-4">
          <button class="btn btn-primary btn-lg btn-block" onclick="location.href='search_list.php'" type="">Volver</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>