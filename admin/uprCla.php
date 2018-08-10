<?php
include './header.php';
?>
<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-5">Upravljanje Korisnicima</h2>
    <div class="row">
      <div class="adminIkone">
      <button class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
      <button class="btn btn-primary waves-light" mdbTooltip="Tooltip on right" placement="top" mdbWavesEffect><i class="fa fa-pencil-square-o fa-lg mr-1"></i></button>
      <button class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      </div>
    </div>
    <table class="table table-hover tablica table-bordered">
    <thead class="teal accent-1">
      <tr>
        <th><!-- Ovo je gumb za oznacit sve clanke odjednom. Treba sredit u skripti ili nes-->
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="kor1">
            <label class="custom-control-label" for="kor1"></label>
          </div>
        </th>
        <th>Naziv</th>
        <th>Kategorija</th>
        <th>Kreirao</th>
        <th>Datum</th>
        <th>Br posjeta</th>
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
<?php include './footer.php';