<?php
    include_once("../pdoLink.php");
    $result=$db->prepare("SELECT * FROM admin");
    $result->execute();
    $recordEmpty=true;
    echo "<tr>";
    while($record=$result->fetch(PDO::FETCH_ASSOC))
    {
        
        if($recordEmpty){ ?>
        <th>ID</th>
        <th>職稱</th>
        <th>姓名</th>
        <th>電話</th>
        <!-- <th>帳號</th> -->
        <th width="20%">操作</th>
        <?php }
        $recordEmpty = false;
        echo "<tr>";
        echo "<td>".$record['a_id']."</td>";
        echo "<td>".$record['a_level']."</td>";
        echo "<td>".$record['a_name']."</td>";
        echo "<td>".$record['a_phone']."</td>";
        // echo "<td>".$record['u_username']."</td>";
        ?>
        <td width="20%">
            <a href="menager/deleteAdmin.php?id=<?php echo $record['a_id'];?>" onclick="return checkDel()">
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