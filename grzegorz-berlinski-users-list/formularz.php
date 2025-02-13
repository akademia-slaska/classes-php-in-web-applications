<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>
                <?php if ($uzytkownik['id']): ?>
                    Aktualizuj użytkownika <b><?php echo $uzytkownik['imie'] ?></b>
                <?php else: ?>
                    Utwórz nowego użytkownika
                <?php endif ?>
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label>Imię i nazwisko</label>
                    <input name="imie" value="<?php echo $uzytkownik['imie'] ?>"
                        class="form-control <?php echo $bledy['imie'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $bledy['imie'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input name="email" value="<?php echo $uzytkownik['email'] ?>"
                        class="form-control <?php echo $bledy['email'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $bledy['email'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Strona internetowa</label>
                    <input name="strona_www" value="<?php echo $uzytkownik['strona_www'] ?>"
                        class="form-control <?php echo $bledy['strona_www'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $bledy['strona_www'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Zdjęcie</label>
                    <input name="zdjecie" type="file" class="form-control-file">
                </div>
                <button class="btn btn-success">Zatwierdź</button>
            </form>
        </div>
    </div>
</div>