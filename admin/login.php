<?php
/*
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}*/
require_once '../php/baza.class.php';
if(isset($_COOKIE['SESIJA'])){
    header('Location: admin.php');
}
if(isset($_POST['submit'])){
    $korime = $_POST['korime'];
    $lozinka = $_POST['lozinka'];
    $db = new Baza();
    $db->spojiDB();
    $upit = "select * from administrator where korisnicko_ime = '$korime'";
    $rezultat = $db->selectDB($upit);
    if(mysqli_num_rows($rezultat)==0){
        $greska = 'Nepostojeći korisnik';
    }
    else{
        $korisnik = mysqli_fetch_assoc($rezultat);       
        $salt = hash('sha256',$korime);
        $kriptiranaLozinka = hash('sha256',$salt . "---" . $lozinka);
        if($korisnik['lozinka'] == $kriptiranaLozinka){
            setcookie('SESIJA', $korime);
            $db->zatvoriDB();
            header('Location: admin.php');
        }
        else{
            $greska = 'Kriva lozinka.';           
        }
    }
}
?>
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
</head>
<body>
	<div class="login container">
		<h1>Administracijska prijava</h1>
		<form method="post">
            <p class="h4 text-center mb-4">Ulogirajte se</p>

            <!-- Default input email -->
            <label for="FormLoginIme" class="grey-text">Vaše ime</label>
            <input name="korime" type="text" id="defaultFormLoginEmailEx" class="form-control">

            <br>

            <!-- Default input password -->
            <label for="FormLoginLozinka" class="grey-text">Vaša lozinka</label>
            <input name="lozinka" type="password" id="defaultFormLoginPasswordEx" class="form-control">

            <div class="text-center mt-4">
                <button class="btn btn-indigo" type="submit" name="submit">Prijava</button>
            </div>
        </form>
	</div>
<!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    <script type="text/javascript" src="../skripta.js"></script>
</body>
</html>