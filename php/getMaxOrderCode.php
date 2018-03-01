<?php
    include_once('./pdoLink.php');
    $sql = 'select max(o_code) from order_table';
    $maxCodePDO = $db->prepare($sql);
    $maxCodePDO->execute();
    $maxCode = $maxCodePDO->fetch(PDO::FETCH_NUM);
    echo $maxCode[0];
?>