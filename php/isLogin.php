<?php
    if(!isset($_SESSION))
        session_start();
    if(isset($_SESSION['loginUser'])){
        echo "T";
    }else{
        echo "F";
    }
?>