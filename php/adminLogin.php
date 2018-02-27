<?php
    session_start();
    include('./pdoLink.php');
    $select = $db->prepare('select * from admin where a_username =:username and a_password = :password');
    $select->bindValue(':username',$_POST['username']);
    $select->bindValue(':password',$_POST['password']);
    $select->execute();
    $login = $select->fetch(PDO::FETCH_ASSOC);
    if($login){
        $_SESSION['login']=$login['a_id'].'_'.$login['a_key'];
        echo 'success';
    }
?>