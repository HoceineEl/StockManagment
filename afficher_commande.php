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
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
            
			<div class="min-height-200px">
				<div class="page-header">
				<?php if(isset($_GET['done'])){?>
	<div class="alert alert-success alert-dismissible fade show" role="alert" >
								<strong>Opération souhaitée Effectuer avec succés!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div><?php }?>
							<?php if(isset($_GET['erreur'])){?>
	<div class="alert alert-success alert-dismissible fade show" role="alert" style="color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;">
								<strong>Une erreur de gestion s'est produit!!!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div><?php }?>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Gestion commande</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Commande</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="pannier.php">
									Nouvelle Commande
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Export Datatable start -->
                
				<div class="card-box mb-30">
                    
                
					<div class="pd-20">
                        
						<h4 class="text-blue h4">Liste des lignes de commandes</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">ID</th>
									<th>client</th>
                                    <th>date commande</th>
                                    <th>produit</th>
                                    <th>qte</th>
                                    <th>Prix</th>
                                    <th>action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
		require_once("dao.php");
		$var=0;
		if(isset($_POST['s_button'])) $var=$_POST['s_produit'];
		foreach(DOA::afficher_commande($var) as $result){
 		   ?>
   	 <tr>
        <td class="table-plus"><?php echo $result['id_com']?></td>
        <td><?php echo $result['nom']?></td>
        <td><?php echo $result['date']?></td>
        <td><?php echo $result['intitule']?></td>
        <td><?php echo $result['qte']?></td>
        <td><?php echo $result['qte']*$result['prix_vente']," dh" ?></td>
        <td><img src="effacer.png" style="cursor:pointer"data-toggle="modal" data-target="#alert-modal" 
		onclick="show_com(<?php echo $result['id_com']?>,<?php echo $result['reference']?>,<?php echo $result['qte']?>)"> 
	</img>
		<a href="modifier_commande.php?id_com=<?= $result['id_com'] ?>&id_cli=<?= $result['id'] ?>&pro=<?= $result['reference'] ?>&nom=<?= $result['nom'] ?>&qte=<?= $result['qte'] ?>"><img src="update.png" style="width: 24px;"></img></a></td>
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
										<input type="hidden" name="id_com1" id="id_com">
                                        <input type="hidden" name="reference1" id="reference">
                                        <input type="hidden" name="qte1" id="qte">
										<div class="modal-body text-center">
											<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Alert</h3>
											<p>Voulez vous vraiment supprimer cette commande de la liste d'une maniére diffinitive!!.</p>
											<button  class="btn btn-light" name="id_com">Ok</button>
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
</body>
</html>