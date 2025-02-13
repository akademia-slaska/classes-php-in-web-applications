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

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="javascript:history.back()" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Wstecz
            </a>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Podgląd użytkownika: <b><?php echo $uzytkownik['imie'] ?></b></h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a class="btn btn-secondary mr-2" href="update.php?id=<?php echo $uzytkownik['id'] ?>">
                            <i class="fas fa-edit"></i> Aktualizuj
                        </a>
                        <form style="display: inline-block" method="POST" action="delete.php">
                            <input type="hidden" name="id" value="<?php echo $uzytkownik['id'] ?>">
                            <button class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Usuń
                            </button>
                        </form>
                    </div>
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th class="bg-light" style="width: 30%;">Imię i nazwisko:</th>
                                <td><?php echo $uzytkownik['imie'] ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">E-mail:</th>
                                <td><?php echo $uzytkownik['email'] ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Strona internetowa:</th>
                                <td>
                                    <a target="_blank" href="http://<?php echo $uzytkownik['strona_www'] ?>"
                                        class="text-primary">
                                        <?php echo $uzytkownik['strona_www'] ?>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'components/footer.php' ?>