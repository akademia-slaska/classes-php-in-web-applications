<!DOCTYPE html>
<html>
<head>
    <title>Formularz Dodawania Klienta</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="imie">Imie:</label>
        <input type="text" id="imie" name="imie"><br>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko"><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres"><br>

        <label for="numer_telefonu">Numer telefonu:</label>
        <input type="text" id="numer_telefonu" name="numer_telefonu"><br>

        <label for="klient_id">ID Klienta:</label>
        <input type="text" id="klient_id" name="klient_id"><br>

        <input type="submit" value="Dodaj">
    </form>
    <?php
    if (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['adres']) && isset($_POST['numer_telefonu'])) {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $adres = $_POST['adres'];
        $numer_telefonu = $_POST['numer_telefonu'];
        $klient_id = $_POST['klient_id'];

        //Połączenie z bazą danych
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "zaliczenie_bazy";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Dodawanie danych do tabeli
        $sql = "INSERT INTO Klienci (Imie, Nazwisko, Adres, Numer_telefonu, KlientID)
        VALUES ('$imie', '$nazwisko', '$adres', '$numer_telefonu', '$klient_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały pomyślnie dodane";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
