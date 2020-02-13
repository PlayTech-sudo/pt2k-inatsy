<?php ob_start();
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  
  $all_cust = find_all('customer')
?>
<?php
 if(isset($_POST['add_cust'])){
   $req_field = array('cust-name','cust-gender','cust-no');
   validate_fields($req_field);
   $c_name = remove_junk($db->escape($_POST['cust-name']));
   $c_gender = remove_junk($db->escape($_POST['cust-gender']));
   $c_no = remove_junk($db->escape($_POST['cust-no']));
   if(empty($errors)){
     $query  = "INSERT INTO customer (";
     $query .=" name,gender,mobno";
     $query .=") VALUES (";
     $query .=" '{$c_name}', '{$c_gender}', '{$c_no}'";
     $query .=")";
      if($db->query($query)){
        $session->msg("s", "Successfully Added customers");
        redirect('customer.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
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
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New customer</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="customer.php">
             <div class="form-group">
                <input type="text" class="form-control" name="cust-name" placeholder="Customer Name">
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="cust-gender" placeholder="Customer Gender">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="cust-no" placeholder="Mobile No:">
            </div>
            <button type="submit" name="add_cust" class="btn btn-primary">Add Customer</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Customers</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">id</th>
                    <th>C_Name</th>
                    <th class="text-center" style="width: 10%;"> C_gender </th>
                    <th class="text-center" style="width: 10%;"> Mob_no </th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_cust as $cst):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cst['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['gender'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['mobno'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_customer.php?id=<?php echo (int)$cst['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="del_customer.php?id=<?php echo (int)$cst['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
