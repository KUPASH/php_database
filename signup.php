<?php
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
function generateSalt() {
    $salt = '';
    $saltLength = 8;
    for($i=0; $i<$saltLength; $i++) {
        $salt .= chr(mt_rand(33,126));
    }
    return $salt;
}

if ( !empty($_POST['login']) && !empty($_POST['pass']) ) {
    $login = $_POST['login'];
    $password = $_POST['pass'];
    $sql = 'SELECT * FROM users WHERE login="'.$login.'"';
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'localhost_table'
    );
    $isLoginFree = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if (empty($isLoginFree)) {
        $salt = generateSalt();
        $saltedPassword = md5($password.$salt);
        $sql = 'INSERT INTO `users` (`login`, `password`, `salt`) VALUES ("'.$login.'","'.$saltedPassword.'","'.$salt.'")';
        mysqli_query($conn, $sql);
        echo 'You are successfully registered! Now, please, log in the site.';
    } else {
        echo 'This login is already taken!';
    }
} else {
    echo 'Fields cannot be empty';
}
