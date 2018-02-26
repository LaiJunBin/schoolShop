<?php
    include('./pdoLink.php');
    $user = $_POST['username'];
    $category = $_POST['category'];
    $pass = $_POST['password'];
    $pass2 = $_POST['passwordAgain'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    if($pass == $pass2){
        $sql = 'insert into user(u_username,u_password,u_category,u_phone,u_gender) ';
        $sql.= 'values(:user,:pass,:category,:phone,:gender)';
        $query = $db->prepare($sql);
        $query->bindValue(':user',$user);
        $query->bindValue(':pass',$pass);
        $query->bindValue(':category',$category);
        $query->bindValue(':phone',$phone);
        $query->bindValue(':gender',$gender);
        $query->execute();
        echo "<script>alert('註冊成功!')</script>";
        echo "<script>location.href='index.html'</script>";
    }else{
        echo "<script>alert('兩次密碼輸入的不一樣!')</script>";
        echo "<script>location.href='registr.html'</script>";
    }
    
?>