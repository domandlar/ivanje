<?php
require_once("baza.class.php");
header("Content-Type: application/json; charset=UTF-8");
$baza = new Baza();
$br = $_GET['br'] * 10;
$stranica = $_GET['stranica'];
$baza->spojiDB();

$stranica = "Vijesti";
if($stranica == "Vijesti")
    $upit = "select clanak.id, naslov, uvodni_tekst, tekst, kreirano, ime, prezime, autor_alias, naslovna_slika from clanak 
    join administrator on autor = administrator.id order by 5 desc limit 10 offset $br";
    //$upit = "select id, title, fulltext, created, creted_by, modified_by, created_by_alias, hits from jos_conted"; 
    //$upit = "select * from jos_content";
else
{
    $upit = "select id from kategorija where naziv = '$stranica'";
    $rezultat = $baza->selectDB($upit);
    $kategorija = mysqli_fetch_assoc($rezultat);
    $kategorijaId = $kategorija['id'];
    $upit = "select clanak.id, naslov, tekst, kreirano, ime, prezime, autor_alias, naslovna_slika from clanak 
            join administrator on autor = administrator.id where kategorija = '$kategorijaId' order by 1 desc limit 2 offset $br";
}
    
$rezultat = $baza->selectDB($upit);
$clanci = array();
while($clanak = mysqli_fetch_assoc($rezultat)){
    $clanci[] = $clanak;
}

$baza->zatvoriDB();
echo json_encode($clanci);

?>