<?php ob_start();
  $page_title = 'All Expense';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $expenses = join_expense_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="expensep.php" class="btn btn-primary">pdf</a>
           <a href="add-expense.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;">id</th>
<!--                <th> Photo</th>
                <th> Product Title </th>-->
                <th class="text-center" style="width: 10%;"> Expense Name </th>
                <th class="text-center" style="width: 10%;"> Categories </th>
                <th class="text-center" style="width: 10%;"> Price </th>
                <th class="text-center" style="width: 10%;"> Expense Description </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($expenses as $expense):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($expense['ename']); ?></td>
                <td class="text-center"> <?php echo remove_junk($expense['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($expense['eprice']); ?></td>
                <td class="text-center"> <?php echo remove_junk($expense['e_desc']); ?></td>
                <td class="text-center"> <?php echo read_date($expense['date']); ?></td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
