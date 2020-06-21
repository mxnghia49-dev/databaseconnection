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
            echo '<p>The DB does not exist</p>';
            $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres', 'postgres', '123456');
        }  else {
            echo '<p>The DB exists</p>';
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

        $sql = "SELECT * FROM product ORDER BY id";
        $stmt = $pdo->prepare($sql);
        //Thiết lập kiểu dữ liệu trả về
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();
    ?>
    <h1>ATN cơ sở dữ liệu</h1>
    <div class="container">
        <div class="grid-view">
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#"><b>In Danh Sách SP</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#"><b>Thêm SP mới</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#"><b>Xóa SP</b></a>
            </div>
            <div class="grid-item">
                <img src="./database.png"/>
                <a href="#"><b>Cập nhật SP</b></a>
            </div>
            <div class="grid-item">
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prodcuct_Name</th>
                        <th>Product_quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // tạo vòng lặp 
                        //while($r = mysql_fetch_array($result)){
                            foreach ($resultSet as $row) {
                    ?>
                    
                    <tr>
                        <td scope="row"><?php echo $row['id'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td><?php echo $row['product_quantity'] ?></td>     
                    </tr>
                    
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>