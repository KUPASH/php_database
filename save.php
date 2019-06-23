<?php
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
session_start();

if (isset($_GET['modified']) & isset($_GET['id'])) {
    $newline = $_GET['modified'];
    $id = $_GET['id'];
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'localhost_table'
    );
    $sql = 'UPDATE tasks SET text="' . $newline . '" WHERE id=' . $id . '';
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}
header('Location: createtask.php');