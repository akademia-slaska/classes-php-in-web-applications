<?php
include 'components/header.php';
require __DIR__ . '/users/users.php';

$uzytkownik = [
    'id' => '',
    'imie' => '',
    'email' => '',
    'strona_www' => '',
];

$bledy = [
    'imie' => "",
    'email' => "",
    'strona_www' => "",
];
$czyPoprawne = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uzytkownik = array_merge($uzytkownik, $_POST);

    $czyPoprawne = zwalidujUzytkownika($uzytkownik, $bledy);

    if ($czyPoprawne) {
        $uzytkownik = utworzUzytkownika($_POST);

        wgrajZdjecie($_FILES['zdjecie'], $uzytkownik);

        header("Location: index.php");
    }
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="index.php" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Powrót do listy
            </a>
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Dodaj nowego użytkownika</h3>
                </div>
                <div class="card-body">
                    <?php include 'formularz.php' ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'components/footer.php' ?>