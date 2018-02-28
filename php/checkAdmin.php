<?php
    if(!isset($_SESSION))
        session_start();
    if(empty($db))
        include_once('./pdoLink.php');
    if(!isset($_SESSION['login'])){
        if(isset($_POST['login']) && $_POST['login']==1)
            echo 'false';
        return false;
    }else{
        $data = explode('_',$_SESSION['login']);
        $sql = 'select * from admin where a_id = :id and a_key = :key';
        $select = $db->prepare($sql);
        $select->bindValue(':id',$data[0]);
        $select->bindValue(':key',$data[1]);
        $select->execute();
        $login = $select->fetch(PDO::FETCH_ASSOC);
        if(isset($_POST['login']) && $_POST['login']==1)
            echo ($login)?'true':'false';
        return $login;
    }
?>