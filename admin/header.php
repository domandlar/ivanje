<!DOCTYPE html>
<html>
<head>
<title>Ivanje - Admin prijava</title>
<meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="../css/style.css" rel="stylesheet">
    <?php 
        $url = explode("/", $_SERVER['REQUEST_URI']);
        $stranica = explode("?", $url[sizeof($url)-1]);
        if($stranica[0] == "novi.php")
            echo "<link href='../css/novi.css' rel='stylesheet'>";
    ?>
</head>
<body>
	 <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
                <a class="navbar-brand" href="admin.php">Administracija</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="postavke.php">
                                <i class="fa fa-gear"></i> Postavke</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-user"></i> Profil </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                                <a class="dropdown-item waves-effect waves-light" href="profil.php?mod=moj">Moj račun</a>
                                <a class="dropdown-item waves-effect waves-light" href="odjava.php">Odjava</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>