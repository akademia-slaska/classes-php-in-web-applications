<?php
include "db.php";

$id = $_POST['task_id'];
$is_completed = $_POST['is_task_completed'] === 'on' ? 1 : 0;

$query = "UPDATE task SET is_completed=$is_completed WHERE id=$id";

$db->exec($query);

header("Location: index.php");