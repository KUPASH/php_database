<?php
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'localhost_table'
    );
    $sql = 'SELECT * FROM tasks WHERE id=' . $id .'';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<form action="save.php">
    <input type="text" name="modified" value="<?=$row['text']?>">
    <input type="hidden" name="id" value="<?=$id?>">
    <button type="submit">Save</button>
</form>
</body>
</html>