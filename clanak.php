<?php
require_once("php/baza.class.php");
$id = $_GET['clanak'];
$baza = new Baza();
$upit = "select clanak.id, naslov, uvodni_tekst, tekst, kreirano, ime, prezime, autor_alias, naslovna_slika, slike, broj_pregleda from clanak join administrator on autor = administrator.id where clanak.id = '$id'";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);
$upit = "select link from slike where clanak = '$id'";
$slikeRezultat = $baza->selectDB($upit);
$clanak = mysqli_fetch_assoc($rezultat);
$uvodniTekst = $clanak['uvodni_tekst'];
$tekst = $clanak['tekst'];
$galerija = "";
//Vađenje slika iz tablice u tekstu
if(preg_match("/<table/",$clanak['tekst'])){
    $brojSlika = substr_count($tekst,"<img");

    $pocetak = strpos($tekst, "<table");;
    $pomocniTekst = substr($tekst, $pocetak);;
    $galerija = "<div class='row lightboxSlike img-fluid mx-auto d-block'>";

    for($i=0; $i < $brojSlika; $i++){
        $pocetakSlike = strpos($pomocniTekst, "<img");
        $pocetakPutanjeSlike = $pocetakSlike + 10;
        $duljinaPutanjeSlike = strpos($pomocniTekst, ".jpg")-strpos($pomocniTekst, "<img")-6;
        $duljinaSlike = strpos($pomocniTekst, "\" />")-strpos($pomocniTekst, "<img") + 4;
        $putanjaSlike = substr($pomocniTekst,$pocetakPutanjeSlike, $duljinaPutanjeSlike);
        $staraSlika = substr($pomocniTekst, $pocetakSlike, $duljinaSlike);
        //TODO: dohvatit i ubacit figcaption
        if(!(preg_match("/<\/tbody>/", $putanjaSlike) || preg_match("/<\/table>/", $putanjaSlike)))
            $galerija .= "<a href='" . $putanjaSlike . "' data-lightbox='galerija'><img src='" . $putanjaSlike . "' height='' width='200'></a>";
        $pocetak = strpos($pomocniTekst, "\" />") + 4;
        $pomocniTekst = substr($pomocniTekst, $pocetak);
    }
    $galerija .= "</div>";
    $pomocniTekst = substr($tekst,strpos($tekst,"<table"),strpos($tekst,"</table>")+8);
    $tekst = str_replace($pomocniTekst, "{galerija}", $tekst);
}
//Slike u tekstu
$brojSlika = substr_count($tekst,"<img");
$pocetak = 0;
$pomocniTekst = $tekst;
for($i=0; $i < $brojSlika; $i++){
    $pomocniTekst = substr($pomocniTekst, $pocetak);
    $pocetakSlike = strpos($pomocniTekst, "<img");
    $pocetakPutanjeSlike = strpos($pomocniTekst, "src=")+5;
    $duljinaPutanjeSlike = strpos($pomocniTekst, ".jpg")+4-strpos($pomocniTekst, "src=")-5;
    $duljinaSlike = strpos($pomocniTekst, "\" />")-strpos($pomocniTekst, "<img")+4;
    $putanjaSlike = substr($pomocniTekst,$pocetakPutanjeSlike, $duljinaPutanjeSlike);
    $staraSlika = substr($pomocniTekst, $pocetakSlike, $duljinaSlike);
    $stil = substr($pomocniTekst, strpos($pomocniTekst, "style=")+7,12);
    if(!preg_match("/float/", $stil))
        $stil = "";      
    $novaSlika = "<div class='row lightboxSlike img-fluid mx-auto d-block'>";
    $novaSlika .= "<a href='" . $putanjaSlike . "' data-lightbox='galerija'><img src='" . $putanjaSlike . "' style='".$stil."' height='' width='300'></a>";
    $novaSlika .= "</div>";
    $tekst = str_replace($staraSlika, $novaSlika, $tekst);
    $pocetak = strpos($pomocniTekst, "\" />") + 4;
}
//Ubacivanje galerije umjesto tablice
$tekst = str_replace("{galerija}", "<br>" . $galerija, $tekst);

