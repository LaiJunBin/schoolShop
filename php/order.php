<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location:../html/login.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>訂餐</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../main.css">
    <script src="../main.js"></script>
    <style>
        .fade.in{
            overflow-y:scroll;
        }
    </style>
    <script>
        var data = new Map();
        $(function(){
            $('tr[class^=items]').hide();
            $(".keysTr").click(function(){
                var id = $(this).attr('id');
                $('tr[class^=items]').hide();
                $(".items_"+id).slideToggle();
            });
            // var data = new Map();
            $("#adModal").modal('toggle');
            $("[id^=orderBtn]").click(function(){
                var n = $(this).data('id');
                var title = $("#productTitle"+n).text();
                var isOrder = false;
                data.set(title,[]);
                $("[id^=productNumber"+n+'_]').each(function(){
                    var item = $(this).parent().attr('id').split('_');
                    if(parseInt($(this).text())>0){
                        data.get(title).push({
                            'item':item[0],
                            'price':item[1],
                            'amount':$(this).text(),
                            'total':$(this).text()*item[1]
                        });
                    }
                    if(parseInt($(this).text())>0)
                        isOrder = true;
                });
                if(!isOrder)
                    data.delete(title);
                console.log(data);
                $("#product"+n).modal('hide');
            });
            $("[id^=productPlus]").click(function(){
                var id = $(this).attr('id');
                var n = $(this).attr('va');
                operationAmount(id,1,n);
            });
            $("[id^=productReduce]").click(function(){
                var id = $(this).attr('id');
                var n = $(this).attr('va');
                operationAmount(id,-1,n);
            });
            function operationAmount(id,value,n){
                if(id.indexOf('_')!=-1){
                    id = id.replace('productPlus','productNumber');
                    id = id.replace('productReduce','productNumber');
                    var amount = parseInt($('#'+id).text());
                    if(amount+value>=0)
                        $('#'+id).text(amount+value);
                }else{
                    var amount = parseInt($('#productNumber'+n+'_').text());
                    if(amount+value>=0)
                        $('#productNumber'+n+'_').text(amount+value);
                }
            }
            $("#orderSubmitBtn").click(function(){
                if(data.size == 0 ){
                    alert('訂單是空的!請先選擇商品');
                }else{
                    var total = 0;
                    var temp = '<th>品項</th>'+
                        '<th>種類</th>'+
                        '<th>價錢</th>'+
                        '<th>數量</th>'+
                        '<th style="text-align:right;">合計</th>';
                    $("#orderTable").html(temp);
                    data.forEach(function(values,key){
                        for(value of values){
                            var tr = document.createElement('tr');
                            var td = document.createElement('td');
                            td.innerText = key;
                            tr.append(td);
                            for(item in value){
                                var td = document.createElement('td');
                                td.innerText = value[item];
                                if(item =='total')
                                    $(td).css('text-align','right');
                                tr.append(td);
                            }
                            total += value.total;
                            $("#orderTable").append(tr);
                        }
                    });
                     $("#orderTable").append('<tr><td><br></td></tr><tr><td>總計金額</td><td style=text-align:right colspan=4>'+total+'</td></tr>')


                    $("#orderModal").modal('toggle');
                }
            });
            $("#submitOrderBtn").click(function(){
                // 確定訂餐
            });
            $("#myOrderBtn").click(function(){
                $("#myOrderView").modal('toggle');
                
            });
            $(".orderRecordBtn").click(function(){
                var n = $(this).attr('va');
                $("#orderRecord"+n).modal('toggle');
            });
            $(".closeOrder").click(function(){
                var n = $(this).attr('va');
                $("#orderRecord"+n).modal('toggle');
            });
            $(".writeProblem").click(function(){
                var n = $(this).attr('va');
                $('#problem'+n).modal('toggle');
            });
            $(".closeProblem").click(function(){
                var n = $(this).attr('va');
                $("#problem"+n).modal('toggle');
            });
        });
    </script>
