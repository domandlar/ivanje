<?php
require_once("baza.class.php");
header("Content-Type: application/json; charset=UTF-8");
$baza = new Baza();
$upit = 'select sadrzaj.id, naslov, tekst, kreirano, ime, prezime, autor_alias, slika from sadrzaj join administrator on autor = administrator.id order by 1 desc';
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);
$odgovor = array();
$odgovor = $rezultat->fetch_all(MYSQLI_ASSOC);


$baza->zatvoriDB();

echo json_encode($odgovor);

?>