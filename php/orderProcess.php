<?php
    include_once('./pdoLink.php');
    if(!isset($_SESSION))
        session_start();
    $sql = 'insert into order_table(o_user,o_code,o_item,o_price,o_amount,o_other,o_reserve) values (:user,:code,:item,:price,:amount,:other,:reserve)';
    $insertOrderPDO = $db->prepare($sql);
    $insertOrderPDO->bindValue(':user',$_SESSION['loginUser']);
    $insertOrderPDO->bindValue(':code',$_POST['code']);
    $insertOrderPDO->bindValue(':item',$_POST['item']);
    $insertOrderPDO->bindValue(':price',$_POST['price']);
    $insertOrderPDO->bindValue(':amount',$_POST['amount']);
    $insertOrderPDO->bindValue(':other',$_POST['other']);
    $insertOrderPDO->bindValue(':reserve',$_POST['reserve']);
    $insertOrderPDO->execute();
    $sql = 'insert into order_status(o_code) values(:code)';
    $insertOrderStatusPDO = $db->prepare($sql);
    $insertOrderStatusPDO->bindValue(':code',$_POST['code']);
    $insertOrderStatusPDO->execute();
?>