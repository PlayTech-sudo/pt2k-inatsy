<?php ob_start();
  $page_title = 'Edit customer';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  //Display all catgories.
  $customer = find_by_id('customer',(int)$_GET['id']);
  if(!$customer){
    $session->msg("d","Missing categorie id.");
    redirect('customer.php');
  }
?>

<?php
if(isset($_POST['edit_cust'])){
  $req_field = array('cust-name','cust-gender','cust-no');
  validate_fields($req_field);
  $c_name = remove_junk($db->escape($_POST['cust-name']));
   $c_gender = remove_junk($db->escape($_POST['cust-gender']));
   $c_no = remove_junk($db->escape($_POST['cust-no']));
  if(empty($errors)){
        $sql   = "UPDATE customer SET";
       $sql  .=" name ='{$c_name}', gender ='{$c_gender}',";
       $sql  .=" mobno ='{$c_no}'";
       $sql  .=" WHERE id ='{$customer['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Customers");
       redirect('customer.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
       redirect('customer.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('customer.php',false);
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
            <span>Update Customers</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_customer.php?id=<?php echo (int)$customer['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="cust-name" placeholder="Customer Name" value="<?php echo remove_junk($customer['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-th-large"></i>
                        </span>
                        <input type="text" class="form-control" name="cust-gender" placeholder="Customer Gender" value="<?php echo remove_junk($customer['gender']);?>">
                      </div>
                    
                  <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-th-large"></i>
                        </span>
                        <input type="number" class="form-control" name="cust-no" value="<?php echo remove_junk($customer['mobno']);?>">
                      </div>
                  </div>
                </div>
              </div>              
              <button type="submit" name="edit_cust" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>