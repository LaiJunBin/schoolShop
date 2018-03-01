<?php
    include_once('../pdoLink.php');
    $sql = 'update order_status set o_pay = :res where o_code = :code';
    $updatePay = $db->prepare($sql);
    $updatePay->bindValue(':res','T');
    $updatePay->bindValue(':code',$_POST['code']);
    $updatePay->execute();
    var_dump($updatePay);
?>