</head>
<body>
    <main class="container-fluid">
        <header style="width:100%;">
            <img style="width:100%;height:200px;" src="../images/logo.png">
        </header>
        <a href="../index.html">
        <span style="font-size:20px;">
            <button class="btn btn-default">回首頁</button>
        </span></a>
        <span style="font-size:20px;">
            <button class="btn btn-warning" id="myOrderBtn">查看我的訂單</button>
        </span></a>
    </main>
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
        echo "<tr align=center id=$category class=keysTr>";
        ?>
            <td colspan=4 style=font-size:20px;color:red;><button class="btn btn-info" style="margin:10px 0;">-----<?php echo $category;?>-----</button></td>
        <?php
        echo "</tr>";
        $select = $db->prepare('select * from product where p_category = :category');
        $select->bindValue(':category',$category);
        $select->execute();
        $n = 1;
        while($row = $select->fetch(PDO::FETCH_ASSOC)){ 
        ?>
            <tr class="items_<?php echo $category;?>">
                <td><?php echo $n.'.';?></td>
                <td style="color:blue;"><?php echo $row['p_item'];?></td>
                <td><img src="../<?php echo $row['p_img'];?>" width="50px" height="50px"></td>
                <td align="center">
                    
                    <a href="#" onclick="return product(<?php echo $row['p_id'];?>)">
                        <button type="button" class="btn btn-success">詳細/訂購</button>
                    </a>
                </td>
            </tr>
        <div class="modal fade" <?php if($category=='每週之星'){ ?>modalType="ad" <?php }?> id="product<?php echo $row['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="productTitle<?php echo $row['p_id'];?>"><?php echo $row['p_item'];?></h4>
                        </div>
                        <div class="modal-body" style="font-size:20px;">
                            <img width="100%" src="../<?php echo $row['p_img'];?>"><hr>
                            <?php 
                                $num = 1;
                                if($row['p_price']==''){
                                    $other = $row['p_other'];
                                    $items = explode('/',$other);
                                    foreach ($items as $item) {
                                        $keys = explode(':',$item);
                                        $key = $keys[0];
                                        echo $key."<br>";
                                        $keys = explode(',',$keys[1]);
                                        foreach($keys as $value){
                                            $res = explode('...',$value);
                                            echo $res[0]."：".$res[1]."元";
                                            ?>
                                                <span id="<?php echo $res[0]."_".$res[1];?>">
                                                    <!-- <input type="hidden" name="category" value="<?php echo $res[0];?>">
                                                    <input type="hidden" name="price" value="<?php echo $res[1];?>"> -->
                                                    數量：<span id="productNumber<?php echo $row['p_id']."_".$num;?>">0
                                                       </span>
                                                       <button style="width:40px;" va="<?php echo $num;?>" id="productPlus<?php echo $row['p_id']."_".$num;?>" class="btn btn-info">+1</button>
                                                        <button style="width:40px;" va="<?php echo $num;?>" id="productReduce<?php echo $row['p_id']."_".$num;?>" class="btn btn-warning">-1</button>
                                                   
                                                </span>
                                                <br>
                                            <?php
                                            $num++;
                                        }
                                    }
                                }else{
                                    echo "價格：".$row['p_price'];
                                    ?>
                                        <span id="一般_<?php echo $row['p_price'];?>">數量：
                                            <span id="productNumber<?php echo $row['p_id'];?>_">0
                                             </span>
                                             <button style="width:40px;" va="<?php echo $row['p_id'];?>" id="productPlus<?php echo $row['p_id'];?>" class="btn btn-info">+1</button>
                                            <button style="width:40px;" va="<?php echo $row['p_id'];?>" id="productReduce<?php echo $row['p_id'];?>" class="btn btn-warning">-1</button>
                                        </span>
                                        <br>
                                    <?php
                                }
                            ?><br>
                            <button type="button" style="width:100%;" class="btn btn-info" data-id="<?php echo $row['p_id'];?>" id="orderBtn<?php echo $row['p_id'];?>">放入購物車</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        $n++;
        }
    }
?>
<tr>
    <td colspan="4">
        <button type="button" class="btn btn-primary" id="orderSubmitBtn" style="width:100%;">查看訂單=>結帳</button>
    </td>
</tr>
</table>
<script>
    function product(id){
        $('#product'+id).modal('toggle');
        return false;
    }
