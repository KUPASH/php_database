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
            if(isset($_SESSION['id'])) {
                echo 'Hello ' . $user['login'] . '!';?>
                <form method="post">
                    Your new task: <input name="task">
                    <button type="submit">Create</button>
                </form>
                <a href="logout.php">Logout</a> </br>
                <?
                if(isset ($_POST['task'])) {
                    $task = $_POST['task'];
                    $conn1 = mysqli_connect(
                        'localhost',
                        'root',
                        '',
                        'localhost_table'
                    );
                    $sql2 = 'INSERT INTO tasks (text, user_id) VALUES ("'.$task.'",'.$user['id'].')';
                    if (mysqli_query($conn1, $sql2)) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn1);
                    }
                    mysqli_close($conn1);
                }

            } else {
                echo 'Something wrong';
            }
        } else {
            echo 'Wrong password!';
        }
    } else {
        echo 'Invalid login, please, sign up';
    }
}
?>