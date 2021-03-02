<?php

function send_log_walk()
{
    global $_SESSION;
    global $username;

    if (empty($_SESSION['username'])){
        $username = 'non_logged_user';
    }else{
        $username = $_SESSION['username'];
    }

    global $sql;
    global $stmt;
    global $pdo;
    global $url;
    global $_SERVER;

    $url = $_SERVER['HTTP_HOST'];

    $url.= $_SERVER['REQUEST_URI'];

    $sql = "INSERT INTO users_log (username, logged_in, ip, status) VALUES (:username, :logged_in, :ip, :status)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':logged_in', date("d-m-Y h:i:sa"));
    $stmt->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
    $stmt->bindValue(':status', $url);

    $stmt->execute();

}


function send_log_login(){

    global $sql;
    global $pdo;
    global $stmt;

    $sql = "INSERT INTO users_log (username, logged_in, ip, status) VALUES (:username, :logged_in, :ip, :status)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':username', $_SESSION['username']);
    $stmt->bindValue(':logged_in', $_SESSION['logged_in']);
    $stmt->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
    $stmt->bindValue(':status', 'connect');

    $stmt->execute();


}



?>