//Slike u uvodnom tekstu
$brojSlika = substr_count($uvodniTekst,"<img");
    $pocetak = 0;
    $pomocniTekst = $uvodniTekst;
    for($i=0; $i < $brojSlika; $i++){
        $pomocniTekst = substr($pomocniTekst, $pocetak);
        $pocetakSlike = strpos($pomocniTekst, "<img");
        $pocetakPutanjeSlike = strpos($pomocniTekst, "src=")+5;
        $duljinaPutanjeSlike = strpos($pomocniTekst, ".jpg")+4-strpos($pomocniTekst, "src=")-5;
        $duljinaSlike = strpos($pomocniTekst, "\" />")-strpos($pomocniTekst, "<img") + 4;
        $putanjaSlike = substr($pomocniTekst,$pocetakPutanjeSlike, $duljinaPutanjeSlike);
        $staraSlika = substr($pomocniTekst, $pocetakSlike, $duljinaSlike);
        $stil = substr($pomocniTekst, strpos($pomocniTekst, "style=")+7,12);
        if(!preg_match("/float/", $stil))
            $stil = ""; 
        $novaSlika = "<div class='row lightboxSlike img-fluid mx-auto d-block'>";
        $novaSlika .= "<a href='" . $putanjaSlike . "' data-lightbox='galerija'><img src='" . $putanjaSlike . "' style='".$stil."' height='' width='300'></a>";
        $novaSlika .= "</div>";
        $uvodniTekst = str_replace($staraSlika, $novaSlika, $uvodniTekst);
        $pocetak = strpos($pomocniTekst, "\" />") + 4;
    }
//Provjera i dohvaćanje galerije u uvondnom tekstu
if(preg_match('/{gallery/',$uvodniTekst)){
    $brojGalerija = substr_count($uvodniTekst,"{gallery");
    for($i=0; $i < $brojGalerija; $i++){
        $galerija = "{izbrisana galerija}";
        $pocetakGalerije = strpos($uvodniTekst, "{gallery");
        $pocetakPutanjeGalerije = $pocetakGalerije + 16;
        $duljinaPutanjeGalerije = strpos($uvodniTekst, "}")-strpos($uvodniTekst, "{gallery")-16;
        $putanjaGalerije = substr($uvodniTekst,$pocetakPutanjeGalerije,$duljinaPutanjeGalerije);
        $punaPutanjaGalerije = "./slike" . $putanjaGalerije . "/";
        if(file_exists($punaPutanjaGalerije)){
            $datoteke = scandir($punaPutanjaGalerije);
            unset($datoteke[0]);
            unset($datoteke[1]);
            $datoteke = array_values($datoteke);
            $galerija = "<div class='row lightboxSlike img-fluid mx-auto d-block'>";
            foreach($datoteke as $datoteka){
                $tipDatoteke = strtolower(pathinfo($datoteka, PATHINFO_EXTENSION));
                if($tipDatoteke != "html" && $tipDatoteke != ""){
                    $galerija .= "<a href='" . $punaPutanjaGalerije . $datoteka . "' data-lightbox='galerija'><img src='" . $punaPutanjaGalerije . $datoteka . "' height='' width='200'></a>";
                }
            }
            $galerija .= "</div>";
        }
        $uvodniTekst = str_replace("{gallery stories" . $putanjaGalerije . "}", $galerija, $uvodniTekst);
    }
}
/*if(preg_match('/src="/',$uvodniTekst)){
    $pocetakSlike = strpos($uvodniTekst, "src=");
    $pocetakPutanjeSlike = $pocetakSlike + 19;
    $duljinaPutanjeSlike = strpos($uvodniTekst, "\" />")-strpos($uvodniTekst, "src=")-19;
    $putanjaSlike = substr($uvodniTekst,$pocetakPutanjeSlike,$duljinaPutanjeSlike);
    $punaPutanjaSlike = "./slike" . $putanjaSlike;
    $uvodniTekst = str_replace("images/stories" . $putanjaSlike, $punaPutanjaSlike, $uvodniTekst);
}*/

