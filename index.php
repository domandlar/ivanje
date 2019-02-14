<!DOCTYPE html>
<html lang="hr-hr" xml:lang="hr-hr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
</head>

<body>

    <!-- Start your project here-->
    <!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark teal sticky-top">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="index.php">
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
                <a class="nav-link" href="index.php">Naslovnica
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Vijesti</a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zanimljivosti</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="izPovijesti.php">Iz povijesti</a>
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
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->


<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <!--First slide-->
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(130).jpg" alt="First slide">
        </div>
        <!--/First slide-->
        <!--Second slide-->
        <div class="carousel-item">
            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg" alt="Second slide">
        </div>
        <!--/Second slide-->
        <!--Third slide-->
        <div class="carousel-item">
            <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
        </div>
        <!--/Third slide-->
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
<!--Section: Blog v.3-->
<section class="py-4 container glavni">

    <!--Section heading-->
    <h2 class="h1 text-center mb-5">Novosti</h2>

    


</section>
<!--Section: Blog v.3-->
   
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

    <script type="text/javascript" src="javascript/skripta.js"></script>
    <script type="text/javascript" src="javascript/vijesti.js"></script>
</body>

</html>
