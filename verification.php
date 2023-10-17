<?php 
session_start();
include "dao.php";
extract($_POST);
if(isset($_POST['connexion'])){
foreach(DOA::submit($matricule,$password,$type) as $result){
    if($type==0) $_SESSION['gestionnaire']='OUI';
    else $_SESSION['caissier']='OUI'; 
    $_SESSION['logged']=$result['nom'];
    $_SESSION['id']=$result['id'];
if($type==0)header("location:index.php");
else header("location:caissier.php");
exit;
}
header("location:login.php?erreur");
} 

if(isset($_GET['quitter'])){
    session_start();
    session_destroy();
    header("location:login.php");
    exit;
}
?>