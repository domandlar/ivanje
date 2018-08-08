<?php
require_once '../php/baza.class.php';
class Autorizacija {

    function jeLiAdministrator(){
        if(isset($_COOKIE['SESIJA'])){
            $korime = $_COOKIE['SESIJA'];
            $db = new Baza();
            $db->spojiDB();
            $upit = "select * from korisnik where korisnicko_ime = '$korime'";
            $rezultat = $db->selectDB($upit);
            if(mysqli_num_rows($rezultat)!=0){
                return true;
            }
        }
        else{
            return false;
        }
    }
    function jeLiModerator(){
        if(isset($_COOKIE['SESIJA'])){
            $korime = $_COOKIE['SESIJA'];
            $db = new Baza();
            $db->spojiDB();
            $upit = "select * from korisnik where korisnicko_ime = '$korime'";
            $rezultat = $db->selectDB($upit);
            if(mysqli_num_rows($rezultat)!=0){
                $korisnik = mysqli_fetch_assoc($rezultat);
                if($korisnik['uloga_id'] > 2){
                    $db->zatvoriDB();
                    return false;
                }
                else
                    return true;
            }
        }
        else{
            return false;
        }
    }
    function jeLiKorisnik(){
        if(isset($_COOKIE['SESIJA'])){
            return true;
        }
        else{
            return false;
        }
    }
    function tipKorisnika(){
        if(isset($_COOKIE['SESIJA'])){
            $korime = $_COOKIE['SESIJA'];
            $db = new Baza();
            $db->spojiDB();
            $upit = "select * from korisnik where korisnicko_ime = '$korime'";
            $rezultat = $db->selectDB($upit);
            if(mysqli_num_rows($rezultat)!=0){
                $korisnik = mysqli_fetch_assoc($rezultat);
                $db->zatvoriDB();
                return $korisnik['uloga_id'];
            }
        }
        else{
            return 0;
        }
    }
}