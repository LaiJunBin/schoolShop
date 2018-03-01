<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>註冊</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../main.css">
    <script>
        $(function () {
            $("#register form")[0].addEventListener('submit', register, false);
            var number = 1;
            // 準備做新增
            function register(e) {
                var checkedType =$("input[type=checkbox][name=categoryMethod]:checked").val();
                var category = $("#"+checkedType).val();
                var itemName = reg.itemName.value;
                var price = reg.price.value;
                var file = reg.img.value;

                

                if (password == password2) {
                    $.ajax({
                        url: '../php/register.php',
                        method: "POST",
                        data: {
                            'username': username,
                            'category': category,
                            'password': password,
                            'name': name,
                            'phone': phone,
                            'gender': gender
                        },
                        success: function (result) {
                            alert(result);
                            if (reg.admin == undefined)
                                location.href = './login.html';
                            else {
                                $("#myModal").modal('toggle');
                                $("#mainTable").load('./menager/adminUser.php');
                                $("form")[0].reset();
                            }
                        },
                        error: function (err) {
                            alert(err);
                        }
                    });
                } else {
                    alert('兩次密碼輸入的不一樣');
                }
                e.preventDefault();
            }
            $("input[type=checkbox][name=categoryMethod]").click(function(){
                $("input[type=checkbox][name=categoryMethod]").prop('checked',false);
                $(this).prop('checked',true);
                $("input[type=checkbox][name=categoryMethod]").each(function(){
                    $('#'+$(this).val()).css('display','none');
                });
                $('#'+$(this).val()).css('display','block');
            });
            $("input[type=checkbox][name=otherMethod]").click(function(){
                $("input[type=checkbox][name=otherMethod]").prop('checked',false);
                $(this).prop('checked',true);
                $("input[type=checkbox][name=otherMethod]").each(function(){
                    $('#'+$(this).val()).css('display','none');
                });
                if($(this).val()=='otherPrice'){
                    $("[id^=categoryTrId]").each(function(){
                        $(this).remove();
                    })
                }
                $('#'+$(this).val()).css('display','block');
            });
            $("#addOtherBtn").click(function(){
                var tr = document.createElement('tr');
                var tdLeft = document.createElement('td');
                var tdRight = document.createElement('td');
                var groupInput = document.createElement('input');
                var submitBtn = document.createElement('button');
                var deleteBtn = document.createElement('button');
                $(groupInput).addClass('form-control');
                $(tr).attr('id','categoryTrId'+number);
                submitBtn.innerText="設定欄位標題";
                deleteBtn.innerText="刪除欄位";
                $(submitBtn).addClass('btn');
                $(submitBtn).addClass('btn-info');
                $(submitBtn).attr('id','titleSubmitBtn'+number)
                $(submitBtn).attr('va',number);
                $(submitBtn).attr('type','button');
                $(deleteBtn).addClass('btn');
                $(deleteBtn).addClass('btn-danger');
                $(deleteBtn).attr('id','titleDeleteBtn'+number);
                $(deleteBtn).attr('va',number);
                $(deleteBtn).attr('type','button');
                tdLeft.append(groupInput);
                tdRight.append(submitBtn);
                tdRight.append(deleteBtn);
                $(tdRight).css('display','inline-flex');
                tr.append(tdLeft);
                tr.append(tdRight);
                $("#otherTd").append(tr);
                
                $("#titleDeleteBtn"+number).click(function(){
                    var n = $(this).attr('va');
                    $('#'+'categoryTrId'+n).remove();
                });
                $("#titleSubmitBtn"+number).click(function(){
                    var n = $(this).attr('va');
                    var text = $('#'+'categoryTrId'+n+' input').val();
                    if(text == ''){
                        alert('請輸入欄位名稱');
                        $('#'+'categoryTrId'+n+' input').focus();
                    }else{
                        if(confirm('設定名稱之後無法修改，確定這個標題嗎?')){
                            $(submitBtn).remove();
                            $("#categoryTrId"+n+' td:nth-child(1)').text('欄位名稱:' + text);
                            $('#categoryTrId'+n +' td:nth-child(2)').css('display','block');    
                            $('<button class="btn btn-warning" type="button" id="addOtherBtn'+n+'">新增細項</button>').appendTo($('#categoryTrId'+n +' td:nth-child(2)'));
                            $(deleteBtn).appendTo($("#categoryTrId"+n+' td:nth-child(1)'));
                            var otherN = 1;
                            $("#addOtherBtn"+n).click(function(){
                                var otherInputTitle = document.createElement('input');
                                var otherInputPrice = document.createElement('input');
                                var deleteBtn = document.createElement('button');
                                $(deleteBtn).addClass('btn');
                                $(deleteBtn).addClass('btn-danger');
                                $(deleteBtn).attr('id','otherDelete'+n+'_'+otherN);
                                $(deleteBtn).attr('va',n+'_'+otherN);
                                $(deleteBtn).attr('type','button');
                                deleteBtn.innerText="刪除細項";
                                otherInputTitle.required=true;
                                $(otherInputTitle).attr('id','otherInputTitle'+n+'_'+otherN);
                                $(otherInputTitle).addClass('form-control');
                                $(otherInputTitle).appendTo($('#categoryTrId'+n +' td:nth-child(2)'));
                                otherInputPrice.required=true;
                                $(otherInputPrice).attr('id','otherInputPrice'+n+'_'+otherN);
                                $(otherInputPrice).addClass('form-control');
                                $(otherInputPrice).appendTo($('#categoryTrId'+n +' td:nth-child(2)'));
                                $(otherInputPrice).attr('placeholder','價格');
                                $(otherInputTitle).attr('placeholder','標題')
                                $(deleteBtn).appendTo($('#categoryTrId'+n +' td:nth-child(2)'));
                                $('#otherDelete'+n+'_'+otherN).click(function(){
                                    $(this).remove();
                                    $('#otherInputTitle'+$(this).attr('va')).remove();
                                    $('#otherInputPrice'+$(this).attr('va')).remove();
                                });
                                
                                otherN ++;
                            });
                        }
                    }
                });
                number++;
            });
            
        });
    </script>
