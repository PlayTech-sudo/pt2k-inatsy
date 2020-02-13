<?php ob_start();
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $products = join_product_table();
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
<div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Cart</span>
       </strong>
      </div>
        <div class="panel-body">
          <?php
          $idd= $_GET['id'];
          $con = mysqli_connect('localhost','root','');
          mysqli_select_db($con,'inventory_auto');
         $sql = "INSERT INTO cart ( id,name,quantity,sale_price) SELECT id,name,quantity,sale_price FROM products where id='$idd'";
         if (mysqli_query($con, $sql))
         {
		                       echo "<script type='text/javascript'>showNotification('top','right','Record Added Successfully.','info');</script>";
		                              //$sql="SELECT sum(prod_amt) from temp";
		                               //$result= mysqli_query($con, $sql);

		                                                  

		             	} 
		             	else
		               	{
		 	                       echo "<script type='text/javascript'>showNotification('top','right','Duplicate Entry.','info');</script>";
	                                                      	}

          ?>
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                <th class="text-center" style="width: 50px;">id</th>
                
                <th> Product Name </th>
                <th class="text-center" style="width: 10%;"> Quantity </th>
                <th class="text-center" style="width: 10%;"> Price </th>
                
                <th class="text-center" style="width: 100px;"> Total </th>
                <th class="text-center" style="width: 100px;"> Action</th>
                </tr>
            </thead>
            <tbody>
            
              <?php
              $sum=0;
                $sql = "select id ,name,quantity,sale_price from cart";
                $query =  mysqli_query($con, $sql);
               while($cst= mysqli_fetch_array($query)){
               	$result=$cst['quantity']*$cst['sale_price'];
               	$sum=$sum+$result;


               	?>
               

                <tr>
                    <td class="text-center"><?php echo remove_junk(ucfirst($cst['id'])); ?></td>
               
                    <td><?php echo remove_junk(ucfirst($cst['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['quantity'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['sale_price'])); ?></td>
                    <td><?php echo $result ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="delcart.php?id=<?php echo (int)$cst['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                  

                </tr>
              <?php } ?>
            </tbody>
            <tr><th colspan="3" align="center"> <?php echo " <b> Total amount = " .$sum; ?></th>
								        		</tr>
          </table>
       </div>
 <a href="pos.php" class="btn btn-primary">Add New</a>    </div>
 <a href="print.php" class="btn btn-primary">Order now</a>    </div>
    </div>
      </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

