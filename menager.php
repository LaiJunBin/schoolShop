<?php
    session_start();
    include('./pdoLink.php');
    $login = $_SESSION['login'];
    $data = explode('_',$login);
    $id = $data[0];
    $key = $data[1];
    $selectSQL = 'select a_level from admin where a_id =:id and a_key = :key';
    $select = $db->prepare($selectSQL);
    $select->bindValue(':id',$id);
    $select->bindValue(':key',$key);
    $select -> execute();
    $result = $select->fetch(PDO::FETCH_ASSOC);
    $level = $result['a_level'];
    switch($level){
        case 'root':
            include('./menager/admin.php');
            break;
        default:
            echo 123;
            break;
    }
?>