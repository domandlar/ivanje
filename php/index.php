<?php
require_once("baza.class.php");
header("Content-Type: application/json; charset=UTF-8");
$baza = new Baza();
$br = $_GET['br'] * 2;
$upit = "select sadrzaj.id, naslov, tekst, kreirano, ime, prezime, autor_alias, slika from sadrzaj 
    join administrator on autor = administrator.id order by 1 desc limit 2 offset $br";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);
$clanci = array();
while($clanak = mysqli_fetch_assoc($rezultat)){
    $clanci[] = $clanak;
}


$baza->zatvoriDB();
echo json_encode($clanci);

?>