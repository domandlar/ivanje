<?php
if(!isset($_COOKIE['SESIJA'])){
    header('Location: login.php');
}
include './header.php';
?>
	<main class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-5">Moj profil</h2>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-12 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-5">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Ime</label>
                        </div>
                    </div>
                    <!--Grid column-->

             
				
                <!--Grid row-->
				
				
                    <!--Grid column-->
                    <div class="col-md-5">
                        <div class="md-form mb-0">
                            <input type="text" id="prezime" name="prezime" class="form-control">
                            <label for="surname" class="">Prezime</label>
                        </div>
                    </div>
                    <!--Grid column-->
				</div>
				<!--Grid row-->
				
				<div class="row">
					 <div class="col-md-5">
						<div class="md-form mb-0">
							<input type="password" class="form-control" id="lozinka" placeholder="Unesite lozinku">
						</div>
					</div>
				</div>
				
				<div class="row">
					 <div class="col-md-5">
						<div class="md-form mb-0">
							<input type="password" class="form-control" id="lozinka2" placeholder="Potvrdite lozinku">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-5"> 
						<div class="md-form mb-0">
							<input type="text" id="email" class="form-control">
							<label for="email">E-mail</label>
						</div>
					</div>
				</div>
                <!--Grid row-->
                
            </form>
				<div class="text-center text-md-left">
					<button type="submit" form="form1" value="Submit" class="btn btn-primary">Spremi</button>
				</div>
				<div class="status"></div>
        </div>
        <!--Grid column-->


    </div>
<!--Section: Contact v.2-->
	</main>
<?php include './footer.php';