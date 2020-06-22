<?php
require 'datacenter.php';
 <?php
 $sql = "INSERT INTO receipt(receipt_id, product_id, seller_id, customer_id) VALUES ('$_POST[receipt_id]','$_POST[product_id]','$_POST[seller_id]', '$_POST[customer_id]')";
 $stmt = $pdo->prepare($sql);
 
  if (is_null($_POST[id])) {
    alert "ID must be not null";
  }
  else
  {
     if($stmt->execute() == TRUE){
         alert "Record inserted successfully.";
     } else {
         alert "Error inserting record: ";
     }
  }
 ?>
?>