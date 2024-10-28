<?php

include "db.php";

$task = $_POST['new_task'];

$query = "INSERT INTO task (name) VALUES ('$task')";

$db->exec($query);

header("Location: index.php");
