<?php
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
session_start();

if (isset($_GET['id'])) {
    $num_string = $_GET['id'];
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'localhost_table'
    );
    $sql = 'DELETE FROM tasks WHERE id=' . $num_string.'';
    mysqli_query($conn, $sql);

}
header('Location: createtask.php');