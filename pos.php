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
 <?php
 /*    
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
          $query = mysqli_query($con,"select * from cart where id=$idd");
          ?>
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                <th class="text-center" style="width: 50px;">id</th>
                
                <th> Product Name </th>
                <th class="text-center" style="width: 10%;"> Quantity </th>
                <th class="text-center" style="width: 10%;"> Price </th>
                
                <th class="text-center" style="width: 100px;"> Total </th>
                </tr>
            </thead>
            <tbody>
            
              <?php while($cst= mysqli_fetch_array($query)){?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cst['id '])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['name'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['quantity'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($cst['sale_price'])); ?></td>
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
              <?php } ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   
    */ 
    ?>
        
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>POINT OF SALE</span>
       </strong>

         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        
      </div>
       
        <div class="panel-body">
          <form name="form4" action="" method="POST">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Product Name </th>
                <th class="text-center" style="width: 10%;"> Categorie </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
               <!--<td class="text-center"> <?php //echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php //echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php //echo read_date($product['date']); ?></td>-->
                <td class="text-center">
                  <div class="btn-group">
                    <a href="cart2.php?id=<?php echo (int)$product['id'];?>" class="btn btn-primary"  title="Add to Cart" name="cart" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                   
                  </div>
                </td>
              </tr>
             <?php endforeach;
             
                                                
              ?>
            </tbody>
          </tabel>
          <?php
          /*
          if (isset($_POST['cart'])) {
                                          
                                          $id1=6; 
                                          $query = mysqli_query($con,"select id,name,quantity,sale_price from products where id=6");
                                          while($invoice= mysqli_fetch_array($query))
                                          {
                                          $prod_id=$invoice['id'];
                                          $name=$invoice['name'];
                                          $qty=$invoice['quantity'];
                                          $price=$invoice['sale_price'];
                                        }
                                          $sql = "INSERT INTO cart (id,name,quantity,sale_price,total) VALUES ('$prod_id',' $name','$qty','$price')";

                                         mysqli_query($con, $sql); 
                                       }
  */                                     ?>
        </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

