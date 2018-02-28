<?php
    include('../pdoLink.php');
    $sql ='delete from admin where a_id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(':id',$_GET['id']);
    $query->execute();
?> 