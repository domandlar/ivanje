<?php
require_once('baza.class.php');
//require_once('error_handler.php');

class BazaP
{
    private $baza;

    function __constructor(){
        $this->baza = new Baza();
    }
    public function objaviClanak($naslov, $tekst, $autor, $kategorija){
        $naslov = $this->mysqli->mysql_real_escape_string($naslov);
        $tekst = $this->mysqli->mysql_real_escape_string($naslov);
        $autor = $this->mysqli->mysql_real_escape_string($naslov);
        $kategorija = $this->mysqli->mysql_real_escape_string($naslov);
        
        //treba kategoriju obradit
        $upit = 'insert into clanak (naslov, tekst, vrijeme, autor, kategorija) values
        ("' . $naslov . '", "' . $tekst . '", NOW(), "' . $autor . '","' . $kategorija . '" )';

        $rezultat = $this->mysqli->query($upit);
    }

    public function dohvatiClanke(){
        $upit = 'select * from clanak desc limit 10';
        $this->baza->spojiDB();
        $rezultat = $this->baza->selectDB($upit);
        $this->baza->close();
        $odgovor = '<?xml version="1.0" encoding="UTF-8" standalone"yes"?>';
        $odgovor .= '<response>';

        if($rezultat->num_rows){
            while($red = $rezultat->fetch_array(MYSQLI_ASSOC)){
                $id = $red['id'];
                $naslov = $red['naslov'];
                $tekst = $red['tekst'];
                $vrijeme = $red['vrijeme'];
                $autor = $red['autor'];
                $kategorija = $red['kategorija'];
                $rezultat .= '<id>' . $id . '</id>' .
                            '<naslov>' . $naslov . '</naslov>' .
                            '<tekst>' . $tekst . '</tekst>' .
                            '<vrijeme>' . $vrijeme . '</vrijeme>' .
                            '<autor>' . $autor . '</autorid>';
            }
            $rezultat->close();
        }
        $odgovor .= '</response>';
        return $odgovor;
    }
}




?>