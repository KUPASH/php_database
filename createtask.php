<?php
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['login'])) {
    echo 'Hello ' . $_SESSION['login'] . '!';?>
    <form method="post">
        Your new task: <input name="task">
        <button type="submit">Create</button>
    </form>
    <a href="logout.php">Logout</a> </br>
    <?
    if(isset ($_POST['task'])) {
        $task = $_POST['task'];
        $conn = mysqli_connect(
            'localhost',
            'root',
            '',
            'localhost_table'
        );
        $sql = 'INSERT INTO tasks (text, user_id) VALUES ("'.$task.'",'.$_SESSION['id'].')';
        mysqli_query($conn, $sql);
    }

    echo '<table border="1">';
    $sql = 'SELECT * FROM tasks WHERE user_id='.$_SESSION['id'].'';
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'localhost_table'
    );
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr><td>' . $row['text'] . '</td>
                  <td><a href="delete.php?id='.$row['id'].'">X</a></td>
                  <td><a href="modified.php?id='.$row['id'].'">Modified</a></td></tr>';

    };
    echo '</table>';
    mysqli_close($conn);
}