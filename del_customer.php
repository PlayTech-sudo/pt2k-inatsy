 <?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $cust = find_by_id('customer',(int)$_GET['id']);
  if(!$cust){
    $session->msg("d","Missing Customer id.");
    redirect('customer.php');
  }
?>
<?php
  $delete_id = delete_by_id('customer',(int)$cust['id']);
  if($delete_id){
      $session->msg("s","Customer deleted.");
      redirect('customer.php');
  } else {
      $session->msg("d","Customer deletion failed.");
      redirect('customer.php');
  }
?>
