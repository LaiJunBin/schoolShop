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
            function loadOrderView(){
                $.ajax({
                    url:'./orderView.php',
                    async:false,
                    success:function(res){
                        $("#myOrderViewBody").html(res);
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
                    }
                });
            }
            loadOrderView();
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
                var reserve = $('select[name=reserveTime]').val();
                var maxCode = 0;
                $.ajax({
                    url:'./getMaxOrderCode.php',
                    async:false,
                    success:function(code){
                        maxCode = parseInt(code)+1;  
                    }
                })
                data.forEach(function(values,key){
                    for(item of values){
                        $.ajax({
                            url:'./orderProcess.php',
                            method:'POST',
                            async:false,
                            data:{
                                'code':maxCode,
                                'reserve':reserve,
                                'amount':item.amount,
                                'price':item.price,
                                'other':item.item,
                                'item':key
                            },
                            success:function(result){
                                
                            }
                            ,error:function(err){
                                console.log(err);
                            }
                        })
                    }
                });
                $("#orderModal").modal('hide');
                data.clear();
                $('[id^=productNumber]').text(0);
                loadOrderView();
                $("#myOrderView").modal('toggle');
            });
            $("#myOrderBtn").click(function(){
                $("#myOrderView").modal('toggle');
                
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
                <div class="modal-body" id="myOrderViewBody">
                    
                       
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>