
<?php ob_start();
  $page_title = 'All purchase';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$purchase = find_all_purchase();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Inventory Search</span>
          </strong>
          
        </div>
        <div class="panel-body">
          <div class=col-md-6>

  <h3>Inventory Search</h3>
  <ul class="nav nav-pills">
    <li class="active"><a href="product.php">Products</a></li>
    <li><a href="sales.php">Sales</a></li>
    <li><a href="customer.php">Customers</a></li>
  </ul>
</div>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>

