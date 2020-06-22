<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainstyle.css"/>
    <title>ATN datcenter</title>
</head>
<body>
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

        $sql = "SELECT * FROM receipt ORDER BY receipt_id";
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN cơ sở dữ liệu</h1>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#" onClick="displayData()"><b>Xem dữ liệu hóa đơn</b></a>
            </div>
            <div class="grid-item">
            <ul>
                <form name="InsertData" action="datacenter.php" method="POST" >
                    <li>Receipt_id:</li><li><input type="text" name="receipt_id" /></li>
                    <li>Pruduct id:</li><li><input type="text" name="product_id" /></li>
                    <li>Seller_id:</li><li><input type="text" name="seller_id" /></li>
                    <li>Customer_id:</li><li><input type="text" name="customer_id" /></li>
                    <li><input type="submit" /></li>
                </form>
                <?php
                $sql = "INSERT INTO repceipt(receipt_id, product_id, seller_id, customer_id) VALUES ('$_POST[receipt_id]','$_POST[product_id]','$_POST[seller_id]', '$_POST[customer_id]')";
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
            </ul>
                <a href="#"><b>Thêm DL</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#"><b>Xóa DL</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#"><b>Cập nhật DL</b></a>
            </div>
            //display all data of a tables
            <div id ="displaychange" class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>receipt_id</th>
                        <th>product_id</th>
                        <th>seller_id</th>
                        <th>customer_id</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // tạo vòng lặp 
                        //while($r = mysql_fetch_array($result)){
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['receipt_id'] ?></td>
                        <td><?php echo $row['product_id'] ?></td>
                        <td><?php echo $row['seller_id'] ?></td>
                        <td><?php echo $row['customer_id']?></td>     
                    </tr>
                    
                    <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="./data.js"></script>
</body>
</html>