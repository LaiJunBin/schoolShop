<?php
    include('./pdoLink.php');
    $user = $_POST['username'];
    $category = $_POST['category'];
    $pass = $_POST['password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $sql = 'insert into user(u_username,u_password,u_category,u_phone,u_gender,u_name) ';
    $sql.= 'values(:user,:pass,:category,:phone,:gender,:name)';
    $query = $db->prepare($sql);
    $query->bindValue(':user',$user);
    $query->bindValue(':pass',$pass);
    $query->bindValue(':category',$category);
    $query->bindValue(':phone',$phone);
    $query->bindValue(':gender',$gender);
    $query->bindValue(':name',$name);
    $query->execute();
    echo "註冊成功";
?>