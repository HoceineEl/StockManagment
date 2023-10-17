<!--<!DOCTYPE html>
<html>
<head>
<script>
function showUser(str) {
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
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select a person:</option>
<option value="1">Peter Griffin</option>
<option value="2">Lois Griffin</option>
</select>
</form>
<br>
<div id="txtHint"><b>Person info will be listed here.</b></div>

</body>
</html>-->
<?php 
session_start();
if(!isset($_SESSION['caissier'])){
	header("location:login.php?non");
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<style>
		table td{
		padding:0.4rem;
	}
	</style>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Afficher les produits</title>

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
  function show5(var1,var2,var3,var4){
	document.getElementById('reference').value=var1;
	document.getElementById('prix_v').value=var4;
	document.getElementById('produit').value=var2;
	document.getElementById('qute').value=var3;
}
</script>
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
	<?php session_start();
?>
<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			
		</div>
		<div class="header-right">
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name"><?php echo $_SESSION['logged'] ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						
						<a class="dropdown-item" href="verification.php?quitter"><i class="dw dw-logout"></i> Déconnecter</a>
					</div>
				</div>
			</div>
		</div>
	</div>
  <div class="left-side-bar" style="width: 320px;background:white;">
  <div class="brand-logo" style="border-bottom:1px solid rgb(0 0 0 / 10%);width:322px">
			<a href="index.html">
				<img src="Gestion1.png" alt="" class="dark-logo">
				<img src="Gestion1.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
</div>
<!-- TICKET -->
<div class="menu-block customscroll" style="color:black;">
  <div class="sidebar-menu">
		
      <div    style="display: flex;flex-direction: column;align-items: flex-start;justify-content: center;">
	  <label class=" col-form-label" style="font-family:cambria"> Produit choisie:</label>		
		<input type="hidden" id="reference" name="reference" >
		<input type="text" placeholder="produit" id="produit" name="produit"class="form-control" style="width:90%;margin:auto;height:38px">
		<label class=" col-form-label" style="font-family:cambria"> Quantité<span style="color:#f1464696"> (Négociable)</span></label>
        <input type="text" placeholder="quantité" name="qte" id="qute" class="form-control" style="width:90%;margin:auto;height:38px">
		<label style="color:red;letter-spacing:.035em;font-family:cambria;margin-left:5%"id="txtHint1"></label>
		<label class=" col-form-label" style="font-family:cambria">Prix vente<span style="color:#f1464696"> (Négociable):</span></label>
		<input type="text" placeholder="prix vente" id="prix_v" name="prix_v" class="form-control" style="width:90%;margin:auto;height:38px">
		<button class="btn btn-warning" name="ticket" onclick="showUser1(document.getElementById('qute').value,document.getElementById('reference').value,
		document.getElementById('prix_v').value);showUser2()" style="margin-top:3%;margin-left:7%;width:85%">Ajouter Au ticket</button>
		</div>
    <div id='txtHint2' style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">

</div>
<div id="txtHint3"></div>
		</div>
		
	</div>
	
</div>
  <!-- end de left side barre -->
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10" style="padding:10px 10px 10px 75px;">
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
								<h4>Categorie</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
							<select class="custom-select2 form-control"  name="users" onchange="showUser(this.value)" style="width: 100%; height: 38px;">
							<option value="0" >- - - choisir une categorie - - -</option>
											<?php include("dao.php");
											foreach(DOA::afficher_categorie(0) as $result){?>
											<option value="<?php echo $result['id_cat']?>" ><?php echo $result['Nom']?></option>
											<?php }
											?>
									</select>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							
						</div>
					</div>
				</div>
				<!-- Export Datatable start -->
				
					
						<h4 class="text-blue h4">Produit disponible pour Cette Categorie</h4>
					
					<div  id="txtHint" class="row clearfix">
						
					</div>
				
				<!-- Export Datatable End -->
			</div>
				<div class="footer-wrap pd-20  mb-20 card-box" style="margin-top: 80px;">
				 Realisé Par <a href="#">EL GHABOURI & EL IDRISSI</a> 
			</div>
		</div>
		<!-- Alert models -->
		
		
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
	function supprimer(var1,var2,var3){
		document.getElementById('ticket').value=var1;
		document.getElementById('qte').value=var2;
		document.getElementById('id_prod').value=var3;
	}
function showUser(str) {
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
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}
function showUser1(str,str1,str2) {
  if (str=="") {
    document.getElementById("txtHint1").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint1").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?p="+str+"&r="+str1+"&prix="+str2,true);
  xmlhttp.send();
}
function showUser2() {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?valide",true);
  xmlhttp.send();
}
function supprimer_ajax(str,str1,str2) {
  
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?t="+str+"&qte="+str1+"&r="+str2,true);
  xmlhttp.send();

}
function ajouter(){
	var xmlhttp=new XMLHttpRequest();
	document.getElementById("txtHint2").innerHTML="Ajout Effectuer avec Succés";
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
    }
  }
  
  xmlhttp.open("GET","getuser.php?ajouter",true);
  xmlhttp.send();
}
// function showUser3() {
//   var xmlhttp=new XMLHttpRequest();
//   xmlhttp.onreadystatechange=function() {
//     if (this.readyState==4 && this.status==200) {
//       document.getElementById("txtHint3").innerHTML=this.responseText;
//     }
//   }
//   xmlhttp.open("GET","getuser.php?somme",true);
//   xmlhttp.send();
// }
</script>
</body>
</html>