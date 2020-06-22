<html>
<?php
ini_set('display_errors', 1);
if (empty(getenv("DATABASE_URL"))){
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
    echo getenv("dbname");
$db = parse_url(getenv("DATABASE_URL"));
$pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-34-197-141-7.compute-1.amazonaws.com;port=5432;user=swlkkbqcrglzzg;password=65232542ac11465842a449d6a73c2a81eba57efff6d6cfae29c2f688246681ca;dbname=d13sqb8ctk5ua3",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
));
}
 <?php
 $sql = "INSERT INTO receipt(receipt_id, product_id, seller_id, customer_id)VALUES ('$_POST[receipt_id]','$_POST[product_id]','$_POST[seller_id]', '$_POST[customer_id]')";
 $stmt = $pdo->prepare($sql);
 
  if (is_null($_POST[id])) {
    echo "ID must be not null";
  }
  else
  {
     if($stmt->execute() == TRUE){
         echo "Record inserted successfully.";
     } else {
         echo "Error inserting record: ";
     }
  }
 ?>
?>
</html>