<?php

require_once '../php/baza.class.php';
if(!isset($_COOKIE['SESIJA'])){
  header('Location: login.php');
}

$db = new Baza();
$upit = '';

include './header.php';
?>
<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive text-center my-5">Upravljanje člancima</h2>
    <div class="row">
      <div class="adminIkone">
      <a href="novi.php?mod=novi"><button class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i></button></a>
      <button id="azuriranje" class="btn btn-primary waves-light" mdbTooltip="Tooltip on right" placement="top" mdbWavesEffect><i class="fa fa-pencil-square-o fa-lg mr-1"></i></button>
      <button id="brisanje" class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      </div>

    </div>
    <div>
    <div class="row">
        <select name="kategorija" id="soflow">
          <option value="">Kategorija</option>
          <option value="1">Vijesti</option>
          <option value="2">Selo moje malo</option>
          <option value="3">Planinarenje</option>
          <option value="4">Zanimljivosti</option>
        </select>
        <label for="pocetak">Prikaz članaka od     </label>
        <input type="date" name="pocetak" id="pocetak" height="50px">
        <label for="kraj">Prikaz članaka do</label>
        <input type="date" name="kraj" id="kraj" class="datepicker">
      </div>
    </div>
    <div class="row container">
      <label for="">Redova po stranici</label>
      <select name="broj_redova" id="brRedova">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
      </select>
      <nav id="tab-nav">
            <ul>            
            </ul>
      </nav>
    </div>
    <table id="tablica" class="table table-hover tablica table-bordered">  
    <thead class="teal accent-1">
      <tr>
        <th><!-- Ovo je gumb za oznacit sve clanke odjednom. Treba sredit u skripti ili nes-->
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="kor1">
            <label class="custom-control-label" for="kor1"></label>
          </div>
        </th>
        <th class="zaglavlje-kolene">Naziv</th>
        <th class="zaglavlje-kolene">Kategorija</th>
        <th class="zaglavlje-kolene">Kreirao</th>
        <th class="zaglavlje-kolene">Datum</th>
        <th class="zaglavlje-kolene">Br posjeta</th>
      </tr>
    </thead>
    <tbody>
      <!--<tr>
      <td>
          
        </td>
      </tr>-->
      <tr>
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="cla1">
            <label class="custom-control-label" for="cla1"></label>
          </div>
        </td>
        <td class="font-weight-bold"><a href="#">Instruktori pozitivne geografije</a></td>
        <td>Selo moje malo</td>
        <td>Željko Tomac</td>
        <td>10.6.2010</td>
        <td>2594</td>
      </tr>
      <tr>
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="cla2">
            <label class="custom-control-label" for="cla2"></label>
          </div>
        </td>
        <td class="font-weight-bold"><a href="#">Krčmarskva Moskva</a></td>
        <td>Selo moje malo</td>
        <td>Željko Tomac</td>
        <td>11.6.2010</td>
        <td>2628</td>
      </tr>
    </tbody>
  </table>
</main>
<?php include './skripte.php';?>

<script type="text/javascript" src="./tablica.js"></script>
<script type="text/javascript" src="./uprCla.js"></script>
<?php include './footer.php';