<?php
if(!isset($_COOKIE['SESIJA'])){
    header('Location: login.php');
}
include './header.php';
?>

	<main class="container main-admin">
		<div class="row">
			<div class="col-3">
				<div class="view overlay">
					<div class="box text-center teal accent-2">
					<i class="fa fa-sticky-note fa-4x " aria-hidden="true"></i>
					<i class="fa fa-plus-square-o fa-lg" aria-hidden="true"></i>
					<br>
					<span>Dodaj novi članak</span>
					</div>
					<a href="novi.php?mod=novi">
						<div class="mask flex-center rgba-black-light maska">
						</div>
					</a>
				</div>
			</div>
			
			<div class="col-3">
				<div class="view overlay">
					<div class="box text-center teal accent-2">
					<i class="fa fa-sticky-note fa-4x" aria-hidden="true"></i>
					<br>
					<span>Upravljanje članicima</span>
					</div>
					<a href="uprCla.php">
					<div class="mask flex-center rgba-black-light maska">
					</div>
					</a>
				</div>
			</div>
			<div class="col-3">
				<div class="view overlay">
					<div class="box text-center teal accent-2">
					<i class="fa fa-photo fa-4x" aria-hidden="true"></i>
					<br>
					<span>Upravljanje medijima</span>
					</div>
					<div class="mask flex-center rgba-black-light maska">
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="view overlay">
					<div class="box text-center teal accent-2">
					<i class="fa fa-users fa-4x" aria-hidden="true"></i>
					<br>
					<span>Upravljanje korisnicima</span>
					</div>
					<a href="uprKor.php">
					<div class="mask flex-center rgba-black-light maska">
					</div>
					</a>
				</div>
			</div>
				
		</div>
	</main>
<?php include './skripte.php';
include 'footer.php';