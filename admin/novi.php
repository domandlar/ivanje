<?php
require '../php/autorizacija.php';

if(!isset($_COOKIE['SESIJA'])){
    header('Location: login.php');
}

if(isset($_POST['submit']) && isset($_POST['kategorija'])){
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
    if(isset($_FILES['naslovnaSlika'])){
        $slika = array();
        $slika['name'] = $_FILES['naslovnaSlika']['name'];
        $slika['tmp_name'] = $_FILES['naslovnaSlika']['tmp_name'];
        $slika['size'] = $_FILES['naslovnaSlika']['size'];
        spremiSliku($slika);
        $naslovnaSlika = "slike/" . $slika['name'];
    }
    
    $upit = "insert into sadrzaj (naslov, tekst, slika, kategorija, kreirano, autor, autor_alias) values
    ('$naziv', '$clanak', '$naslovnaSlika', '$kategorija', '$kreirano', '$autor', '$alias')";
    $db->selectDB($upit);
    $upit = "select id from sadrzaj order by 1 desc limit 1";
    $rezultat = $db->selectDB($upit);
    $clanak = mysqli_fetch_assoc($rezultat);
    $clanakID = $clanak['id'];

    if(isset($_FILES['slike'])){
        for($i = 0; $i < sizeof($_FILES['slike']['name']); $i++){
            $slika = array();
            $slika['name'] = $_FILES['slike']['name'][$i];
            $slika['tmp_name'] = $_FILES['slike']['tmp_name'][$i];
            $slika['size'] = $_FILES['slike']['size'][$i];
            spremiSliku($slika);
            $link = "slike/" . basename($slika["name"]);
            $upit = "insert into slike (clanak, link) values ('$clanakID', '$link')";
            $db->selectDB($upit);
        }

    }
    
    $db->zatvoriDB();
}
function spremiSliku($slika){//name, tmp_name, size
    $target_dir = "../slike/";
    $target_file = $target_dir . basename($slika["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
}
include './header.php';
?>
	<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-5">Dodaj novi članak</h2>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="novi.php" method="POST" enctype="multipart/form-data">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Naziv</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
				
                <!--Grid row-->
				<div class="row">
				
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="alias" name="alias" class="form-control">
                            <label for="email" class="">Alias</label>
                        </div>
                    </div>
                    <!--Grid column-->
				</div>
				<!--Grid row-->
				
				<!--Grid row-->
				<div class="row">
				
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <select name="kategorija" class="mdb-select">
								<option value="" disabled selected>Kategorija</option>
								<option value="1">Vijesti</option>
								<option value="2">Zanimljivosti</option>
								<option value="3">Ivanje</option>
								<option value="4">Planinarenje</option>
							</select>
                        </div>
                    </div>
                    <!--Grid column-->
				</div>
				<!--Grid row-->


                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="form-group mb-5">
							<label for="exampleFormControlTextarea1" class="">Napiši članak</label>
							<textarea name="clanak" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10"></textarea>
						</div>

                    </div>
                </div>
                <!--Grid row-->
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="form-group mb-5">
							<label for="naslovnaSlika" class="">Naslovna slika</label>
							<input type="file" name="naslovnaSlika" id="naslovnaSlika" >
						</div>

                    </div>
                </div>
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="form-group mb-5">
							<label for="slike" class="">Slike za galeriju</label>
                            <input type="file" name="slike[]" id="slike" multiple>
						</div>

                    </div>
                </div>
                
                <div class="text-center text-md-left">
                <button name="submit" type="submit" value="Submit" class="btn btn-primary">Objavi</button>
                </div>

            </form>

            
            <div class="status"></div>
        </div>
        <!--Grid column-->


    </div>
<!--Section: Contact v.2-->
	</main>
<?php include './footer.php';