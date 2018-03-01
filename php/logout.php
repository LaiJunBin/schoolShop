<?php
    if(!isset($_SESSION))
        session_start();
    session_destroy();
    echo "登出成功";
?>