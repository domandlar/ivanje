<?php
require '../php/baza.class.php';

if (!isset($_COOKIE['SESIJA'])) {
    header('Location: login.php');
}
if ($_GET['mod'] == 'azuriranje') {
    $id = $_GET['id'];
    $db = new Baza();
    $db->spojiDB();
    $upit = "select clanak.id, naslov, naslovna_slika, autor_alias, uvodni_tekst, tekst, kategorija.id kategorija, administrator.ime ime, administrator.prezime prezime, kreirano, broj_pregleda from clanak
    join administrator on administrator.id = clanak.autor join kategorija on kategorija.id = clanak.kategorija where clanak.id='$id'";
    $rezultat = $db->selectDB($upit);
    $clanak = mysqli_fetch_assoc($rezultat);
    $upit = "select * from slike where clanak='$id'";
    $rezultat = $db->selectDB($upit);
    $slike = array();
    while($slika = mysqli_fetch_assoc($rezultat))
        $slike[] = $slika;
    $db->zatvoriDB();
}

include './header.php';
?>
	<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive  text-center my-5"><?php if ($_GET['mod'] == 'novi') {
    echo "Dodaj novi članak";
} else {
    echo "Ažuriraj članak";
}
?></h2>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action=<?php if ($_GET['mod'] == 'azuriranje') {
    echo "clanciApi.php?akcija=azuriraj";
} else {
    echo "clanciApi.php?akcija=novi";
}
?> method="POST" enctype="multipart/form-data">
                <?php if ($_GET['mod'] == 'azuriranje') {
    echo "<input type='text' name='id' value='$id' style='visibility:hidden'>";
}
?>
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control" <?php if ($_GET['mod'] == 'azuriranje') {
    echo "value='" . $clanak['naslov'] . "'";
}
?>>
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
                            <input type="text" id="alias" name="alias" class="form-control" <?php if ($_GET['mod'] == 'azuriranje') {
    echo "value='" . $clanak['autor_alias'] . "'";
}
?>>
                            <label for="email" class="">Alias</label>
                        </div>
                    </div>
                    <!--Grid column-->
				</div>
				<!--Grid row-->

				<!--Grid row-->
				<div class="row">

                    <!--Grid column-->
                    <div class="col-md-6" id="odabir">
                        <div class="md-form mb-0 ">
                            <select name="kategorija" id="soflow">
                            <option value="" hidden>Kategorija</option>
                            <option value="1" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 1) {
    echo "selected";
}
?>>Vijesti</option>
                            <optgroup label="Zanimljivosti">
                            <option value="2" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 2) {
    echo "selected";
}
?>>Iz povijesti</option>
                            <option value="3" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 3) {
    echo "selected";
}
?>>Selo moje malo</option>
                            <option value="4" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 4) {
    echo "selected";
}
?>>Likovnik</option>
                            <option value="5" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 5) {
    echo "selected";
}
?>>Pisma čitatelja</option>
                            <option value="6" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 6) {
    echo "selected";
}
?>>Priče iz naših života</option>
                            </optgroup>
                            <optgroup label="Ivanje">
                            <option value="7" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 7) {
    echo "selected";
}
?>>Ciljevi</option>
                            <option value="8" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 8) {
    echo "selected";
}
?>>Kontakt</option>
                            </optgroup>
                            <optgroup label="Planinarenje">
                            <option value="9" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 9) {
    echo "selected";
}
?>>Šetnje</option>
                            <option value="10" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 10) {
    echo "selected";
}
?>>Izleti</option>
                            <option value="11" <?php if ($_GET['mod'] == 'azuriranje' && $clanak['kategorija'] == 11) {
    echo "selected";
}
?>>Najave</option>
                            </optgroup>
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
							<textarea name="clanak" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" ><?php if ($_GET['mod'] == 'azuriranje') {
                            echo $clanak['tekst'];
}
?></textarea>
						</div>

                    </div>
                </div>
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="form-group mb-5">
							<label for="naslovnaSlika" class="">Naslovna slika</label>
                            <input type="file" name="naslovnaSlika" id="naslovnaSlika">
                            <input type="checkbox" name="promjenaNaslovneSlike" id="promjenaNaslovneSlike" style="display: none">
						</div>

                    </div>
                </div>
                 <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="form-group mb-5">
                            <div id="prikazNaslovneSlike">
                            <?php if($_GET['mod']=='azuriranje' && !empty($clanak['naslovna_slika'])) 
                                    echo "<ul><li><input type='checkbox' id='ns' />
                                    <label for='ns'><img src='../" . $clanak['naslovna_slika'] ."'/></label></li></ul>"; ?>
                            </div>
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
                 <!--Grid row-->
                 <div class="row">
                    <!--Grid column-->
                    <div class="col-md-12">
    
                        <div class="form-group mb-5">
                            <div id="prikazStarihSlika">
                                <ul>
                            <?php if($_GET['mod']=='azuriranje' && !empty($slike)) 
                                    foreach($slike as $slika)
                                        echo "<li><input type='checkbox' id=" . $slika['id'] . " />
                                        <label for=" . $slika['id'] . "><img src='../" . $slika['link'] ."'/></label></li>"; ?>
                                </ul>
                                <?php if($_GET['mod']=='azuriranje' && !empty($slike)) 
                                        echo "<button type='button' id='obrisiSlike'>Oriši odabrane slike</button>"; ?>
                            </div>
                            <div id="prikazNovihSlika">
                                
                            </div>
                        </div>
    
                    </div>
                </div>

                <div class="text-center text-md-left">
                <button name="submit" type="submit" value="Submit" class="btn btn-primary ">Objavi</button>
                </div>

            </form>


            <div class="status"></div>
        </div>
        <!--Grid column-->


    </div>
<!--Section: Contact v.2-->
	</main>

<?php include './skripte.php';?>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script type="text/javascript" src="./novi.js"></script>
<?php include './footer.php';