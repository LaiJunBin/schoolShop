<?php
    include_once("../pdoLink.php");
    session_start();
    $result=$db->prepare("SELECT * FROM admin");
    $result->execute();
    $recordEmpty=true;
    $n=0;
    while($record=$result->fetch(PDO::FETCH_ASSOC))
    {
        
        if($recordEmpty){ ?>
        <tr>
        <th>ID</th>
        <th>職稱</th>
        <th>姓名</th>
        <th>電話</th>
        <!-- <th>帳號</th> -->
        <th width="20%">操作</th>
        <?php }
        $recordEmpty = false;
        $n++;
        echo "<tr>";
        echo "<td>".$n."</td>";
        echo "<td>".$record['a_level']."</td>";
        echo "<td>".$record['a_name']."</td>";
        echo "<td>".$record['a_phone']."</td>";
        // echo "<td>".$record['u_username']."</td>";
        ?>
        <td width="20%">
            <?php if($record['a_level']=='root' || $record['a_id'].'_'.$record['a_key'] == $_SESSION['login']){ ?>
                無法刪除
            <?php }else{ ?>
                <a href="#" onclick="return checkDel('menager/deleteAdmin.php?id=<?php echo $record['a_id'];?>')">
                    <button type="button">刪除帳戶</button>
                </a>
            <?php } ?>
        </td>
        <?php
        echo "</tr>";
    }
    if($recordEmpty){
        echo "沒有管理員";
    }
?>