<!DOCTYPE html>
<html>
<head>
    <title>Formularz Wyszukiwania Klienta</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="search">Wyszukaj Klienta:</label>
        <input type="text" id="search" name="search"><br>
        <input type="submit" value="Szukaj">
    </form>
    <?php
    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        //Połączenie z bazą danych
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "zaliczenie_bazy";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Wyszukiwanie danych w tabeli
        $sql = "SELECT * FROM Klienci WHERE Imie LIKE '%$search%' OR Nazwisko LIKE '%$search%' OR Adres LIKE '%$search%' OR Numer_telefonu LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Imie</th><th>Nazwisko</th><th>Adres</th><th>Numer telefonu</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Imie"]. "</td><td>" . $row["Nazwisko"]. "</td><td>" . $row["Adres"]. "</td><td>" . $row["Numer_telefonu"]. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Nie znaleziono żadnych wyników";
        }
        $conn->close();
    }
    ?>
</body>
</html>
