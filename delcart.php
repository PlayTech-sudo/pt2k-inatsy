<?php ob_start();
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $cart = find_by_id('cart',(int)$_GET['id']);
  if(!$cart){
    $session->msg("d","Missing Categorie id.");
    redirect('cart2.php');
  }
?>
<?php
  $delete_id = delete_by_id('cart',(int)$cart['id']);
  if($delete_id){
      $session->msg("s","Categorie deleted.");
      redirect('cart2.php');
  } else {
      $session->msg("d","Categorie deletion failed.");
      redirect('cart2.php');
  }
?>
