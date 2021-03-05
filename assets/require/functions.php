<?php

function geturl(){
    global $_SERVER;
    global $_SESSION;

    if ($_SESSION['actual_url'] !== $_SERVER['REQUEST_URI']){
        $_SESSION['info'] = null;
    }

    $_SESSION['actual_url'] = $_SERVER['REQUEST_URI'];
}

?>