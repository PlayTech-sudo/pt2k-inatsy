<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $purchase = find_by_id('purchase',(int)$_GET['id']);
  if(!$purchase){
    $session->msg("d","Missing Purchase id.");
    redirect('purchase.php');
  }
?>
<?php
  $delete_id = delete_by_id('purchase',(int)$purchase['id']);
  if($delete_id){
      $session->msg("s","Purchase deleted.");
      redirect('purchase.php');
  } else {
      $session->msg("d","Purchase deletion failed.");
      redirect('purchase.php');
  }
?>
