<?php
include "./helpers/db_conn.php";
include "./helpers/users.php";
include "./helpers/images.php";

session_start();

$id = $_GET["id"];

$row = getUserById($conn, $id);

if ($row && !empty($row['avatar'])) {
    deleteAvatar($row['avatar']);
}

$result = removeUser($conn, $id);

if ($result) {
    $_SESSION['msg'] = "Record deleted successfully!";
    header("Location: index.php");
} else {
    echo "Failed: " . mysqli_error($conn);
}
exit();
