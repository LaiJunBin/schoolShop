<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>查看菜單</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <main class="container-fluid">
        <header style="width:100%;">
            <img style="width:100%;height:200px;" src="../images/logo.png">
        </header>
        <header><a href="../index.html">
        <span style="font-size:20px;">
                    <button class="btn btn-default" id="myModalBtn">回首頁</button>
                </span></a>
        <a href="./order.php">
                <span style="font-size:20px;">
                            <button class="btn btn-success">前往訂餐</button>
                </span></a>
                <div style="width:100%;text-align:center;font-size:30px;">查看菜單</div>
                
            </header><hr>
        <table align="center" style="width:100%">
<?php
    if(empty($_SESSION))
        session_start();
    include_once("./pdoLink.php");
    $result=$db->prepare("SELECT * FROM product_category");
    $result->execute();
    while($record=$result->fetch(PDO::FETCH_ASSOC))
    {
        $category =$record['p_category'];
        echo "<tr align=center>";
        echo "<td colspan=4 style=font-size:20px;color:red;>-----".$category."-----</td>";
        echo "</tr>";
        $selectProduct = $db->prepare('select * from product where p_category = :category');
        $selectProduct->bindValue(':category',$category);
        $selectProduct->execute();
        $n = 1;
        while($row = $selectProduct->fetch(PDO::FETCH_ASSOC)){
        ?>
            <tr>
                <td><?php echo $n.'.';?></td>
                <td style="color:blue;"><?php echo $row['p_item'];?></td>
                <td><img src="../<?php echo $row['p_img'];?>" width="50px" height="50px"></td>
                <td>
                    
                    <a href="#" onclick="return viewMore(<?php echo $row['p_id'];?>)">
                        <button type="button" class="btn btn-success">詳細</button>
                    </a>
                    <!-- 還沒做 -->
                    <?php 
                        $checkUrl = './checkAdmin.php';
                        if(include($checkUrl)) {
                    
                    ?>
                        <a href="#">
                            <button type="button" class="btn btn-warning">修改</button>
                        </a>
                        <a href="#" onclick="return checkDel('menager/deleteProduct.php?id=<?php echo $row['p_id'];?>')">
                            <button type="button" class="btn btn-danger">刪除</button>
                        </a>
                    <?php } ?>
                </td>
            </tr>
            <div class="modal fade" id="viewMoreModal<?php echo $row['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title"><?php echo $row['p_item'];?></h4>
                        </div>
                        <div class="modal-body" style="font-size:20px;">
                            <img width="100%" src="../<?php echo $row['p_img'];?>"><br>
                            <?php 
                                if($row['p_price']==''){
                                    $other = $row['p_other'];
                                    $items = explode('/',$other);
                                    foreach ($items as $item) {
                                        $keys = explode(':',$item);
                                        echo $keys[0]."<br>";
                                        $keys = explode(',',$keys[1]);
                                        foreach($keys as $value){
                                            $res = explode('...',$value);
                                            echo $res[0]."：".$res[1]."元<br>";
                                        }
                                    }
                                }else{
                                    echo "價格：".$row['p_price'];

                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $n++;
        }
    }
?>
</table>
<script>
    function viewMore(id){
        $('#viewMoreModal'+id).modal('toggle');
        return false;
    }
</script>
    </main>
</body>

</html>