</script>
    <?php
        include_once('./pdoLink.php');
        $select = $db->prepare('select * from product where p_category = :category');
        $select->bindValue(':category','每週之星');
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">每週之星</h4>
                </div>
                <div class="modal-body" style="font-size:20px;text-align:center;"><?php echo $row['p_item'];?>
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
                    ?><br>
                    <button style="width:100%;" class="btn btn-success" onclick="$('#adModal').modal('hide');$('[modalType=ad]').modal('toggle')">前往訂購</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">確認訂單資訊</h4>
                </div>
                <div class="modal-body">
                    <table id="orderTable" style="width:100%;text-align:center;">
                        
                    </table>
                    預約取餐時間<select name="reserveTime" class="form-control">
                        <option value="第1節下課(9:00)">第1節下課(9:00)</option>
                        <option value="第2節下課(10:00)">第2節下課(10:00)</option>
                        <option value="第3節下課(11:00)">第3節下課(11:00)</option>
                        <option value="第5節下課(1:00)">第5節下課(1:00)</option>
                        <option value="第6節下課(2:00)">第6節下課(2:00)</option>
                        <option value="第7節下課(3:00)">第7節下課(3:00)</option>
                    </select>
                    <button style="width:100%;" id="submitOrderBtn" class="btn btn-success">確定訂購</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myOrderView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">我的訂單</h4>
                </div>
                <div class="modal-body">
                    
                        <?php
                            include_once('./pdoLink.php');
                            $user = $_SESSION['loginUser'];
                            $sql = 'select Distinct(o_code) from order_table where o_user = :user';
                            $select = $db->prepare($sql);
                            $select->bindValue(':user',$user);
                            $select->execute();
                            while ($code = $select->fetch(PDO::FETCH_ASSOC)['o_code']){
                                ?>
                                <table style="width:100%;text-align:center;">
                                    <th>狀態</th>
                                    <th>訂單編號</th>
                                    <th width="40%">詳細</th>
                                    <tr>
                                        <td>
                                            <?php 
                                                $sql = 'select * from order_status where o_code = :code';
                                                $orderStatus = $db->prepare($sql);
                                                $orderStatus->bindValue(':code',$code);
                                                $orderStatus->execute();
                                                $orderStatus = $orderStatus->fetch(PDO::FETCH_ASSOC);
                                                echo $orderStatus['o_status'];
                                                if($orderStatus['o_pay']=='T'){ ?>
                                                    <div style="color:blue">已付款</div>
                                                <?php }else{ ?>
                                                    <div style="color:red;" class="payDiv<?php echo $code;?>">未付款</div>
                                                <?php }
                                            ?>
                                        </td>
                                        <td><?php echo $code;?></td>
                                        <td>
                                            <button type="button" class="btn btn-success orderRecordBtn" va="<?php echo $code;?>">詳細</button>
                                            <?php
                                                if($orderStatus['o_status']=='已完成'){ ?>
                                                    <button type="button" class="btn btn-info writeProblem" va="<?php echo $code;?>">填問卷</button>
                                                    <div style="height: 100vh;" class="modal fade" id="problem<?php echo $code;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close closeProblem" va="<?php echo $code;?>" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title">填寫問卷</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                        $sql = 'select * from problem';
                                                                        $problemQuery = $db->prepare($sql);
                                                                        $problemQuery->execute();
                                                                        while($problem = $problemQuery->fetch(PDO::FETCH_ASSOC)){
                                                                            $title = $problem['p_title'];
                                                                            $optionData = $problem['p_option'];
                                                                            $data = explode(',',$optionData);
                                                                            echo "<div>$title ：</div>";
                                                                            foreach($data as $opt){
                                                                            ?>
                                                                                <input type="radio"<?php if($opt==$data[0]){ ?> required <?php } ?> name="<?php echo $title;?>"><?php echo $opt;?>

                                                                        <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                    
                                                                    <button type="button" style="width:100%;" class="btn btn-primary">送出問卷</button>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               <?php }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                <div style="height:100vh;" class="modal fade" id="orderRecord<?php echo $code;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"  aria-label="Close">
                                                    <span aria-hidden="true" va="<?php echo $code;?>" class="closeOrder">&times;</span>
                                                </button>
                                                <h4 class="modal-title">訂單編號 <?php echo $code;?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <table style="width:100%;text-align:center;">
                                                <th>品項</th>
                                                <th>種類</th>
                                                <th>價錢</th>
                                                <th>數量</th>
                                                <th style="text-align:right;">合計</th>
                                                <?php
                                                    $sql = 'select * from order_table where o_code = :code';
                                                    $time = '';
                                                    $orderSelect = $db->prepare($sql);
                                                    $orderSelect->bindValue(':code',$code);
                                                    $orderSelect->execute();
                                                    $sql = 'select * from order_status where o_code = :code';
                                                    $status = $db->prepare($sql);
                                                    $status->bindValue(":code",$code);
                                                    $status->execute();
                                                    $statusObj = $status->fetch(PDO::FETCH_ASSOC);
                                                    while($order = $orderSelect->fetch(PDO::FETCH_ASSOC)){
                                                        $time = $order['o_reserve'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $order['o_item'];?></td>
                                                    <td><?php echo $order['o_other'];?></td>
                                                    <td><?php echo $order['o_price'];?></td>
                                                    <td><?php echo $order['o_amount'];?></td>
                                                    <td><?php echo $order['o_price'] * $order['o_amount'];?></td>
                                                </tr>
                                                 <?php } ?>
                                                </table>
                                                <div>預約取餐時間在 <?php echo $time;?></div>
                                                <div>當前訂單狀態:<?php echo $statusObj['o_status'];?></div>
                                                <?php if($statusObj['o_pay']=='T'){ ?>
                                                    <div style="color:blue">已付款</div>
                                                <?php }else{ ?>
                                                    <div style="color:red;">未付款</div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>