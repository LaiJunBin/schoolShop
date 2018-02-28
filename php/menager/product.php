<table border="1" align="center" style="width:100%">
<?php
    if(empty($_SESSION))
        session_start();
    include_once("../pdoLink.php");
    $result=$db->prepare("SELECT * FROM product_category");
    $result->execute();
    while($record=$result->fetch(PDO::FETCH_ASSOC))
    {
        $category =$record['p_category'];
        echo "<tr>";
        echo "<td colspan=4 style=font-size:20px;color:red;>-----".$category."-----</td>";
        echo "</tr>";
        $select = $db->prepare('select * from product where p_category = :category');
        $select->bindValue(':category',$category);
        $select->execute();
        $n = 1;
        while($row = $select->fetch(PDO::FETCH_ASSOC)){ 
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
                        $checkUrl = '../checkAdmin.php';
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