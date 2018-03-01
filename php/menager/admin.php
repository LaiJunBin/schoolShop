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
        function checkDel(uri) {
            activeUri = {
                'uri':'',
                'mainTableUri':''
            };
            getUri($(".btn-group .active").data('tit'),activeUri);
            if (confirm('確定刪除這個帳戶嗎?')) {
                $.ajax({
                    url:uri,
                    method:'GET',
                    success:function(result){
                        $("#mainTable").load(activeUri.mainTableUri);
                        alert('刪除成功');
                    },
                    error:function(err){
                        console.log(err);
                    }
                });
                return false;
            }
            return false;
        }
        function getUri(target,uriObj){
            switch (target){
                case '帳戶':
                    uriObj.uri = '../html/register.html';
                    uriObj.mainTableUri='./menager/adminUser.php';
                    break;
                case '管理員':
                    uriObj.uri = '../html/adminRegister.html';
                    uriObj.mainTableUri='./menager/adminAdmin.php';
                    break;
                case '回首頁':
                    location.href="../index.html";
                    break;
                case '產品':
                    uriObj.uri = './menager/addProduct.php';
                    uriObj.mainTableUri='./menager/product.php';
                    break;
                case '訂單':
                    uriObj.uri = '';
                    uriObj.mainTableUri='./menager/order.php';
                    break;
                case '問卷':
                    uriObj.uri = './menager/addProblem.php';
                    uriObj.mainTableUri='./menager/problem.php';
                    break;
                default:
                    alert('error');
                    break;
            }
        }
        $(function () {
            $(".btn-group .btn").click(function () {
                var uriObj = {
                    'uri':'',
                    'mainTableUri':''
                };
                $('.btn-group .btn').removeClass('active');
                $(this).addClass('active');
                $("header span:nth-child(1)").text($(this).text());
                $("header button").text('新增' + $(this).data('tit'));
                getUri($(this).data('tit'),uriObj);
                $("#myModalTitle").text('新增' + $(this).data('tit'));
                if(uriObj.uri !='')
                    loadForm(uriObj.uri);
                $("#mainTable").load(uriObj.mainTableUri);
                if(uriObj.uri=='')
                    $('#myModalBtn').css('display','none');
                else
                    $("#myModalBtn").css('display','block');
            });
            $("#myModalBtn").click(function () {
                $("#myModal").modal('toggle');
            });
            function loadForm(uri){
                $("#myModalBody").load(uri, function () {
                    $("#myModalBody form").append("<input type=hidden name=admin value=#>");
                    $("#myModalBody form")[0].addEventListener('submit', function (e) {
                        // $(this).attr('action', '#');
                        e.preventDefault();
                    }, false);
                });
            }
            loadForm('../html/register.html');
            $("#mainTable").load('./menager/adminUser.php');
        })
    </script>
    <style>
        #userAdmin {
            text-align: center;
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
                <button class="btn btn-default" data-tit="回首頁">
                    <a href="../index.html" style="display:block;color:#000;text-decoration:none;">回首頁</a>
                </button>
                <button class="btn btn-default active" data-tit="帳戶">帳戶管理</button>
                <button class="btn btn-default" data-tit="管理員">管理員管理</button>
                <button class="btn btn-default" data-tit="產品">新增產品</button><br>
                <div style="text-align:center;">
                <button class="btn btn-default" data-tit="訂單">訂單管理</button>
                <button class="btn btn-default" data-tit="問卷">問卷管理</button>
                </div><br>
            </nav>
            <header>
                <span>帳戶管理</span>
                <span style="font-size:20px;">
                    <button class="btn btn-default" id="myModalBtn">新增帳戶</button>
                </span>
            </header>
            <div style="font-size:14px;" id="mainTable">
                

            </div>
        </div>
    </main>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalTitle">新增帳戶</h4>
                </div>
                <div class="modal-body" id="myModalBody">

                </div>
            </div>
        </div>
    </div>
</body>

</html>