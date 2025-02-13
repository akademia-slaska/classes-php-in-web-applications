<?php
include 'components/header.php';
require __DIR__ . '/users/users.php';


if (!isset($_POST['id'])) {
    include "components/not_found.php";
    exit;
}
$idUzytkownika = $_POST['id'];
usunUzytkownika($idUzytkownika);

header("Location: index.php");
