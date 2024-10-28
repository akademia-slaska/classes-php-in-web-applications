<?php
include 'db.php';

$id = $_GET['id'];

$query = "DELETE FROM task WHERE id=$id;";

$db->exec($query);

header("Location: index.php");