</head>

<body>
    <main class="container-fluid">
        <header style="width:100%;">
            <img style="width:100%;height:200px;" src="../images/logo.png">
        </header>
        <div id="register">
            <form style="overflow: hidden;" action="#" method="post" name="reg" class="form-group">
                新增產品
                <table align="center">
                    <tr>
                        <td width="20%">
                            <div class="textLeft">分
                                <div class="textRight">類:</div>
                            </div>
                        </td>
                        <td style="line-height:20px">
                            <input type="checkbox" name="categoryMethod" value="categorySelect" checked>使用選單<br>
                            <input type="checkbox" name="categoryMethod" value="categoryInput">新增分類
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:100%;">
                            <select id="categorySelect" style="width:100%;">
                                <?php
                                    include_once('../pdoLink.php');
                                    $selectSQL="select * from product_category";
                                    $select = $db->prepare($selectSQL);
                                    $select->execute();
                                    while($result = $select->fetch(PDO::FETCH_ASSOC)){?>
                                    <option value="<?php echo $result['p_category']?>">
                                        <?php 
                                        echo $result['p_category'];
                                        ?>
                                    </option>
                                    <?php }
                                ?>
                            </select>
                            <input class="form-control" required id="categoryInput" placeholder="請輸入分類名稱" type="text" name="category" style="display:none;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="textLeft">品
                                <div class="textRight">名:</div>
                            </div>

                        </td>
                        <td>
                            <input class="form-control" required type="text" name="itemName">
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>

                            <div class="textLeft">價
                                <div class="textRight">格:</div>
                            </div>
                        </td>
                        <td>
                            <input class="form-control" required type="text" name="price">
                        </td>
                    </tr> -->
                    <tr>
                        <td>

                            <div class="textLeft">圖
                                <div class="textRight"> 片:</div>
                            </div>
                        </td>
                        <td>
                            <input type="file" required name="img">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="textLeft">選
                                <div class="textRight"> 項:</div>
                            </div>
                        </td>
                        <td style="line-height:20px">
                            <input type="checkbox" name="otherMethod" value="otherPrice" checked>價格<br>
                            <input type="checkbox" name="otherMethod" value="addOtherBtn">群組
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" id="addOtherBtn" class="btn btn-primary" style="display:none">新增欄位群組(例如口味/大小)</button>
                            <input type="text" id="otherPrice" class="form-control" placeholder="請輸入價格">
                        </td>

                    </tr>
                    <tr >
                        <td colspan="2">
                            <table id="otherTd">
                            </table>
                        </td>
                    </tr>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-success" type="submit">新增</button>
                            </td>
                        </tr>
                </table>
            </form>
        </div>
    </main>
</body>

</html>