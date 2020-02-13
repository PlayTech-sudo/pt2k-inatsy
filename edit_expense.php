<?php ob_start();
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
$expense = find_by_id('expenses',(int)$_GET['id']);
//$expense = find_all('expenses');
$all_ecat = find_all('excategory');
//$all_photo = find_all('media');

if(!$expense){
  $session->msg("d","Missing product id.");
  redirect('expenses.php');
}
?>
<?php
 if(isset($_POST['exp-update'])){
    $req_fields = array('ename','ecategory','edesc', 'eprice' );
    validate_fields($req_fields);
   if(empty($errors)){
     $e_name   = remove_junk($db->escape($_POST['ename']));
     $e_cat    = remove_junk($db->escape($_POST['ecategory']));
     $e_desc   = remove_junk($db->escape($_POST['edesc']));
     $e_price  = remove_junk($db->escape($_POST['eprice']));

       $query   = "UPDATE expenses SET";
       $query  .=" ename ='{$e_name}', e_category ='{$e_cat}',";
       $query  .=" e_desc ='{$e_desc}', eprice ='{$e_price}'";
       $query  .=" WHERE id ='{$expense['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Expenses updated ");
                 redirect('expenses.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_expense.php?id='.$expense['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_expense.php?id='.$expense['id'], false);
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
            <span>Update expenses</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_expense.php?id=<?php echo (int)$expense['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="ename" value="<?php echo remove_junk($expense['ename']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="ecategory">
                    <option value=""> Select a categorie</option>
                   <?php  foreach ($all_ecat as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($expense['e_category'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="qty">Expense price</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="eprice" value="<?php echo remove_junk($expense['eprice']);?>">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="qty">E Description</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="text" class="form-control" name="edesc" value="<?php echo remove_junk($expense['e_desc']);?>">
                   </div>
                  </div>
                 </div>
               </div>
              </div>
              <button type="submit" name="exp-update" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
