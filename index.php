<?php 
session_start();
if(!isset($_SESSION['gestionnaire'])){
	header("location:login.php?non");
	exit;
}

		$db= new PDO("mysql:host=localhost;port=3307;dbname=bakkas","root","");
		$res=$db->query("select count(*) as nbr from produit");
		$prod=$res->fetch()['nbr'];		
		$res=$db->query("select count(*) as nbr from personne where type=1");
		$client=$res->fetch()['nbr'];	
		$res=$db->query("select count(*) as nbr from personne where type=0");
		$fournisseur=$res->fetch()['nbr'];	
		$res=$db->query("select count(*) as nbr from commande");
		$commande=$res->fetch()['nbr'];	
									

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="icon" type="image/png"  href="Gestion_st1.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<!-- <link rel="stylesheet"  href="https://bootswatch.com/5/solar/bootstrap.min.css"> -->

	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
		<link rel="stylesheet" type="text/css" href="font-awesome.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 	 
	   integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
	     crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
	  

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="Gestion1.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>90%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php include("header.php"); 
    include("right_side_bar.php");
    include("left_side_bar.php");
    ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue">M . <?= $_SESSION['logged'] ?>  !</div>
						</h4>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap  align-items-center">
							<div class="progress-data">
								<div class="">
									<img src="packaging.png" width="60px" height="60px" alt="">
								</div>
								
							</div>
							<div class="widget">

								<div class="h3 mb-0">
									<?= $prod;?>
								</div>
								<div class="weight-600 font-16">Produit</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div class="">
									<img src="photography.png" width="60px" height="60px" alt="">
								</div>
								
							</div>
							<div class="widget-data">
								<div class="h3 mb-0">
									<?= $commande;?>
									</div>
								<div class="weight-600 font-16">Commande</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div class="">
									<img src="client.png" width="60px" height="60px" alt="">
								</div>
															</div>
							<div class="widget-data">
								<div class="h3 mb-0"><?= $client;?></div>
								<div class="weight-600 font-16">Client</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div class="">
									<img src="vendor.png" width="60px" height="60px" alt="">
								</div>
															</div>
							<div class="widget-data">
								<div class="h3 mb-0"><?= $fournisseur;?></div>
								<div class="weight-600 font-16">Fournisseur</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				
			<div class="footer-wrap pd-20  mb-20 card-box" style="margin-top: 80px;">
				 Realisé Par <a href="#">EL GHABOURI & EL IDRISSI</a> 
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
</body>
</html>
