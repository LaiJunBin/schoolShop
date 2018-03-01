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
                var deleteBtn = document.createElement('button');
                deleteBtn.innerText="刪除選項";
                $(deleteBtn).addClass('btn');
                $(deleteBtn).addClass('btn-danger');
                $(deleteBtn).attr('id','titleDeleteBtn'+number);
                $(deleteBtn).attr('va',number);
                $(deleteBtn).attr('type','button');
                tdRight.append(deleteBtn);
                $(groupInput).addClass('form-control');
                $(tr).attr('id','categoryTrId'+number);
                tdLeft.append(groupInput);
                $(tdRight).css('display','inline-flex');
                tr.append(tdLeft);
                tr.append(tdRight);
                $("#addOtherDiv").append(tr);
                $("#titleDeleteBtn"+number).click(function(){
                    var n = $(this).attr('va');
                    $('#'+'categoryTrId'+n).remove();
                });
                number++;
                // <button type="button" id="addOtherBtn" class="btn btn-primary">新增選項</button>
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
            <form action="#" method="post" name="reg" class="form-group">
                新增問卷
                <table align="center">
                    <tr>
                        <td>
                            <div class="textLeft">題
                                <div class="textRight">目:</div>
                            </div>

                        </td>
                        <td>
                            <input class="form-control" required type="text" name="itemName">
                        </td>
                    </tr>
                    <tr>
                        <td style="position:absolute">
                            <div class="textLeft">選
                                <div class="textRight"> 項:</div>
                            </div>
                        </td>
                        <td>
                            <div id="addOtherDiv"></div>
                            <button type="button" id="addOtherBtn" class="btn btn-primary">新增選項</button>
                        </td>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-success" type="submit">新增問卷</button>
                            </td>
                        </tr>
                </table>
            </form>
        </div>
    </main>
</body>

</html>