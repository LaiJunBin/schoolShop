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
    <link rel="stylesheet" href="./main.css">
    <script>
        function checkDel(){
            if(confirm('確定刪除這個帳戶嗎?')){
                return true;
            }
            return false;
        }
    </script>
</head>

<body>
    <main class="container-fluid">
        <div id="userAdmin">
            <nav class="btn-group">
                <button class="btn btn-default">123</button>
                <button class="btn btn-default">123</button>
            </nav>
            <header>帳戶管理</header>
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
                            <th>操作</th>
                        <?php }
                        $recordEmpty = false;
                        echo "<tr>";
                        echo "<td width=10%>".$record['u_id']."</td>";
                        echo "<td>".$record['u_gender']."</td>";
                        echo "<td width=20%>".$record['u_name']."</td>";
                        echo "<td>".$record['u_category']."</td>";
                        echo "<td width=20%>".$record['u_username']."</td>";
                        ?>
                        <td>
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
</body>

</html>