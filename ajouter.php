<?php 
session_start();
if(!isset($_SESSION['logged'])){
	header("location:login.php?non");
	exit;
}

?>
<?php 
include "dao.php";
include("./fpdf/fpdf.php");
extract($_POST);
// ajouter client ou fournisseur!!!
if(isset($_POST['save_client'])){
   if( DOA::save_personne($nom,$tele,$mail,$adresse,1)) header("location:afficher_client.php?done=");
   else header("location:gestion_client.php?erreur=une erreur s'est produite");
}
if(isset($_POST['save_fournisseur'])){
   if( DOA::save_personne($nom,$tele,$mail,$adresse,0)) header("location:afficher_fournisseur.php?done");
   else header("location:afficher_fournisseur.php?erreur");
}
// ajouter un produit
if(isset($_POST['save_produit'])){
   $photo=$_FILES['photo'];
	echo $photo['name']."<br>".$photo['tmp_name'];
	$filename=$photo['tmp_name'];
	$extension= pathinfo($photo['name'], PATHINFO_EXTENSION);
	$destination="./$intitule.$extension";
	move_uploaded_file($filename,$destination);
   if(DOA::save_produit($intitule,$qte,$prix_u,$prix_v,$prix_a,$cat,$destination)==false) header("location:ajouter_produit.php?erreur=non ajouter!!");
   else header("location:ajouter_produit.php?done=OK");
}
// ajouter une gategorie
if(isset($_POST['save_categorie'])){
   if(DOA::save_categorie($nom,$remarque)==false) header("location:afficher_categorie.php?erreur");
   else header("location:afficher_categorie.php?done");
}
//Ajouter une commande au pannier...
if(isset($_POST['add_pannier'])){
if(DOA::ajouter_commande_pannier($nom,$qte,$type)==false){
if($type==0)header("location:pannier.php?erreur");
else header("location:achat.php?erreur");
} 
else{
   if($type==0) header("location:pannier.php?done");
   else  header("location:achat.php?done");
}
}
// ajouter une commande d'un client..
if(isset($_POST['valider'])){
   //ajouter une ligne de commande... 
   DOA::ajouter_commande($client,$date) ;
foreach(DOA::get_commande() as $result1){
  // echo $result1['id_com'];
foreach(DOA::get_pannier(0) as $result){
   DOA::ajouter_ligne($result1['id_com'],$result['produit'],$result['qte']);
   DOA::vider_pannier($result['id']);
   header("location:generer_facture.php?done");
}
}
}

// Ajouter un approvisionnement
if(isset($_POST['valider_apro'])){
   //ajouter une ligne de commande...
   DOA::ajouter_appro($four,$date);

foreach(DOA::get_appro() as $result1){
  // echo $result1['id_com'];
foreach(DOA::get_pannier($type) as $result){
   DOA::ajouter_stock($result['qte'],$result['produit']);
   DOA::ajouter_ligne_apro($result1['numero'],$result['produit'],$result['qte']);
   DOA::vider_pannier($result['id']);
   header("location:afficher_appro.php?done");
}
}
}
if(isset($_POST['ticket'])){
   if(DOA::ajouter_ticket($produit,$qte,$prix_v)) header("location:caissier.php?done");
   else header("location:caissier.php?erreur");
}
?>