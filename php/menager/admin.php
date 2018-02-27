<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../main.css">
    <script>
        function checkDel() {
            if (confirm('確定刪除這個帳戶嗎?')) {
                return true;
            }
            return false;
        }
        $(function () {
            $(".btn-group .btn").click(function () {
                var uri ='';
                $('.btn-group .btn').removeClass('active');
                $(this).addClass('active');
                $("header span:nth-child(1)").text($(this).text());
                $("header button").text('新增'+$(this).data('tit'));
                if($(this).data('tit')=='帳戶'){
                    uri = '../html/register.html';
                }else{
                    uri = '../html/adminRegister.html';
                }
                $("#myModalTitle").text('新增'+$(this).data('tit'));
                $("#myModalBody").load(uri,function(){
                    $("#myModalBody form").append("<input type=hidden name=admin value=#>");
                    $("#myModalBody form")[0].addEventListener('submit',function(e){
                        $(this).attr('action','#');
                        e.preventDefault();
                    },false);
                });
            });
        })
    </script>
    <style>
        #userAdmin{
            text-align:center;
        }
    </style>
</head>

<body>
    <main class="container-fluid">
               <header style="width:100%;">
            <img style="width:100%;height:200px;" src="../images/logo.png">
        </header>
        <div id="userAdmin">
            <nav class="btn-group">
                <button class="btn btn-default"><a href="../index.html" style="display:block;color:#000;text-decoration:none;">回首頁</a></button>
                <button class="btn btn-default active" data-tit="帳戶">帳戶管理</button>
                <button class="btn btn-default" data-tit="管理員">管理員管理</button>
            </nav>
            <header><span>帳戶管理</span>
                <span style="font-size:20px;">
                    <button class="btn btn-default" data-toggle="modal" data-target="#myModal">新增帳戶</button>
                </span>
            </header>
            <div style="font-size:24px;">
                <table border="1" align="center" style="width:50%">
                    <?php
                    include_once("./pdoLink.php");
                    $result=$db->prepare("SELECT * FROM user");
                    $result->execute();
                    $recordEmpty=true;
                    while($record=$result->fetch(PDO::FETCH_ASSOC))
                    {
                        if($recordEmpty){ ?>
                        <th>ID</th>
                        <th>性別</th>
                        <th>姓名</th>
                        <th>科別</th>
                        <th>帳號</th>
                        <th width="20%">操作</th>
                        <?php }
                        $recordEmpty = false;
                        echo "<tr>";
                        echo "<td>".$record['u_id']."</td>";
                        echo "<td>".$record['u_gender']."</td>";
                        echo "<td>".$record['u_name']."</td>";
                        echo "<td>".$record['u_category']."</td>";
                        echo "<td>".$record['u_username']."</td>";
                        ?>
                        <td width="20%">
                            <a href="menager/deleteUser.php?id=<?php echo $record['u_id'];?>" onclick="return checkDel()">
                                <button type="button">刪除帳戶</button>
                            </a>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                    if($recordEmpty){
                        echo "沒有帳戶";
                    }
                ?>
                </table>
            </div>
        </div>
    </main>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalTitle">新增帳戶</h4>
      </div>
      <div class="modal-body" id="myModalBody">
        
      </div>
    </div>
  </div>
</div>
</body>

</html>