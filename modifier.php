<?php

session_start();
if(!isset($_SESSION['logged'])){
	header("location:login.php?non");
	exit;
}


include "dao.php";
extract($_POST);
//Modifier un admin
if(isset($_POST['save_profile'])){
   if(DOA::modifier_admin($id,$nom,$prenom,$email,$tele,$adresse))
    header("location:profile.php?done");
    else header("location:profile.php?erreur");
}
// Modifier un produit
if(isset($_POST['save_produit'])){
    $photo=$_FILES['photo'];
	$filename=$photo['tmp_name'];
    if($filename=="") $destination=0;
    else{
	$extension= pathinfo($photo['name'], PATHINFO_EXTENSION);
	$destination="./$intitule.$extension";
    move_uploaded_file($filename,$destination);
}    
if(DOA::modify_produit($id,$intitule,$qte,$prix_u,$prix_v,$prix_a,$cat,$destination)) 
    header("location:afficher_produit.php?done=");
}
if(isset($_POST['save_client'])){
    if(DOA::modify_personne($id,$nom,$tele,$email,$adresse))  
    if($type==1)   
    header("location:afficher_client.php?done");
    else     header("location:afficher_fournisseur.php?done");
 
}
if(isset($_POST['save_categorie'])){
    if(DOA::modify_categorie($id,$nom,$remarque))     
    header("location:afficher_categorie.php?done");
    else     header("location:afficher_categorie.php?erreur");
}
// Modifier commande
if(isset($_POST['save_commande'])){
   DOA::supprimer_stock($qte1,$id_prod);
   if(DOA::verifier_stock($qte,$produit)>0){
   DOA::supprimer_ligne_commande($id,$id_prod);
   DOA::ajouter_ligne($id,$produit,$qte);
   DOA::modify_commande($id,$cat,$date);
   header("location:afficher_commande.php?done"); 
   }else header("location:afficher_commande.php?erreur"); 
}
//Modifier approvisionnement
if(isset($_POST['save_apro'])){
   if(DOA::supprimer_stock_apro($qte1,$id_prod) && DOA::supprimer_ligne_apro($id,$id_prod) && DOA::ajouter_ligne_apro($id,$produit,$qte) &&
   DOA::modify_apro($id,$id_cli,$date)&&DOA::ajouter_stock($qte,$produit))
   header("location:afficher_appro.php?done"); 
    else  header("location:afficher_appro.php?erreur"); 
}
?>