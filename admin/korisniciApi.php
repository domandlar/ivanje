<?php
include '../php/baza.class.php';
//header("Content-Type: application/json; charset=UTF-8");
switch($_GET['akcija']){
    case "sve":
        dohvatiKorisnike();
        break;
    case "novi":
        noviKorisnik();
        break;
    case "brisi":
        obrisiKorisnika();
        break;
    case "azuriraj":
        azuriranjeKorisnika();
        break;
}
function dohvatiKorisnike()
{
    $db = new Baza();
    $upit="select * from administrator";
    $db->spojiDB();
    $rezultat = $db->selectDB($upit);
    $korisnici = array();
    while($korisnik = mysqli_fetch_assoc($rezultat)){
        $korisnici[] = $korisnik;
    }
    echo json_encode($korisnici);
}
function noviKorisnik(){
    if(isset($_POST['submit'])){
        $greske = "";
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korIme = $_POST['korisnickoIme'];
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        $potvrdaLozinke = $_POST['potvrdaLozinke'];
        if(empty($ime))
            $greske .= "Nije unešeno ime";
        if(empty($prezime))
            $greske .= "Nije unešeno preime";
        if(empty($korIme))
            $greske .= "Nije unešeno korisničko ime";
        if(empty($email))
            $greske .= "Nije unen email";
        if(empty($lozinka))
            $greske .= "Nije unesena lozinka";
        if($lozinka!=$potvrdaLozinke)
            $greske .= "Lozinke se ne poklapaju.";
        if($greske == ""){
            $salt = hash('sha256', $korIme);
            $kriptiranaLozinka = hash('sha256',$salt . "---" . $lozinka);
            $upit="insert into administrator (ime, prezime, korisnicko_ime, email, lozinka) values ('$ime', '$prezime', '$korIme', '$email', '$kriptiranaLozinka')";
            $db = new Baza();
            $db->spojiDB();
            $db->selectDB($upit);
            $db->zatvoriDB();
            header('Location: uprKor.php');
            
        }
    }  
}
function azuriranjeKorisnika()
{
    if(isset($_POST['submit'])){
        $greske = "";
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korIme = $_POST['korisnickoIme'];
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        $potvrdaLozinke = $_POST['potvrdaLozinke'];
        $novaLozinka = $_POST['novaLozinka'];
        if(empty($ime))
            $greske .= "Nije unešeno ime";
        if(empty($prezime))
            $greske .= "Nije unešeno preime";
        if(empty($korIme))
            $greske .= "Nije unešeno korisničko ime";
        if(empty($email))
            $greske .= "Nije unen email";
        if($lozinka!=$potvrdaLozinke)
            $greske .= "Lozinke se ne poklapaju.";
        if($greske == ""){
            $korisnik = $_COOKIE['SESIJA'];
            $upit = "select id, lozinka from administrator where korisnicko_ime = '$korisnik'";
            $db = new Baza();
            $db->spojiDB();
            $rezultat = $db->selectDB($upit);
            $admin = mysqli_fetch_assoc($rezultat);
            $id = $admin['id'];
            if(!empty($lozinka)){
                $salt = hash('sha256', $korisnik);
                $kriptiranaLozinka = hash('sha256', $salt . "---" . $lozinka);
            }else
                $kriptiranaLozinka = $admin['lozinka'];
            if($kriptiranaLozinka == $admin['lozinka']){
                $lozinka = (empty($novaLozinka)) ? $lozinka : $novaLozinka;
                $salt = hash('sha256', $korIme);
                $kriptiranaLozinka = hash('sha256', $salt . "---" . $lozinka);
                $upit="update administrator set ime = '$ime', prezime = '$prezime', korisnicko_ime = '$korIme', email = '$email', lozinka = '$kriptiranaLozinka' where id = '$id'";
                $db->selectDB($upit);
                setcookie("SESIJA", $korIme);

            }
            $db->zatvoriDB();
            header("Location: profil.php?mod=moj");
            
        } else
            echo json_encode($greske);
    }  
}