<?php
include 'components/header.php';
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include "components/not_found.php";
    exit;
}
$idUzytkownika = $_GET['id'];

$uzytkownik = pobierzUzytkownikaPoId($idUzytkownika);
if (!$uzytkownik) {
    include "components/not_found.php";
    exit;
}

$bledy = [
    'imie' => "",
    'email' => "",
    'strona_www' => "",
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uzytkownik = array_merge($uzytkownik, $_POST);

    $czyPoprawne = zwalidujUzytkownika($uzytkownik, $bledy);

    if ($czyPoprawne) {
        $uzytkownik = aktualizujUzytkownika($_POST, $idUzytkownika);
        wgrajZdjecie($_FILES['zdjecie'], $uzytkownik);
        header("Location: index.php");
    }
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="javascript:history.back()" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Wstecz
            </a>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Aktualizacja użytkownika: <?php echo $uzytkownik['imie'] ?></h3>
                </div>
                <div class="card-body">
                    <?php include 'formularz.php' ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'components/footer.php' ?>