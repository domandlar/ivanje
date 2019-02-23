<?php
if(!isset($_COOKIE['SESIJA'])){
    header('Location: login.php');
}
include '../php/baza.class.php';
if($_GET['mod']=='moj'){
    $db = new Baza();
    $db->spojiDB();
    $admin = $_COOKIE['SESIJA'];
    $upit = "select ime, prezime, korisnicko_ime, email from administrator where korisnicko_ime='$admin'";
    $rezultat = $db->selectDB($upit);
    $korisnik = mysqli_fetch_assoc($rezultat);
}

include './header.php';
?>
	<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-5"><?php if(isset($_GET['mod'])) if($_GET['mod'] == "moj") echo "Moj profil"; else echo "Novi admin" ?></h2>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-12 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="<?php if($_GET['mod']=="moj") echo "korisniciApi.php?akcija=azuriraj"; else echo "korisniciApi.php?akcija=novi"; ?>" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-5">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="ime" class="form-control" <?php if($_GET['mod']=='moj') echo "value='" . $korisnik['ime'] . "' " ?>>
                            <label for="name" class="">Ime</label>
                        </div>
                    </div>
                    <!--Grid column-->

             
				
                <!--Grid row-->
				
				
                    <!--Grid column-->
                    <div class="col-md-5">
                        <div class="md-form mb-0">
                            <input type="text" id="prezime" name="prezime" class="form-control" <?php if($_GET['mod']=='moj') echo "value='" . $korisnik['prezime'] . "' " ?>>
                            <label for="surname" class="">Prezime</label>
                        </div>
                    </div>
                    <!--Grid column-->
				</div>
				<!--Grid row-->
				<div class="row">
					<div class="col-md-5"> 
						<div class="md-form mb-0">
							<input type="text" id="korIme" name="korisnickoIme" class="form-control" <?php if($_GET['mod']=='moj') echo "value='" . $korisnik['korisnicko_ime'] . "' " ?>>
							<label for="korIme">Korisničko ime</label>
						</div>
                    </div>
                    <div class="col-md-5"> 
						<div class="md-form mb-0">
							<input type="text" id="email" name="email" class="form-control" <?php if($_GET['mod']=='moj') echo "value='" . $korisnik['email'] . "' " ?>>
							<label for="email">E-mail</label>
						</div>
					</div>
				</div>
				<div class="row">
					 <div class="col-md-5">
						<div class="md-form mb-0">
							<input type="password" class="form-control" name="lozinka" id="lozinka" placeholder="Unesite lozinku">
						</div>
                    </div>
                    <div class="col-md-5">
						<div class="md-form mb-0">
							<input type="password" class="form-control" name="potvrdaLozinke" id="lozinka2" placeholder="Potvrdite lozinku">
						</div>
					</div>
				</div>
                <?php if($_GET['mod'] == 'moj')
                        echo "<div class='row'>
					            <div class='col-md-5'>
						            <div class='md-form mb-0'>
							            <input type='password' class='form-control' name='novaLozinka' id='lozinka3' placeholder='Nova Lozinka'>
						            </div>
					            </div>
				            </div>";
				?>
                <!--Grid row-->
                
            </form>
				<div class="text-center text-md-left">
					<button type="submit" form="contact-form" name="submit" value="Submit" class="btn btn-primary">Spremi</button>
				</div>
				<div class="status"></div>
        </div>
        <!--Grid column-->


    </div>
<!--Section: Contact v.2-->
	</main>
<?php include './footer.php';