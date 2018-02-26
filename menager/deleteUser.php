<?php
    include('../pdoLink.php');
    $sql ='delete from user where u_id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(':id',$_GET['id']);
    $query->execute();
    echo "<script>alert('刪除成功')</script>";
    echo "<script>history.go(-1)</script>";    
?>