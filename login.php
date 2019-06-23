<?php
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);

if (!empty($_POST['login']) && !empty($_POST['pass']) ) {
    $login = $_POST['login'];
    $password = $_POST['pass'];
    $sql = 'SELECT * FROM users WHERE login="' . $login . '"';
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'localhost_table'
    );
    $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    mysqli_close($conn);
    if(!empty($user)) {
        $salt = $user['salt'];
        $saltedPassword = md5($password.$salt);
        if($user['password'] == $saltedPassword) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            header('location: createtask.php');
        } else {
            echo 'Wrong password!';
        }
    } else {
        echo 'Invalid login, please, sign up';
    }
}