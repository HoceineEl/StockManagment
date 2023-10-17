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

    <?php include("header.php"); 
    include("right_side_bar.php");
    include("left_side_bar.php");
    ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
				<div class="mobile-menu-overlay"></div>
	<?php if(isset($_GET['done'])){?>
	<div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align:center;margin:auto;width:75%;">
								<strong>Ajout Effectuer avec succés!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div><?php }?>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Form</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Form Basic</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-secondary dropdown-toggle" href="afficher_produit.php" role="button">
									Retour
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				
				<!-- Default Basic Forms End -->

				<!-- horizontal Basic Forms Start -->
				<!-- horizontal Basic Forms End -->

				<!-- Form grid Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form grid</h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						
					</div>
					<?php if(!isset($_GET['id'])){ ?>
					<form method="post" action="ajouter.php" enctype="multipart/form-data">
						
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>intitulé</label>
									<input name="intitule" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>prix vente</label>
									<input name="prix_v" type="number"min="0" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>prix unitaire</label>
									<input name="prix_u" type="number" min="0"class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Quantité</label>
									<input name="qte" type="number" min="0"class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Prix achat</label>
									<input name="prix_a" type="number" min="0" class="form-control">
								</div>
							</div>
						<div class="col-md-6 col-sm-12">
								<div class="form-group">
								<label>Catégorie</label>
						<select class="custom-select2 form-control" name="cat" style="width: 100%; height: 38px;">
											<?php include("dao.php");
											foreach(DOA::afficher_categorie(0) as $result){?>
											<option value="<?php echo $result['id_cat']?>" ><?php echo $result['Nom']?></option>
											<?php }
											?>
									</select>
											</div>
											</div>
											</div>
											<div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Photo</label>
                  <div class="col-sm-10">
                    <input type="file" name="photo" class="form-control" src="./est.png">
                  </div>
                </div>
											<div class="col-md-12 col-sm-12">
											
								<div class="form-group">
									<label></label>
											<button style="width:75%;margin:auto;"name="save_produit" class="btn btn-success btn-lg btn-block">Enregistrer</button>
											</div></div>
					</form><?php }
					else{
						include("dao.php");
						$id1=$_GET['id'];
						foreach(DOA::get_produit($id1) as $result){
						?>
					<!-- Modifier un produit -->
						<form method="post" action="modifier.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $result['reference']?>">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>intitulé</label>
									<input name="intitule" type="text" class="form-control" value="<?php echo $result['intitule']?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>prix vente</label>
									<input name="prix_v" type="number"min="0" class="form-control"  value="<?php echo $result['prix_vente']?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>prix unitaire</label>
									<input name="prix_u" type="number" min="0"class="form-control" value="<?php echo $result['prix_unitaire']?>">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Quantité</label>
									<input name="qte" type="number" min="0"class="form-control" value="<?php echo $result['qte']?>">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Prix achat</label>
									<input name="prix_a" type="number" min="0" class="form-control" value="<?php echo $result['prix_achat']?>">
								</div>
							</div>
						<div class="col-md-6 col-sm-12">
								<div class="form-group">
								<label>Catégorie</label>
						<select class="custom-select2 form-control" name="cat" style="width: 100%; height: 38px;">
											<?php 
											foreach(DOA::afficher_categorie(0) as $result1){?>
											<option value="<?php echo $result1['id_cat']?>" ><?php echo $result1['Nom']?></option>
											<?php }
											?>
									</select>
											</div>
											</div>
											</div>
											<div class="col-md-6 col-sm-12">
											
											</div>
											<div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Photo</label>
                  <div class="col-sm-10">
                    <input type="file" name="photo" class="form-control">
                  </div>
                </div>
											<div class="col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p" style="-webkit-box-shadow:none;margin-left:230%">
							
							<div class="modal fade" id="warning-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm modal-dialog-centered">
									<div class="modal-content bg-warning">
										<div class="modal-body text-center">
											<h3 class="mb-15"><i class="fa fa-exclamation-triangle"></i> Warning</h3>
											<p>Voulez vous vraiment enregistrer les modification effectuer!!.</p>
											<button  class="btn btn-dark"  name="save_produit">Ok</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
										<button  style="margin-top:-10%"class="btn btn-outline-primary" class="btn-block" data-toggle="modal" data-target="#warning-modal">Modifier</button>

					<?php }}
					?>
					
					<div class="collapse collapse-box" id="form-grid-form" >
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"  data-clipboard-target="#form-grid"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#form-grid-form" class="btn btn-primary btn-sm pull-right" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="form-grid">
							
<form>
	
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>col-md-6</label>
				<input type="text" class="form-control">
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>col-md-6</label>
				<input type="text" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="form-group">
				<label>col-md-6</label>
				<input type="text" class="form-control">
			</div>
		</div>
		
	</div>
	
</form>
							</code></pre>
						</div>
					</div>
				</div>
				<!-- Form grid End -->

				<!-- Input Validation Start -->
				
				<!-- Input Validation End -->

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
</body>
</html>