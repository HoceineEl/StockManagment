<?php
include("dao.php");
session_start();
if(!isset($_SESSION['logged'])){
	header("location:login.php?non");
	exit;
}


// if(isset($_GET['id_produit']))
// {$id=$_GET['id_produit'];
// if(DOA::supprimer_produit($id)) header("location:gestion_produit.php");
// }
extract($_POST);
if(isset($_POST['id_personne'])){
$id=$_POST['tajriba1'];
if($type==1)
  {
      if(DOA::supprimer_personne($id)) header("location:afficher_client.php?done");
    else header("location:afficher_client.php?erreur");
}else{
    if(DOA::supprimer_personne($id)) header("location:afficher_fournisseur.php?done");
    else header("location:afficher_fournisseur.php?erreur");
    }
}

if(isset($_POST['del_produit'])){
    if(DOA::supprimer_produit($_POST['id_produit'])) header("location:afficher_produit.php?done=");  
    else header("location:afficher_produit.php?erreur");
}
if(isset($_POST['id_categorie'])){
        if(DOA::supprimer_categorie($delete_cat)) header("location:afficher_categorie.php?done");
        else  header("location:afficher_categorie.php?done");
    }
if(isset($_POST['del_ligne_com'])){
    if(DOA::vider_pannier($id_ligne)){
        if($type==0){
            DOA::supprimer_stock($qte2,$id_prod2);
            header("location:pannier.php?done");
        }
        else header("location:achat.php?done");
    } 
    else{
        if($type==0)  header("location:pannier.php?erreur");
        else header("location:achat.php?erreur");
    }
}
if(isset($_POST['id_com'])){
    $id_com=$_POST['id_com1'];
    $id_prod=$_POST['reference1'];
    $qte=$_POST['qte1'];
    DOA::supprimer_stock($qte,$id_prod);
    if(DOA::verifier_nombre_commande($id_com)>1)
    DOA::supprimer_ligne_commande($id_com,$id_prod);
    else DOA::supprimer_commande($id_com);
    header("location:afficher_commande.php?done");
}
if(isset($_POST['id_apro'])){
    $id_com=$_POST['numero1'];
    $id_prod=$_POST['reference2'];
    $qte=$_POST['qte2'];
    DOA::supprimer_stock_apro($qte,$id_prod);
    if(DOA::verifier_nombre_apro($id_com)>1)
       DOA::supprimer_ligne_apro($id_com,$id_prod);
    else DOA::supprimer_apro($id_com);
    header("location:afficher_appro.php?done");
}
if(isset($_POST['del_prod_ticket'])){
    DOA::supprimer_stock($qte,$id_prod);
    DOA::supprimer_ticket($id_ticket);
}
?>