<?php
ob_start();
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $all_categories = find_all('categories');
  //$all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_purchase'])){
   $req_fields = array('product-title','product-categorie','price','product-quantity', 'total' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_pri   = remove_junk($db->escape($_POST['price']));
     $p_qty  = remove_junk($db->escape($_POST['product-quantity']));
     $p_tot  = remove_junk($db->escape($_POST['total']));
     $p_date  = make_date();
     //if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      // $media_id = '0';
     //} else {
       //$media_id = remove_junk($db->escape($_POST['product-photo']));
     //}

     $query  = "INSERT INTO purchase (";
     $query .=" name,qty,price,categorie_id,date";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_pri}', '{$p_cat}','{$p_date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Purchase added ");
       redirect('add_purchase.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('purchase.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_purchase.php',false);
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
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Purchase</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_purchase.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Product Title">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="text" class="form-control" name="price" placeholder="Price">
                  </div>
                 </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="text" class="form-control" name="total" placeholder="total">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  
              <button type="submit" name="add_purchase" class="btn btn-danger">Add purchase</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
