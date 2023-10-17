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
								<strong>Opération Effectuer avec succés!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div><?php }?>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Gestion Commande</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pannier</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-secondary dropdown-toggle" href="afficher_commande.php" role="button">
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
							<h4 class="text-blue h4">Ajouter Commande</h4>
							
						</div>
						
					</div>
					<?php if(!isset($_GET['id'])){ ?>
					<form method="post" action="ajouter.php">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Quantité</label>
									<input name="qte" type="number" min="1" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
								<label>produit</label>
							<select class="custom-select2 form-control" name="nom" style="width: 100%; height: 38px;" onchange="apropos_produit(this.value)">
											<option value="">- - -Veiullez choissir un produit- - -</option>
											<?php include("dao.php");
											foreach(DOA::afficher_produit(0) as $result){?>
											<option value="<?php echo $result['reference']?>" ><?php echo $result['intitule']?></option>
											<?php }
											?>
									</select>
											</div>
											</div>
											<input name="type" type="hidden" class="form-control" value="0">
											
											<div id="txtHint" class="col-md-12 col-sm-12">

											</div>
											<div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                            <label></label>
											<button name="add_pannier" class="btn btn-secondary btn-lg btn-block"style="width:75%;margin:auto">Ajouter au pannier</button>
											</div></div></form><?php }
					?>
							<!--<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Date</label>
									<input name="date" type="date" class="form-control">
								</div>
							</div>-->
						</div>
						
						<div class="row">
						
							
											</div>
											
					
					
					<div class="collapse collapse-box" id="form-grid-form" >
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"  data-clipboard-target="#form-grid"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#form-grid-form" class="btn btn-primary btn-sm pull-right" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="form-grid">
							

							</code></pre>
						</div>
					</div>
					<?php if(DOA::nb_pannier(0)>0){ ?>
                    <div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">ID</th>
                                    <th>Produit</th>
									<th>quantité</th>
									<th>prix</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php
require_once("dao.php");
$var=0;
if(isset($_POST['s_button'])) $var=$_POST['s_produit'];
foreach(DOA::get_pannier(0) as $result){
    ?>
    <tr>
        <td class="table-plus"><?php echo $result['id']?></td>
        <td><?php echo $result['intitule']?></td>
        <td><?php echo $result['qte']?></td>
        <td><?php echo $result['qte']*$result['prix_vente']," dhs"?></td>
        <td><img onclick="supprimer_pannier(<?php echo $result['id']?>,<?php echo $result['produit']?>,<?php echo $result['qte']?>)"src="effacer.png" style="width: 30px; cursor:pointer" data-toggle="modal" data-target="#alert-modal"></img>
           </tr>
<?php }
?>						
							</tbody>
						</table>
						<form action="ajouter.php" method="POST">
							
						<div class="row">
                        <div class="col-md-6 col-sm-12">
								<div class="form-group">
								<label>Client</label>
						<select class="custom-select2 form-control" name="client" style="width: 100%; height: 38px;">
											<?php
											foreach(DOA::afficher_personne(0,1) as $result){?>
											<option value="<?php echo $result['id']?>" ><?php echo $result['nom']?></option>
											<?php }
											?>
									</select>
											</div>
											</div>
											<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Date</label>
									<input name="date" type="date" class="form-control">
								</div>
							</div></div>
							
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label></label>
											<button name="valider" class="btn btn-success btn-lg btn-block" style="width:75%;margin:auto">Valider tous</button>
											</div></div>
					</div></form><?php } ?>
				</div></div>
				<!-- Export Datatable End -->
                
			</div>
            
				</div>
				<!-- Form grid End -->

				<!-- Input Validation Start -->
				
				<!-- Input Validation End -->
				<form action="supprimer.php" method="POST">
		<div class="col-md-4 col-sm-12 mb-30" >
						<div class="pd-20 card-box height-100-p" style="box-shadow:none;background:#ecf0f4;">
							
							<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm modal-dialog-centered">
									<div class="modal-content bg-danger text-white">
										<input type="hidden" name="id_prod2" id="id_prod6">
										<input type="hidden" name="id_ligne" id="tajriba1">
										<input type="hidden" name="qte2" id="qte6">
										<input name="type" type="hidden" class="form-control" value="0">
										<div class="modal-body text-center">
											<h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Alert</h3>
											<p>Voulez vous vraiment supprimer cette ligne de commande de la liste d'une maniére diffinitive!!.</p>
											<button  class="btn btn-light" name="del_ligne_com">Ok</button>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div></form>
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
	<script>
		function supprimer_pannier(var1,var2,var3){
    //alert(var1)
   document.getElementById('tajriba1').value=var1;
   document.getElementById('id_prod6').value=var2;
   document.getElementById('qte6').value=var3;
}
function apropos_produit(str){
	if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?produit="+str,true);
  xmlhttp.send();
}

	</script>
	<script src="javascript.js"></script>
</body>
</html>