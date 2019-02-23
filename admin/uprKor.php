<?php
include './header.php';
?>
<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-5">Upravljanje Korisnicima</h2>
    <div class="row">
      <div class="adminIkone">
      <button id="novi" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i></button>
      <button class="btn btn-primary waves-light" mdbTooltip="Tooltip on right" placement="top" mdbWavesEffect><i class="fa fa-pencil-square-o fa-lg mr-1"></i></button>
      <button id="brisanje" class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
      </div>
    </div>
    <table id="tablica" class="table table-hover tablica">
    <thead class="teal accent-1">
      <tr>
        <th><!-- Ovo je gumb za oznacit sve korisnike odjednom. Treba sredit u skripti ili nes-->
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="kor1">
            <label class="custom-control-label" for="kor1"></label>
          </div>
        </th>
        <th>Ime</th>
        <th>Korisničko ime</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="kor1">
            <label class="custom-control-label" for="kor1"></label>
          </div>
        </td>
        <td class="font-weight-bold"><a href="uprKor.php">Stanislav Andlar</a></td>
        <td>andlar</td>
        <td>andlar@net4u.hr </td>
      </tr>
      <tr>
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="kor2">
            <label class="custom-control-label" for="kor2"></label>
          </div>
        </td>
        <td class="font-weight-bold"><a href="#">Željko Tomac</a></td>
        <td>zeljko</td>
        <td>zeljko.tomac@sk.htnet.hr</td>
      </tr>
    </tbody>
  </table>
</main>
<?php include './skripte.php';?>
<script type="text/javascript" src="./tablica.js"></script>
<script type="text/javascript" src="./uprKor.js"></script>
<?php include './footer.php';