<?php 
session_start();
if(!isset($_SESSION['logged'])){
	header("location:login.php?non");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>
<style>
	.form-group{
		width:85%;
		margin:auto;
	}
</style>
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
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
    <?php include("header.php"); 
    include("right_side_bar.php");
    include("left_side_bar.php");
    ?>
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					
							
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">A propos!</a>
										</li>
										
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#setting" role="tab">Modifier</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
												<div class="profile-timeline">
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								
								<img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="vendors/images/photo2.jpg" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0">Mr.<?php echo $_SESSION['logged']?></h5>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Informations personnel</h5>
								<?php
								include("dao.php");
								foreach(DOA::get_admin($_SESSION['id']) as $result){
								?>
								<ul>
									<li>
										<span>Nom:</span>
										<?php echo $result['nom']?>
									</li>
									<li>
										<span>Prenom:</span>
										<?php echo $result['prenom']?>
									</li>
									<li>
										<span>Fonctionnalité:</span>
										<?php if($result['type']==0) echo "Gestion de Stock";
										else echo "Caissier"
										?>
									</li>
									<li>
										<span>Adresse Personnel:</span>
										<?php echo $result['adresse']?>
									</li>
									<li>
										<span>Adresse Email:</span>
										<?php echo $result['email']?>
									</li>
									<li>
										<span>Telephone:</span>
										<?php echo $result['Telephone']?>
									</li>
								</ul>
							</div>
								</div>
					</div></div>
											</div>
										</div>
										<!-- Timeline Tab End -->
										<!-- Tasks Tab start -->
										<div class="tab-pane fade" id="tasks" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<!-- Open Task start -->
													
													<!-- Open Task End -->
													<!-- Close Task start -->
													<!-- Close Task start -->
													<!-- add task popup start -->
													
													<!-- add task popup End -->
												</div>
											</div>
										</div>
										<!-- Tasks Tab End -->
										<!-- Setting Tab start -->
										<div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form method="POST" action="modifier.php">
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-12">
															<h4 class="text-blue h5 mb-20">Modifier Vos Informations Personnel </h4>
															<div class="form-group" style="width:85%;margin:auto">
															<input type="hidden" value="<?php echo $result['id'] ?>" name="id">
																<label>Nom</label>
																<input class="form-control form-control-lg" type="text" value="<?php echo $result['nom'] ?>" name="nom">
															</div>
															<div class="form-group">
																<label>Prenom</label>
																<input class="form-control form-control-lg" type="text" value="<?php echo $result['prenom'] ?>" name="prenom">
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email" value="<?php echo $result['email'] ?>" name="email">
															</div>
															<div class="form-group">
																<label>Telephone</label>
																<input class="form-control form-control-lg" type="text" value="<?php echo $result['Telephone'] ?>" name="tele">
															</div>
															<div class="form-group">
																<label>Adresse</label>
																<input class="form-control form-control-lg " type="text" value="<?php echo $result['adresse'] ?>" name="adresse">
															</div>
															<div class="form-group">
															<button class="btn btn-warning" name="save_profile">Enregistrer</button> 
															</div>
															<?php } ?>
															
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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
	<script src="src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
</body>
</html>