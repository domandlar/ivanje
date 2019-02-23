<?php
include 'header.php';
?>
<!--Section: Blog v.3-->
<!-- Section: Contact v.1 -->
<section class="my-5">

  <!-- Section heading -->
  <h2 class="h1-responsive text-center my-5">Kontakt</h2>

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-lg-5 mb-lg-0 mb-4">

      <!-- Form with header -->
      <div class="card">
        <div class="card-body">
          <!-- Header -->
          <div class="form-header">
            <h3 class="mt-2"><i class="fa fa-envelope"></i> Pišite nam:</h3>
          </div>
          <p class="dark-grey-text">Ako imate neko pitanje, pohvalu, kritiku ili bilo što drugo, javite nam se!</p>
          <!-- Body -->
          <div class="md-form">
            <i class="fa fa-user prefix grey-text"></i>
            <input type="text" id="form-name" class="form-control">
            <label for="form-name">Ime</label>
          </div>
          <div class="md-form">
            <i class="fa fa-envelope prefix grey-text"></i>
            <input type="text" id="form-email" class="form-control">
            <label for="form-email">Email</label>
          </div>
          <div class="md-form">
            <i class="fa fa-tag prefix grey-text"></i>
            <input type="text" id="form-Subject" class="form-control">
            <label for="form-Subject">Predmet</label>
          </div>
          <div class="md-form">
            <i class="fa fa-pencil-alt prefix grey-text"></i>
            <textarea type="text" id="form-text" class="form-control md-textarea" rows="3"></textarea>
            <label for="form-text">Poruka</label>
          </div>
          <div class="text-center">
            <button class="btn btn-light-blue">Pošalji</button>
          </div>
        </div>
      </div>
      <!-- Form with header -->

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-7">

      <!--Google map-->
      <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 500px">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44656.105395728104!2d16.662245542309105!3d45.61051160024507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476655eb6d09aa73%3A0x7212fe95d3b67369!2sGornja+Jelenska!5e0!3m2!1shr!2shr!4v1550691086063" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <!-- Buttons-->
      <div class="row text-center">
       
        
        <div class="col-md-12">
          <a class="btn-floating">
            <i class="fa fa-envelope"></i>
          </a>
          <p>info@ivanje.hr</p>
        </div>
      </div>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</section>
<!-- Section: Contact v.1 -->
   
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
    <script type="text/javascript" src="javascript/kontakt.js"></script>
</body>

</html>
