<?php
    session_start();
    include('./pdoLink.php');
    $select = $db->prepare('select * from user where u_username =:username and u_password = :password');
    $select->bindValue(':username',$_POST['username']);
    $select->bindValue(':password',$_POST['password']);
    $select->execute();
    $login = $select->fetch(PDO::FETCH_ASSOC);
    if($login){
        $_SESSION['login']=$login['u_username'];
        header('location:./order.php');
    }
?>