<?php
require_once("php/baza.class.php");
$id = $_GET['clanak'];
$baza = new Baza();
$upit = "select sadrzaj.id, naslov, tekst, kreirano, ime, prezime, autor_alias, slika from sadrzaj join administrator on autor = administrator.id where sadrzaj.id = '$id'";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);
$upit = "select link from slike where clanak = '$id'";
$slikeRezultat = $baza->selectDB($upit);
$clanak = mysqli_fetch_assoc($rezultat);
$tekst = $clanak['tekst'];
$baza->zatvoriDB();

for($i=0; $i < strlen($tekst); $i++){
    
    if(ord($tekst[$i])==10)
       $tekst = substr_replace($tekst,'<br>', $i, 1);
    elseif(ord($tekst[$i])==9)
        $tekst = substr_replace($tekst,'&nbsp;&nbsp;&nbsp;&nbsp;', $i, 1);
}
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

</head>

<body>

    <!-- Start your project here-->
 <nav class="navbar navbar-expand-lg navbar-dark teal sticky-top">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="index.html">
	<img border="0" alt="Ivanje Logo" src="img/logo2.png" width="60px" height="auto">
	</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">Naslovnica
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zanimljivosti</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Iz povijesti</a>
                    <a class="dropdown-item" href="#">Likovnik</a>
                    <a class="dropdown-item" href="#">Pisma čitatelja</a>
					<a class="dropdown-item" href="#">Priče iz naših života</a>
                </div>
            </li>

			  <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ivanje</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Ciljevi</a>
                    <a class="dropdown-item" href="#">Kontakt</a>
                </div>
            </li>
			
			   <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Planinarenje</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Šetnje</a>
                    <a class="dropdown-item" href="#">Izleti</a>
                    <a class="dropdown-item" href="#">Najave</a>
                </div>
            </li>
			
            

        </ul>
        <!-- Links -->

    </div>
    <!-- Collapsible content -->

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
                    <img src="<?php echo $clanak['slika']?>" alt="Wide sample post image" class="img-fluid">
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-3 col-sm-12 mb-3">
            <p>Napisao/la <a class="font-weight-bold"><?php echo $clanak['ime'] . ' ' . $clanak['prezime'] ?></a>, <?php echo $datum?></p>
        </div>

        <div class="col-xl-9 col-md-9 col-sm-12">
        <p><?php echo $tekst ?></p>
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
