<?php
ob_start();
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_categories = find_all('excategory');
  //$all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add-expense'])){
   $req_fields = array('ename','ecategory','edesc','eprice' );
   validate_fields($req_fields);
   if(empty($errors)){
     //$ex_id  = remove_junk($db->escape($_POST['eid']));
     $e_name   = remove_junk($db->escape($_POST['ename']));
     $e_cat   = remove_junk($db->escape($_POST['ecategory']));
     $e_desc   = remove_junk($db->escape($_POST['edesc']));
     $e_price  = remove_junk($db->escape($_POST['eprice']));
     /*if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }*/
     $date    = make_date();
     $query  = "INSERT INTO expenses (";
     $query .=" ename,e_category,e_desc,eprice,date";
     $query .=") VALUES (";
     $query .=" '{$e_name}', '{$e_cat}', '{$e_desc}','{$e_price}','{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE ename='{$e_name}'";
     if($db->query($query)){
       $session->msg('s',"Expenses added ");
       redirect('add-expense.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('expenses.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add-expense.php',false);
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
            <span>Add New Expense</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add-expense.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="ename" placeholder="Expense name">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="ecategory">
                      <option value="">Select Expense Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="eprice" placeholder="Expense Price">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="edesc" placeholder="Expense Description">
               </div>
              </div>
<!--
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
                     <input type="number" class="form-control" name="buying-price" placeholder="Buying Price">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>-->
              <button type="submit" name="add-expense" class="btn btn-danger">Add Expenses</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
