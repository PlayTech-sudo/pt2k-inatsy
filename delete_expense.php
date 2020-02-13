<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $exp = find_by_id('expenses',(int)$_GET['id']);
  if(!$exp){
    $session->msg("d","Missing Expense id.");
    redirect('expenses.php');
  }
?>
<?php
  $delete_id = delete_by_id('expenses',(int)$exp['id']);
  if(isset($_POST[$delete_id])){
      $session->msg("s","Expense deleted.");
      redirect('expenses.php');
  } 
  else {
      $session->msg("d","Expenses deletion failed.");
      redirect('expenses.php');
  }
?>
