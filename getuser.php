<!DOCTYPE html>
<html>
<head>
<style>
	
</style>
</head>

<body>

<?php
include("dao.php");
if(isset($_GET['q'])){
$q = intval($_GET['q']);

$con=mysqli_connect("localhost","root","","bakkas","3307");
if (!$con) {
  //die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM produit WHERE cat = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    ?>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30" onclick="show5(<?php echo $row['reference'] ?>,'<?php echo $row['intitule'] ?>','<?php echo $row['qte'] ?>',<?php echo $row['prix_vente']?>)">
						<div class="da-card">
							<div class="da-card-photo">
								<img src="<?php echo $row['photo']?>" alt="" size="100*100">
								<div class="da-overlay">
									<div class="da-social">
										<ul class="clearfix">
											<li><?php echo"Quantité: ", $row['qte']?></li></br>
											<li><?php echo"Prix: ", $row['prix_vente']," dhs"?></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="da-card-content">
								<h5 class="h5 mb-10"><?php echo $row['intitule'] ?></h5>
								
							</div>
						</div>
					
</div>
<?php }
mysqli_close($con);}
?>

<?php
if(isset($_GET['p'])){
$p = intval($_GET['p']);
$r = intval($_GET['r']);
$prix = intval($_GET['prix']);
if($p==0) echo "Valeur Null!!";
else{
$con=DOA::getPDO();
$sql=$con->prepare("SELECT * FROM produit WHERE reference ='$r' and qte>='$p'");
$sql->execute();
if($sql->rowCount()<=0) echo "Stock Indisponible!!";
else {
	DOA::modifier_stock($p,$r);
	 if(DOA::prod_exist_ticket($r)>0) 
	 $sql=$con->prepare("Update  ticket set qte=qte+'$p', prix_v='$prix' where produit='$r'");
	else
	$sql=$con->prepare("INSERT INTO ticket VALUES(null,'$r','$p','$prix')");//echo DOA::prod_exist_ticket($r);
	$sql->execute();
	?>  
<?php } }
 } for($i=0;$i<1930000;$i++)$a=$i;
if(isset($_GET['valide'])){
	//Juste pour ralentir un peu la requete pendant que la requete d'insertion s'ffectue par le serveur
	for($i=0;$i<1970000;$i++)$a=$i;
	?>
<table class="table hover multiple-select-row data-table-export nowrap" style="margin-top:3%">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Produit</th>
									<th>Quantité</th>
									<th>Prix</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
<?php foreach(DOA::afficher_ticket() as $result){?>
	<tr>
		<td style="padding:0.4rem;"><?php echo $result['intitule']?></td>
		<td style="padding:0.4rem;"><?php echo $result['qte']?></td>
		<td style="padding:0.4rem;"><?php echo $result['qte']*$result['prix_v']?></td>
		<td style="padding:0.4rem;"><img src="effacer.png" alt="" data-toggle="modal" style="cursor:pointer" data-target="#alert-modal"src="effacer.png" onclick="supprimer_ajax(<?php echo $result['id_ticket']?>,<?php echo $result['qte']?>,<?php echo $result['produit']?>)"></td>
	</tr>
</tbody>
<?php } ?>
</table>
<?php
if(DOA::afficher_total()==null) echo "<p>Total: 0.00 dhs</p>";
else{
foreach(DOA::afficher_total() as $result){
	echo "<p style='width:100%;margin: auto;display: flex;flex-direction:row-reverse;font-family: fangsong;border: 1px solid;'>Total: $result[total] dhs</p>";
}}
?>
 <button onclick="ajouter()" class="btn btn-success" style="margin-top: 3%;margin-left: 0%;width:85%">Valider Tous</button>
<?php
}
if(isset($_GET['t'])){
	$qte=$_GET['qte'];
	$id_prod=$_GET['r'];
	$id_ticket=$_GET['t'];
	DOA::supprimer_stock($qte,$id_prod);
    DOA::supprimer_ticket($id_ticket); 
	for($i=0;$i<1970000;$i++)$a=$i;
// Reaffichage du contenu 
?>
<table class="table hover multiple-select-row data-table-export nowrap" style="margin-top:3%">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Produit</th>
									<th>Quantité</th>
									<th>Prix</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
<?php foreach(DOA::afficher_ticket() as $result){?>
	<tr>
		<td style="padding:0.4rem;"><?php echo $result['intitule']?></td>
		<td style="padding:0.4rem;"><?php echo $result['qte']?></td>
		<td style="padding:0.4rem;"><?php echo $result['qte']*$result['prix_v']?></td>
		<td style="padding:0.4rem;"><img src="effacer.png" alt="" data-toggle="modal" style="cursor:pointer" data-target="#alert-modal"src="effacer.png" onclick="supprimer_ajax(<?php echo $result['id_ticket']?>,<?php echo $result['qte']?>,<?php echo $result['produit']?>)"></td>
	</tr>
</tbody>
<?php } ?>
</table>
<?php
if(DOA::afficher_total()==null) echo "<p>Total: 0.00 dhs</p>";
else{
foreach(DOA::afficher_total() as $result){
	echo "<p style='width:100%;margin: auto;display: flex;flex-direction:row-reverse;font-family: fangsong;border: 1px solid;'>Total: $result[total] dhs</p>";
}}
?>
 <button onclick="ajouter()" class="btn btn-success" style="margin-top: 3%;margin-left: 0%;width:85%">Valider Tous</button>
<?php
}
if(isset($_GET['ajouter'])){
	$con=DOA::getPDO();
	DOA::ajouter_ticket_histo();
	foreach(DOA::get_id_ticket() as $result){
		foreach(DOA::get_ticket() as $result1){
			DOA::ajouter_ligne_caisse($result['id_ticket'],$result1['produit'],$result1['qte'],$result1['prix_v']);
		}
	}
	DOA::vider_ticket();
}
if(isset($_GET['produit'])){
$id_produit=$_GET['produit'];
?>
<label for="email" style="    color: #ffc107d6;font-size: large;letter-spacing: 0.07rem;font-family: cursive;">A propos!</label>
<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Reference</th>
									<th>intitule</th>
									<th>prix unitaire</th>
									<th>prix vente</th>
									<th>prix achat</th>
									<th>catégorie</th>
                                    <th>Quantité</th>
									
								</tr>
							</thead>
							<tbody>
                            <?php

foreach(DOA::afficher_produit($id_produit) as $result){
    ?>
    <tr style="background-color: antiquewhite;">
        <td class="table-plus"><?php echo $result['reference']?><img width="50px" src="<?=$result['photo']?>"></td>
        <td><?php echo $result['intitule']?></td>
        <td><?php echo $result['prix_unitaire']?></td>
        <td><?php echo $result['prix_vente']?></td>
        <td><?php echo $result['prix_achat']?></td>
        <td><?php echo $result['Nom']?></td>
        <td><?php echo $result['qte']?></td>
    </tr>
<?php }
?>						
							</tbody>
						</table>

<?php }
?>
</body>
</html>