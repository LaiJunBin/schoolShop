<table border="1" align="center" style="width:100%">
<?php
    include_once("../pdoLink.php");
    $result=$db->prepare("SELECT * FROM user");
    $result->execute();
    $recordEmpty=true;
    $n=0;
    while($record=$result->fetch(PDO::FETCH_ASSOC))
    {
        
        if($recordEmpty){ ?>
        <tr>
            <th>ID</th>
            <th>性別</th>
            <th>姓名</th>
            <th>科別</th>
            <th>帳號</th>
            <th width="20%">操作</th>
        </tr>
        <?php }
        $recordEmpty = false;
        $n++;
        echo "<tr>";
        echo "<td>".$n."</td>";
        echo "<td>".$record['u_gender']."</td>";
        echo "<td>".$record['u_name']."</td>";
        echo "<td>".$record['u_category']."</td>";
        echo "<td>".$record['u_username']."</td>";
        ?>
        <td width="20%">
            <a href="#" onclick="return checkDel('menager/deleteUser.php?id=<?php echo $record['u_id'];?>')">
                <button type="button" class="btn btn-danger">刪除帳戶</button>
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