//Provjera i dohvaćanje galerije u tekstu
if(preg_match('/{gallery/',$tekst)){
    $brojGalerija = substr_count($tekst,"{gallery");
    for($i=0; $i < $brojGalerija; $i++){
        $galerija = "{izbrisana galerija}";
        $pocetakGalerije = strpos($tekst, "{gallery");
        $pocetakPutanjeGalerije = $pocetakGalerije + 16;
        $duljinaPutanjeGalerije = strpos($tekst, "}")-strpos($tekst, "{gallery")-16;
        $putanjaGalerije = substr($tekst,$pocetakPutanjeGalerije,$duljinaPutanjeGalerije);
        $punaPutanjaGalerije = "./slike" . $putanjaGalerije . "/";
        if(file_exists($punaPutanjaGalerije)){
            $datoteke = scandir($punaPutanjaGalerije);
            unset($datoteke[0]);
            unset($datoteke[1]);
            $datoteke = array_values($datoteke);
            $galerija = "<div class='row lightboxSlike img-fluid mx-auto d-block'>";
            foreach($datoteke as $datoteka){
                $tipDatoteke = strtolower(pathinfo($datoteka, PATHINFO_EXTENSION));
                if($tipDatoteke != "html" && $tipDatoteke != ""){
                    $galerija .= "<a href='" . $punaPutanjaGalerije . $datoteka . "' data-lightbox='galerija'><img src='" . $punaPutanjaGalerije . $datoteka . "' height='' width='200'></a>";
                }
            }
            $galerija .= "</div>";
        }
        $tekst = str_replace("{gallery stories" . $putanjaGalerije . "}", $galerija, $tekst);
    }
}
//TODO: provijerit je li ovo opće potrebno
/*if(preg_match('/src="/',$tekst)){
    $pocetakSlike = strpos($tekst, "src=");
    $pocetakPutanjeSlike = $pocetakSlike + 19;
    $duljinaPutanjeSlike = strpos($tekst, "\" />")-strpos($tekst, "src=")-19;
    $putanjaSlike = substr($uvodniTekst,$pocetakPutanjeSlike,$duljinaPutanjeSlike);
    $punaPutanjaSlike = "./slike" . $putanjaSlike;
    $tekst = str_replace("images/stories" . $putanjaSlike, $punaPutanjaSlike, $tekst);
}*/
if(preg_match('/http:\/\/www.gornja-jelenska.net\/images\/stories/',$uvodniTekst)){
    $brojSlika = substr_count($uvodniTekst,"http://www.gornja-jelenska.net/images/stories");
    for($i=0; $i < $brojSlika; $i++){
        $uvodniTekst = str_replace("http://www.gornja-jelenska.net/images/stories", "./slike", $uvodniTekst);
    }
}
if(preg_match('/http:\/\/www.gornja-jelenska.net\/images\/stories/',$tekst)){
    $brojSlika = substr_count($tekst,"http://www.gornja-jelenska.net/images/stories");
    for($i=0; $i < $brojSlika; $i++){
        $tekst = str_replace("http://www.gornja-jelenska.net/images/stories", "./slike", $tekst);
    }
}
if(preg_match('/images\/stories/',$uvodniTekst)){
    $brojSlika = substr_count($uvodniTekst,"images/stories");
    for($i=0; $i < $brojSlika; $i++){
        $uvodniTekst = str_replace("images/stories", "./slike", $uvodniTekst);
    }
}
if(preg_match('/images\/stories/',$tekst)){
    $brojSlika = substr_count($tekst,"images/");
    for($i=0; $i < $brojSlika; $i++){
        $tekst = str_replace("images\/stories", "./slike", $tekst);
    }
}
if(preg_match('/images\//',$uvodniTekst)){
    $brojSlika = substr_count($uvodniTekst,"images/");
    for($i=0; $i < $brojSlika; $i++){
        $uvodniTekst = str_replace("images/", "./slike/", $uvodniTekst);
    }
}
if(preg_match('/images\//',$tekst)){
    $brojSlika = substr_count($tekst,"images/");
    for($i=0; $i < $brojSlika; $i++){
        $tekst = str_replace("images/", "./slike/", $tekst);
    }
}

//Traženje i dohvaćanje prve slike u tekstu ili galeriji i postavljanje za neslovnu sliku u slučaju kada naslovna slika nije zadana
if($clanak['naslovna_slika']==null || $clanak['naslovna_slika']==""){
    if(preg_match("/{gallery stories\/Vijesti(\/\w*)*}/",$clanak['uvodni_tekst'])){
        $pocetakGalerije = strpos($clanak['uvodni_tekst'], "{gallery");
        $pocetakPutanjeGalerije = $pocetakGalerije + 16;
        $duljinaPutanjeGalerije = strpos($clanak['uvodni_tekst'], "}")-strpos($clanak['uvodni_tekst'], "{gallery")-16;
        $putanjaGalerije = substr($clanak['uvodni_tekst'],$pocetakPutanjeGalerije,$duljinaPutanjeGalerije);
        $punaPutanjaGalerije = "./slike" . $putanjaGalerije . "/";
        if(file_exists($punaPutanjaGalerije)){
            $datoteke = scandir($punaPutanjaGalerije);
            $i=1;
            do{
                $tipDatoteke = strtolower(pathinfo($datoteke[++$i], PATHINFO_EXTENSION));
            }while($tipDatoteke == "html" || $tipDatoteke == "");
            $clanak['naslovna_slika'] = "slike" . $putanjaGalerije . "/" . $datoteke[$i];
        }       
    }else if(preg_match("/{gallery stories\/Vijesti(\/\w*)*}/",$clanak['tekst'])){
        $pocetakGalerije = strpos($clanak['tekst'], "{gallery");
        $pocetakPutanjeGalerije = $pocetakGalerije + 16;
        $duljinaPutanjeGalerije = strpos($clanak['tekst'], "}")-strpos($clanak['tekst'], "{gallery")-16;
        $putanjaGalerije = substr($clanak['tekst'],$pocetakPutanjeGalerije,$duljinaPutanjeGalerije);
        $punaPutanjaGalerije = "./slike" . $putanjaGalerije . "/";
        if(file_exists($punaPutanjaGalerije)){
            $datoteke = scandir($punaPutanjaGalerije);
            $i=1;
            do{
                $tipDatoteke = strtolower(pathinfo($datoteke[++$i], PATHINFO_EXTENSION));
            }while($tipDatoteke == "html" || $tipDatoteke == "");
            $clanak['naslovna_slika'] = "slike" . $putanjaGalerije . "/" . $datoteke[$i];
        }
    }
}
//Povećanje broja pregleda za jedan kod otvaranja članka
$brojPregleda = $clanak['broj_pregleda'] + 1;
$upit = "update clanak set broj_pregleda='$brojPregleda' where id='$id'";
$baza->selectDB($upit);
$baza->zatvoriDB();
//Slike u uvodnom tekstu

