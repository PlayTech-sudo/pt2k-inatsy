<?php ob_start();
  $page_title = 'Edit purchase';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$purchase = find_by_id('purchase',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_pur = find_all('purchase');

if(!$purchase){
  $session->msg("d","Missing product id.");
  redirect('purchase.php');
}
?>
<?php
 if(isset($_POST['purchase'])){
    $req_fields = array('product-title','product-categorie','product-quantity','price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['product-title']));
       $p_cat   = (int)$_POST['product-categorie'];
       $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['price']));
       $query   = "UPDATE purchase SET";
       $query  .=" name ='{$p_name}', qty ='{$p_qty}',";
       $query  .=" price ='{$p_buy}', categorie_id ='{$p_cat}'";
       $query  .=" WHERE id ='{$purchase['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Purchase updated ");
                 redirect('purchase.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_purchase.php?id='.$purchase['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_purchase.php?id='.$purchase['id'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Purchase</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_purchase.php?id=<?php echo (int)$purchase['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($purchase['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                    <option value=""> Select a categorie</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($purchase['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($purchase['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">price</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="price" value="<?php echo remove_junk($purchase['price']);?>">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                 </div>
               </div>
              </div>
              <button type="submit" name="purchase" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
