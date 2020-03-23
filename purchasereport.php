<?php ob_start();
  $page_title = 'All purchase';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
$purchase = find_all(purchase);
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
            <span>All purchase</span>
          </strong>
          <div class="pull-right">
            <a href="add_purchase.php" class="btn btn-primary">Add purchase</a>
            <a href="purchasep.php" class="btn btn-primary">pdf</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
               
             </tr>
            </thead>
           <tbody>
             <?php foreach ($purchase as $pur):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($pur['name']); ?></td>
               <td class="text-center"><?php echo (int)$pur['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($pur['price']); ?></td>
               <td class="text-center"><?php echo $pur['date']; ?></td>
               
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
