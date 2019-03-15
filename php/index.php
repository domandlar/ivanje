<?php
require_once("baza.class.php");
header("Content-Type: application/json; charset=UTF-8");
$baza = new Baza();
$br = $_GET['br'] * 10;
$stranica = $_GET['stranica'];
$baza->spojiDB();

if($stranica == "Vijesti")
    $upit = "select clanak.id, naslov, uvodni_tekst, tekst, kreirano, ime, prezime, autor_alias, naslovna_slika from clanak 
    join administrator on autor = administrator.id order by 5 desc limit 10 offset $br";
else
{
    $upit = "select id from kategorija where naziv = '$stranica'";
    $rezultat = $baza->selectDB($upit);
    $kategorija = mysqli_fetch_assoc($rezultat);
    $kategorijaId = $kategorija['id'];
    $upit = "select clanak.id, naslov,uvodni_tekst, tekst, kreirano, ime, prezime, autor_alias, naslovna_slika from clanak 
            join administrator on autor = administrator.id where kategorija = '$kategorijaId' order by 5 desc limit 10 offset $br";
}
    
$rezultat = $baza->selectDB($upit);
$clanci = array();
while($clanak = mysqli_fetch_assoc($rezultat)){
    $clanak['slika'] = "";
    if($clanak['naslovna_slika']==null || $clanak['naslovna_slika']==""){
        if(preg_match("/{gallery stories\/Vijesti(\/\w*)*}/",$clanak['uvodni_tekst'])){
            $pocetakGalerije = strpos($clanak['uvodni_tekst'], "{gallery");
            $pocetakPutanjeGalerije = $pocetakGalerije + 16;
            $duljinaPutanjeGalerije = strpos($clanak['uvodni_tekst'], "}")-strpos($clanak['uvodni_tekst'], "{gallery")-16;
            $putanjaGalerije = substr($clanak['uvodni_tekst'],$pocetakPutanjeGalerije,$duljinaPutanjeGalerije);
            $punaPutanjaGalerije = "../slike" . $putanjaGalerije . "/";
            if(file_exists($punaPutanjaGalerije)){
                $datoteke = scandir($punaPutanjaGalerije);
                $i=1;
                do{
                    $tipDatoteke = strtolower(pathinfo($datoteke[++$i], PATHINFO_EXTENSION));
                }while($tipDatoteke == "html" || $tipDatoteke == "");
                $clanak['slika'] = "slike" . $putanjaGalerije . "/" . $datoteke[$i];
            }
        }else if(preg_match("/{gallery stories\/Vijesti(\/\w*)*}/",$clanak['tekst'])){
            $pocetakGalerije = strpos($clanak['tekst'], "{gallery");
            $pocetakPutanjeGalerije = $pocetakGalerije + 16;
            $duljinaPutanjeGalerije = strpos($clanak['tekst'], "}")-strpos($clanak['tekst'], "{gallery")-16;
            $putanjaGalerije = substr($clanak['tekst'],$pocetakPutanjeGalerije,$duljinaPutanjeGalerije);
            $punaPutanjaGalerije = "../slike" . $putanjaGalerije . "/";
            if(file_exists($punaPutanjaGalerije)){
                $datoteke = scandir($punaPutanjaGalerije);
                $i=1;
                do{
                    $tipDatoteke = strtolower(pathinfo($datoteke[++$i], PATHINFO_EXTENSION));
                }while($tipDatoteke == "html" || $tipDatoteke == "");
                $clanak['slika'] = "slike" . $putanjaGalerije . "/" . $datoteke[$i];
            }
        }
    }
    $clanci[] = $clanak;
}
$baza->zatvoriDB();
echo json_encode($clanci);
//$rez = $kategorijaId . " " . $stranica;
//echo $rez;
?>