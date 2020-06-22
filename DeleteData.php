<!DOCTYPE html>
<html>
<body>

<h1>Xóa DL</h1>

<h4>ID SP cần xóa</h4>

<form name="delete" method="POST" action="DeleteData.php">
    <lable for="id">ID Sản Phẩm</label><input type="text" name="id" /><br>
    <input type="submit" value="Xóa">
</form>

<?php
ini_set('display_errors', 1);
echo "Insert database!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
}  else {
     
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

$sql = "DELETE FROM product WHERE id = '$_POST[id]'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>
