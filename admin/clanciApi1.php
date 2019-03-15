<?php
include '../php/baza.class.php';
//header("Content-Type: application/json; charset=UTF-8");
switch ($_GET['akcija']) {
    case 'sve':
        dohvatiSve();
        break;
    case 'brisi':
        obrisi();
        break;
    case 'novi':
        objaviNovi();
        break;
    case 'azuriraj':
        azuriraj();
        break;
    case 'filtriraj':
        filtriraj();
        break;
    case 'azurirajSlike':
        azurirajSlike();
        break;
}
function dohvatiSve()
{
    $db = new Baza();
    $db->spojiDB();
    $upit = "select clanak.id, naslov, kategorija.naziv kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak
    join administrator on administrator.id = clanak.autor join kategorija on kategorija.id = clanak.kategorija order by kreirano desc";
    $rezultat = $db->selectDB($upit);
    $clanci = array();
    while ($clanak = mysqli_fetch_assoc($rezultat)) {
        $clanci[] = $clanak;
    }
    $db->zatvoriDB();
    echo json_encode($clanci);
}
function obrisi()
{
    $db = new Baza();
    $db->spojiDB();
    $clkIDs = $_GET['clanci'];
    $clkIDs = explode(",", $clkIDs);
    foreach ($clkIDs as $clkID) {
        $upit = "select * from slike where clanak = '$clkID'";
        $slikeRezultat = $db->selectDB($upit);

        if (!empty($slikeRezultat)) {
            $slike = array();
            while ($slika = mysqli_fetch_assoc($slikeRezultat)) {
                $slike[] = $slika;
            }

            foreach ($slike as $slika) {
                $link = '../' . $slika['link'];
                unlink($link);
                $slkID = $slika['id'];
                $upit = "delete from slike where id = '$slkID'";
                $db->selectDB($upit);

            }
        }
        $upit = "select naslovna_slika from clanak where id='$clkID'";
        $rezultat = $db->selectDB($upit);
        $red = mysqli_fetch_assoc($rezultat);
        if($red['naslovna_slika'] != ""){
            $link = '../' . $red['naslovna_slika'];
            unlink($link);
        }
        $upit = "delete from clanak where id = '$clkID'";
        $db->selectDB($upit);
        //TODO: izbriši direktorij ako je prazan
    }
    $db->zatvoriDB();
    echo json_encode("");
}
function objaviNovi(){
    $naziv = $_POST['name'];
    $alias = $_POST['alias'];
    $kategorija = $_POST['kategorija'];
    $clanak = $_POST['clanak'];
    $db = new Baza();
    $autor = $_COOKIE['SESIJA'];
    $kreirano = date('Y:m:d H:i:s');
    $db->spojiDB();
    $upit = "select id from administrator where korisnicko_ime = '$autor'";
    $rezultat = $db->selectDB($upit);
    $autor = mysqli_fetch_assoc($rezultat);
    $autor = $autor['id'];
    $naslovnaSlika = null;
    if (isset($_FILES['naslovnaSlika'])) {
        if (!empty($_FILES['naslovnaSlika']['name'][0])) {
            $putanja = "../slike/Vijesti/" . date("Y/");
            if(!file_exists($putanja))
                mkdir($putanja);
            $putanja = "../slike/Vijesti/" . date("Y/Ym/");
            if(!file_exists($putanja))
                mkdir($putanja);
            $putanja = "../slike/Vijesti/" . date("Y/Ym/Ymd/");
            if(!file_exists($putanja))
                mkdir($putanja);
            $slika = array();
            $slika['name'] = $_FILES['naslovnaSlika']['name'];
            $slika['tmp_name'] = $_FILES['naslovnaSlika']['tmp_name'];
            $slika['size'] = $_FILES['naslovnaSlika']['size'];
            $nazivSlike = spremiSliku($slika, $putanja);
            $naslovnaSlika = "slike/Vijesti/" . date("Y/Ym/Ymd/") . $nazivSlike;
        }
    }

    $upit = "insert into clanak (naslov, tekst, naslovna_slika, kategorija, kreirano, autor, autor_alias) values
    ('$naziv', '$clanak', '$naslovnaSlika', '$kategorija', '$kreirano', '$autor', '$alias')";
    $db->selectDB($upit);
    $upit = "select id from clanak order by 1 desc limit 1";
    $rezultat = $db->selectDB($upit);
    $clanak = mysqli_fetch_assoc($rezultat);
    $clanakID = $clanak['id'];

    if (isset($_FILES['slike'])) {
        if (!empty($_FILES['slike']['name'][0])) {
            for ($i = 0; $i < sizeof($_FILES['slike']['name']); $i++) {
                $putanja = "../slike/Vijesti/" . date("Y/Ym/Ymd/");
                if(!file_exists($putanja))
                    mkdir($putanja);
                $slika = array();
                $slika['name'] = $_FILES['slike']['name'][$i];
                $slika['tmp_name'] = $_FILES['slike']['tmp_name'][$i];
                $slika['size'] = $_FILES['slike']['size'][$i];
                $nazivSlike = spremiSliku($slika, $putanja);
                $link = "slike/Vijesti/" . date("Y/Ym/Ymd/") . $nazivSlike;
                $upit = "insert into slike (clanak, link) values ('$clanakID', '$link')";
                $db->selectDB($upit);
            }
        }
    }

    $db->zatvoriDB();
    header("Location: uprCla.php");
}
function azuriraj(){
    $db = new Baza();
    $db->spojiDB();
    $id = $_POST['id'];
    $naslov = $_POST['name'];
    $alias = $_POST['alias'];
    $kategorija = $_POST['kategorija'];
    $tekst = $_POST['clanak'];
    $azurirano = date('Y:m:d H:i:s');
    $autor = $_COOKIE['SESIJA'];
    $kreirano = date('Y:m:d H:i:s');
    $db->spojiDB();
    $upit = "select id from administrator where korisnicko_ime = '$autor'";
    $rezultat = $db->selectDB($upit);
    $autor = mysqli_fetch_assoc($rezultat);
    $autor = $autor['id'];
    $upit = "select kreirano from clanak where id = '$id'";
    $rezultat = $db->selectDB($upit);
    $datumKreiranja = mysqli_fetch_assoc($rezultat);
    $datumIVrijeme = explode(" ", $datumKreiranja['kreirano']);
    $datum = explode("-", $datumIVrijeme[0]);
    $datumPutanja = $datum[0] . "/". $datum[0] . $datum[1] . "/" . $datum[0] . $datum[1] . $datum[2] . "/";
    $putanja = "../slike/Vijesti/" . $datumPutanja;
    if($_POST['promjenaNaslovneSlike']==true){
        if (isset($_FILES['naslovnaSlika'])) {
            if (!empty($_FILES['naslovnaSlika']['name'][0])) {
                $upit="select naslovna_slika from clanak where id='$id'";
                $rezultat=$db->selectDB($upit);
                $red= mysqli_fetch_assoc($rezultat);
                $link=$red['naslovna_slika'];
                if($link != null && $link!="")
                    unlink("../" . $link);
                $slika = array();
                $slika['name'] = $_FILES['naslovnaSlika']['name'];
                $slika['tmp_name'] = $_FILES['naslovnaSlika']['tmp_name'];
                $slika['size'] = $_FILES['naslovnaSlika']['size'];
                $naslovnaSlika = "slike/Vijesti/" . $datumPutanja . spremiSliku($slika, $putanja);
                $upit = "update clanak set naslov='$naslov', tekst='$tekst', naslovna_slika='$naslovnaSlika', kategorija='$kategorija', autor_alias='$alias', azurirano='$azurirano', azurirano_od='$autor' where id='$id'";
            }
        }
    }else
    $upit = "update clanak set naslov='$naslov', tekst='$tekst', kategorija='$kategorija', autor_alias='$alias', azurirano='$azurirano', azurirano_od='$autor' where id='$id'";
    $db->selectDB($upit);


    if (isset($_FILES['slike'])) {
        if (!empty($_FILES['slike']['name'][0])) {
            for ($i = 0; $i < sizeof($_FILES['slike']['name']); $i++) {
                $slika = array();
                $slika['name'] = $_FILES['slike']['name'][$i];
                $slika['tmp_name'] = $_FILES['slike']['tmp_name'][$i];
                $slika['size'] = $_FILES['slike']['size'][$i];
                $link = "slike/Vijesti/" . $datumPutanja . spremiSliku($slika, $putanja);
                $upit = "insert into slike (clanak, link) values ('$id', '$link')";
                $db->selectDB($upit);
            }
        }
    }

    $db->zatvoriDB();
    header("Location: uprCla.php");
}
function spremiSliku($slika, $direktorij)
{ //name, tmp_name, size
    $uniqueName = uniqid();
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($slika["name"], PATHINFO_EXTENSION));
    $uniqueName = $uniqueName . "." . $imageFileType;
    $target_file = $direktorij . $uniqueName;    
    //Provjera je li datoteka slika
    /*$check = getimagesize($slika["tmp_name"]);
    if($check !== false) {
    echo "Datoteka je slika - " . $check["mime"] . ".";
    $uploadOk = 1;
    } else {
    echo "Datoteka nije slika.";
    $uploadOk = 0;
    }*/
    //Provjera veličine slike
    /*if ($slika["size"] > 500000) {
    echo "Slika je prevelika.";
    $uploadOk = 0;
    }*/
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($slika["tmp_name"], $target_file)) {
            //echo "The file ". basename( $slika["name"]). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
    return $uniqueName;
}
function filtriraj(){
    $db = new Baza();
    $db->spojiDB();
    if(isset($_GET['kategorija'])){
        $kategorija = $_GET['kategorija'];
    }
    if(isset($_GET['pocetak'])){
        $pocetak = $_GET['pocetak'];
    }
    if(isset($_GET['kraj'])){
        $kraj = $_GET['kraj'];
    }
    if(isset($kategorija) && !isset($pocetak) && !isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor where kategorija = '$kategorija'";
    }
    else if(!isset($kategorija) && isset($pocetak) && !isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor where kreirano >= '$pocetak'";
    }
    else if(!isset($kategorija) && !isset($pocetak) && isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor where kreirano <= '$kraj'";
    }
    else if(isset($kategorija) && isset($pocetak) && !isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor where kategorija = '$kategorija' && kreirano >= '$pocetak'";
    }
    else if(isset($kategorija) && !isset($pocetak) && isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor where kategorija = '$kategorija' && kreirano <= '$kraj'";
    }
    else if(!isset($kategorija) && isset($pocetak) && isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor where kreirano >= '$pocetak' && kreirano <= '$kraj'";
    }
    else if(isset($kategorija) && isset($pocetak) && isset($kraj)){
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor  where kategorija = '$kategorija' && kreirano >= '$pocetak' && kreirano <= '$kraj'";
    }
    else
        $upit = "select clanak.id, naslov, kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak join administrator on administrator.id = clanak.autor";
    $rezultat = $db->selectDB($upit);
    $clanci = array();
    while ($clanak = mysqli_fetch_assoc($rezultat)) {
        $clanci[] = $clanak;
    }
    $db->zatvoriDB();
    echo json_encode($clanci);
}
function azurirajSlike()
{
    $slikeIds = explode(',', $_GET['slike']);
    $clanak = $_GET['clanak'];
    $db = new Baza();
    $db->spojiDB();
    $slike = array();
    foreach($slikeIds as $slikaId){
        $upit="select * from slike where id='$slikaId'";
        $rezultat = $db->selectDB($upit);
        $red = mysqli_fetch_assoc($rezultat);
        $slike[] = $red['link'];
    }
    foreach($slike as $slika){
        unlink("../" . $slika);
        $upit="delete from slike where link='$slika'";
        $db->selectDB($upit);
    }
    $upit="select * from slike where clanak='$clanak'";
    $rezultat = $db->selectDB($upit);
    $slike = array();
    while($slika = mysqli_fetch_assoc($rezultat)){
        $slike[] = $slika;
    }
    $db->zatvoriDB();
    echo json_encode($slike);
}