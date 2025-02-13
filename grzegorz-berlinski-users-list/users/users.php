<?php

function pobierzUzytkownikow()
{
    static $uzytkownicy = null;
    if ($uzytkownicy === null) {
        $uzytkownicy = json_decode(file_get_contents(__DIR__ . '/uzytkownicy.json'), true);
    }
    return $uzytkownicy;
}

function pobierzUzytkownikaPoId($id)
{
    $uzytkownicy = pobierzUzytkownikow();
    return isset($uzytkownicy[$id]) ? $uzytkownicy[$id] : null;
}

function utworzUzytkownika($dane)
{
    $uzytkownicy = pobierzUzytkownikow();
    $id = mt_rand(1000000, 2000000);
    while (isset($uzytkownicy[$id])) {
        $id = mt_rand(1000000, 2000000);
    }
    $dane['id'] = $id;
    $uzytkownicy[$id] = $dane;
    zapiszJson($uzytkownicy);
    return $dane;
}

function aktualizujUzytkownika($dane, $id)
{
    $uzytkownicy = pobierzUzytkownikow();
    if (isset($uzytkownicy[$id])) {
        $uzytkownicy[$id] = array_merge($uzytkownicy[$id], $dane);
        zapiszJson($uzytkownicy);
        return $uzytkownicy[$id];
    }
    return [];
}

function usunUzytkownika($id)
{
    $uzytkownicy = pobierzUzytkownikow();
    if (isset($uzytkownicy[$id])) {
        unset($uzytkownicy[$id]);
        zapiszJson($uzytkownicy);
    }
}

function wgrajZdjecie($plik, $uzytkownik)
{
    if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['name']) {
        $katalogZdjec = __DIR__ . "/images";
        if (!is_dir($katalogZdjec)) {
            mkdir($katalogZdjec, 0755, true);
        }
        $rozszerzenie = pathinfo($plik['name'], PATHINFO_EXTENSION);
        $sciezkaDocelowa = $katalogZdjec . "/{$uzytkownik['id']}.$rozszerzenie";

        if (move_uploaded_file($plik['tmp_name'], $sciezkaDocelowa)) {
            $uzytkownik['rozszerzenie'] = $rozszerzenie;
            aktualizujUzytkownika($uzytkownik, $uzytkownik['id']);
        }
    }
}

function zapiszJson($uzytkownicy)
{
    file_put_contents(__DIR__ . '/uzytkownicy.json', json_encode($uzytkownicy, JSON_PRETTY_PRINT));
}

function zwalidujUzytkownika($uzytkownik, &$bledy)
{
    $bledy = [];
    if (empty($uzytkownik['imie'])) {
        $bledy['imie'] = 'Imię jest wymagane';
    }
    if (!empty($uzytkownik['email']) && !filter_var($uzytkownik['email'], FILTER_VALIDATE_EMAIL)) {
        $bledy['email'] = 'To musi być prawidłowy adres e-mail';
    }
    return empty($bledy);
}
