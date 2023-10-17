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

    .active,.active1{
        display:block;
    }
    .hi,.hi1{
        display:none;
    }
</style>
	<!-- Site favicon -->
	<link rel="icon" type="image/png"  href="Gestion_st1.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
            
			<div class="min-height-200px">
				<div class="page-header">
				<?php if(isset($_GET['done'])){?>
	<div class="alert alert-success alert-dismissible fade show" role="alert" style="">
								<strong>Suppression Effectuer avec succés!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div><?php }?>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Gestion des catégories</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Catégories</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" onclick="afficher()">
									nouvelle Catégorie
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Export Datatable start -->
                
				<div class="card-box mb-30" style="">
                    <!-- Ajouter une categorie -->
                <div id="test" class="hi">
<div  id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style=" padding-left: 15px;" aria-modal="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Information de la Ctégorie</h4>
											<button  class="close" data-dismiss="modal" aria-hidden="true" onclick="fermer(0)">×</button>
										</div>
										<div class="modal-body">
                                        <form method="post" action="ajouter.php">
										<input name="type" type="hidden" class="form-control" value="1">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Intitulé</label>
									<input name="nom" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Remarque</label>
									<input name="remarque" type="text" class="form-control">
								</div>
							</div>
						</div>
						
						
											<div class="col-md-6 col-sm-12">
											<button name="save_categorie" class="btn btn-outline-primary">Enregistrer</button>
											</div>
					</form>
										</div>
										
									</div>
								</div>
							</div></div>
                            <!-- Modifier une categorie -->
                            <div class="hi1" id="test1">
<div  id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style=" padding-left: 15px;" aria-modal="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Modifier une Catégorie</h4>
											<button  class="close" data-dismiss="modal" aria-hidden="true" onclick="fermer(1)">×</button>
										</div>
										<div class="modal-body">
                                        <form method="post" action="modifier.php">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Intitulé</label>
									<input name="nom" type="text" class="form-control" id="nom1">
                                    <input name="id" type="hidden" class="form-control" id="id1">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Remarque</label>
									<input name="remarque" id="tele1" type="text" class="form-control">
								</div>
							</div>
						</div>
											<div class="col-md-6 col-sm-12">
											<button name="save_categorie" class="btn btn-outline-primary">Enregistrer</button>
											</div>
					</form>
										</div>
										
									</div>
								</div>
							</div></div>
					<div class="pd-20">
                        
						<h4 class="text-blue h4">Listes des categories</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">id</th>
									<th>Intitulé</th>
									<th>Remarque</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
require_once("dao.php");
$var=0;
if(isset($_POST['s_button'])) $var=$_POST['s_produit'];
foreach(DOA::afficher_categorie($var,1) as $result){
    ?>
    <tr>
        <td class="table-plus"><?php echo $result['id_cat']?></td>
        <td><?php echo $result['Nom']?></td>
        <td><?php echo $result['remarque']?></td>

        <td><img data-toggle="modal" data-target="#alert-modal" src="effacer.png" onclick="show(<?php echo $result['id_cat']?>)"></img>
        <img src="update.png"  style="width: 24px" onclick="modifier_cat(<?php echo $result['id_cat']?>,'<?php echo $result['Nom']?>','<?php echo $result['remarque']?>')" ></img></td>
    </tr>
<?php 
}
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
										<input type="hidden" name="delete_cat" id="tajriba1">
										<div class="modal-body text-center">
											<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Alert</h3>
											<p>Voulez vous vraiment supprimer cette catégorie dont les produits qu'elle inclut!!</p>
											<button  class="btn btn-light" name="id_categorie">Ok</button>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div></form>
                    </div>

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
		function modifier_cat(id,nom,remarque){
			
    // nom=toString(nom)
   //  document.write(id,nom,tele,adresse,email)
     let popup1=document.getElementById("test1");
     document.getElementById('id1').value=id
     document.getElementById('nom1').value=nom
      document.getElementById('tele1').value=remarque
     popup1.classList.remove("hi1");
        popup1.classList.add("active1");
 }
	</script>
</body>
</html>