//$slike = explode("\n", $clanak['slike']);
//$sli = explode(".",$slike[0]);
//var_dump($sli);
//$tekst = str_replace("{mosimage}", "<a href='slike/" . $sli[0] . ".jpg' data-lightbox='galerija'><img src='slike/" . $sli[0] . ".jpg' height='' width='200'></a>", $tekst);
$godina = substr($clanak['kreirano'], 0, 4);
$mjesec = substr($clanak['kreirano'], 5, 2);
$dan = substr($clanak['kreirano'], 8, 2);
$datum = $dan . '/' . $mjesec . '/' . $godina;
$slike = array();
while($slika = mysqli_fetch_assoc($slikeRezultat))
    $slike[] = $slika;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Gornja Jelenska</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Lightbox -->
    <link rel="stylesheet" href="css/lightbox.min.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.svg"/>
</head>

<body>

    <!-- Start your project here-->
 <nav class="navbar navbar-expand-lg navbar-dark teal sticky-top">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="index.php">
	<img border="0" alt="Ivanje Logo" src="img/logo21.png" width="60px" height="auto">
	</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Naslovnica
                <span class="sr-only">(current)</span>
            </a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zanimljivosti</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="izPovijesti.php">Iz povijesti</a>
                <a class="dropdown-item" href="seloMojeMalo.php">Selo moje malo</a>
                <a class="dropdown-item" href="likovnik.php">Likovnik</a>
                <a class="dropdown-item" href="pismaCitatelja.php">Pisma čitatelja</a>
                <a class="dropdown-item" href="priceIzNasihZivota.php">Priče iz naših života</a>
            </div>
        </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ivanje</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="ciljevi.php">Ciljevi</a>
                <a class="dropdown-item" href="kontakt.php">Kontakt</a>
            </div>
        </li>
        
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Planinarenje</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="setnje.php">Šetnje</a>
                <a class="dropdown-item" href="izleti.php">Izleti</a>
                <a class="dropdown-item" href="najave.php">Najave</a>
            </div>
        </li>
        
        

    </ul>
    <!-- Links -->

</div>

</nav>
<!--/.Navbar-->

    
<section class="pt-5 mt-4 pb-3 container glavni">
    <!--Grid row-->
    <div class="row">
        <div class="col-xl-12 text-center">
            <h2 class="h1-responsive">
                <a><?php echo $clanak['naslov'] ?></a>
            </h2>
        </div>

        <div class="col-xl-12">
            <div class="view text-center clanakSlika mb-5">
            <?php if($clanak['naslovna_slika'] != null) echo "<img src='" . $clanak['naslovna_slika'] . "' alt='Naslovna slika' class='img-fluid'>";?>
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-3 col-sm-12 mb-3">
            <p>Napisao/la <a class="font-weight-bold"><?php if($clanak['autor_alias'] !='') echo $clanak['autor_alias']; else echo $clanak['ime'] . ' ' . $clanak['prezime'] ?></a>, <?php echo $datum?></p>
        </div>

        <div class="col-xl-9 col-md-9 col-sm-12">
        <p><?php echo $uvodniTekst . '<br>' . $tekst ?></p>
        </div>
    </div>

    
    <hr class="mb-5 mt-4">
	<div class="row lightboxSlike img-fluid mx-auto d-block">
    <?php
    foreach($slike as $slika){
        echo "<a href='" . $slika["link"] . "' data-lightbox='galerija'><img src='" . $slika["link"] . "' height='' width='200'></a>";
    }
    ?>
	</div>
</section>
<!--Section: Blog v.4-->
   
 
<!--Footer-->
<footer class="page-footer font-small teal pt-4 mt-4">



    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        Design: Domagoj Andlar i Lovro Pleše 
		© 2018 Copyright
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->
                      

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Lightbox-->
    <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"></script>
</body>

</html>
