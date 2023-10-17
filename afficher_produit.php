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
	<title>Afficher les produits</title>
	<style>
		.Ajouter_produitC,.modifier_produitC{
			display:none;
			
		}
		.Ajouter_produitC1,.modifier_produitC1{
			display:contents;
		}
		#cat{
			width: 100%; height: 38px;
			font-family: cambria;
			color: #131e22;
			font-weight: 400;
			height: 45px;
			border-color: #d4d4d4;
			letter-spacing: .035em;
			-webkit-transition: all .3s ease-in-out;
			transition: all .3s ease-in-out;
			border-radius:5px
		}
	</style>
	<!-- Site favicon -->
	
	
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
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
				<?php if(isset($_GET['done'])){?>
	<div class="alert alert-success alert-dismissible fade show" role="alert" style="">
								<strong>Operation Effectuer avec succés!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div><?php }?>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Gestion produit</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Gestion produit</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle"  onclick="ajouter_produit()">
									nouveau produit
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Export Datatable start -->
				<div class="card-box mb-30">
					<!-- Ajouter un produit -->
					<div id="Ajouter_produitI" class="Ajouter_produitC">
				
				<div  id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style=" padding-left: 15px;" aria-modal="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Informations du produit</h4>
											<button  class="close" data-dismiss="modal" aria-hidden="true" onclick="fermer1(0)">×</button>	
										</div>
										<div class="modal-body">
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
					</form></div></div></div></div></div>
					<!-- modifier un produit -->
					<div id="modifier_produitI" class="Ajouter_produitC">
				
				<div  id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style=" padding-left: 15px;" aria-modal="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Informations du produit</h4>
											<button  class="close" data-dismiss="modal" aria-hidden="true" onclick="fermer1(1)">×</button>
										</div>
										<div class="modal-body">
					<form method="post" action="modifier.php" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id_prod">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>intitulé</label>
									<input name="intitule" type="text" class="form-control" id="intitule">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>prix vente</label>
									<input name="prix_v" type="number"min="0" class="form-control" id="prix_v">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>prix unitaire</label>
									<input name="prix_u" type="number" min="0"class="form-control" id="prix_u">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Prix achat</label>
									<input name="prix_a" type="number" min="0"class="form-control"id="prix_a" >
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Quantité</label>
									<input name="qte" type="number" min="0" class="form-control" id="qte">
								</div>
							</div>
						<div class="col-md-6 col-sm-12">
								<div class="form-group">
								<label>Catégorie</label>
						<select  id="cat"name="cat">
											<option id='categorie'></option>
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
								</div></div></div></div></div>
					<div class="pd-20">
						<h4 class="text-blue h4">Listes des produits</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
										<th>Image</th>
									<th class="table-plus datatable-nosort">Reference</th>
									<th>intitule</th>
								
									<th>prix unitaire</th>
									<th>prix vente</th>
									<th>prix achat</th>
									<th>catégorie</th>
                                    <th>Quantité</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
require_once("dao.php");
$var=0;
if(isset($_POST['s_button'])) $var=$_POST['s_produit'];
foreach(DOA::afficher_produit($var) as $result){
    ?>
    <tr>
		<td><img width="40px" height="40px" src="<?=$result['photo']?>"></td>
        <td class="table-plus"><?php echo $result['reference']?></td>
        <td><?php echo $result['intitule']?></td>
       
        <td><?php echo $result['prix_unitaire']?></td>
        <td><?php echo $result['prix_vente']?></td>
        <td><?php echo $result['prix_achat']?></td>
        <td><?php echo $result['Nom']?></td>
        <td><?php echo $result['qte']?></td>
        <td><img data-toggle="modal" style="cursor:pointer" data-target="#alert-modal"src="effacer.png" onclick="show(<?php echo $result['reference']?>)"></img>
         <img src="update.png" onclick="modifier1(<?php echo $result['reference']?>,'<?php echo $result['intitule']?>',<?php echo $result['qte']?>,<?php echo $result['prix_unitaire']?>,<?php echo $result['prix_vente']?>,
		<?php echo $result['prix_achat']?>,<?php echo $result['id_cat']?>,'<?php echo $result['Nom']?>')"style="width:24px"></img></button></td>
    </tr>
<?php }
?>						
							</tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>
				<div class="footer-wrap pd-20  mb-20 card-box" style="margin-top: 80px;">
				 Realisé Par <a href="#">EL GHABOURI & EL IDRISSI</a> 
			</div>
		</div>
		<!-- Alert models -->
		<form action="supprimer.php" method="POST">
		<div class="col-md-4 col-sm-12 mb-30" >
						<div class="pd-20 card-box height-100-p" style="box-shadow:none;background:#ecf0f4;">
							
							<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm modal-dialog-centered">
									<div class="modal-content bg-danger text-white">
										<input type="hidden" name="id_produit" id="id_produit">
										<div class="modal-body text-center">
											<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Alert</h3>
											<p>Voulez vous vraiment supprimer ce produit de la liste d'une maniére diffinitive!!.</p>
											<button  class="btn btn-light" name="del_produit">Ok</button>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div></form>
					<!-- fin d'alert models -->
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="vendors/scripts/datatable-setting.js"></script>
	<script src="javascript.js"></script>
	<script>
		function show(var1){
			document.getElementById('id_produit').value=var1;
		}
		function ajouter_produit(){
    let popup=document.getElementById("Ajouter_produitI");
    popup.classList.remove("Ajouter_produitC");
    popup.classList.add("Ajouter_produitC1");

}
function fermer1(var1){
	if(var1==0){
		let popup=document.getElementById("Ajouter_produitI");
		 popup.classList.remove("Ajouter_produitC1");
    popup.classList.add("Ajouter_produitC");
	}
    
	else{let popup=document.getElementById("modifier_produitI");
		popup.classList.remove("Ajouter_produitC1");
    popup.classList.add("Ajouter_produitC");
	} 
   

}
function modifier1(id_prod,intitule,qte,prix_u,prix_v,prix_a,id_cat,nom_cat){
	let popup1=document.getElementById("modifier_produitI");
    document.getElementById('id_prod').value=id_prod
   	document.getElementById('intitule').value=intitule
     document.getElementById('qte').value=qte
     document.getElementById('prix_a').value=prix_a
     document.getElementById('prix_v').value=prix_v
	 document.getElementById('prix_u').value=prix_u
	 document.getElementById('categorie').value=id_cat
	 document.getElementById('categorie').innerHTML=nom_cat
    popup1.classList.remove("Ajouter_produitC");
       popup1.classList.add("Ajouter_produitC1");
}
	</script>
</body>
</html>