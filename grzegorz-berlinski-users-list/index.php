<?php
require 'users/users.php';
$uzytkownicy = pobierzUzytkownikow();
include 'components/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Aplikacja PHP - Lista użytkowników</h2>
        <a class="btn btn-primary" href="create.php">
            <i class="fas fa-user-plus"></i> Utwórz nowego użytkownika
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Zdjęcie</th>
                    <th>Imię i nazwisko</th>
                    <th>E-mail</th>
                    <th>Strona internetowa</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($uzytkownicy as $uzytkownik): ?>
                    <tr>
                        <td>
                            <?php if (isset($uzytkownik['rozszerzenie'])): ?>
                                <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"
                                    src="<?php echo "users/images/${uzytkownik['id']}.${uzytkownik['rozszerzenie']}" ?>"
                                    alt="Zdjęcie użytkownika">
                            <?php else: ?>
                                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center"
                                    style="width: 50px; height: 50px;">
                                    <?php echo strtoupper(substr($uzytkownik['imie'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($uzytkownik['imie']) ?></td>
                        <td><?php echo htmlspecialchars($uzytkownik['email']) ?></td>
                        <td>
                            <a target="_blank" href="http://<?php echo htmlspecialchars($uzytkownik['strona_www']) ?>"
                                class="text-decoration-none">
                                <?php echo htmlspecialchars($uzytkownik['strona_www']) ?>
                            </a>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="view.php?id=<?php echo $uzytkownik['id'] ?>" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i> Podgląd
                                </a>
                                <a href="update.php?id=<?php echo $uzytkownik['id'] ?>"
                                    class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i> Aktualizuj
                                </a>
                                <form method="POST" action="delete.php" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $uzytkownik['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                                        <i class="fas fa-trash-alt"></i> Usuń
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'components/footer.php' ?>