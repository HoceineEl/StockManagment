<?php 
    $link=mysqli_connect("localhost","root","","bakkas","3307");
// Si base de données en UTF-8, il faudra utiliser la fonction utf8_decode() pour tous les champs de texte à afficher

// extraction des données à afficher dans le sous-titre (nom du voyageur et dates de son voyage)
$requete = "SELECT Com.id_com, cli.nom, D.qte, P.prix_vente,P.intitule,Com.date,cli.tele,cli.email
 FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id and D.ncom=Com.id_com and P.reference=D.nprod and Com.id_com>=all(select id_com from commande)";
//pour savoir la somme des prix ou le total de la facture
$total="SELECT SUM(D.qte*P.prix_vente)as total
FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id and D.ncom=Com.id_com and P.reference=D.nprod and Com.id_com>=all(select id_com from commande)";
$result = mysqli_query($link, $requete);
$result2 = mysqli_query($link, $total);
// tableau des résultats de la ligne > $data_voyageur['nom_champ']
$data_voyageur = mysqli_fetch_array($result);
$total1 = mysqli_fetch_array($result2);
mysqli_free_result($result);
mysqli_free_result($result2);
include("./fpdf/fpdf.php");

class PDF extends FPDF {
    
    // Header
    function Header() {
$link =mysqli_connect("localhost","root","","bakkas","3307");
// extraction des données à afficher 
$requete = "SELECT Com.id_com, cli.nom, D.qte, P.prix_vente,P.intitule,Com.date,cli.tele,cli.email
 FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id and D.ncom=Com.id_com and P.reference=D.nprod and Com.id_com>=all(select id_com from commande)";
$result = mysqli_query($link, $requete);
// tableau des résultats de la ligne > $data_voyageur['nom_champ']
$data_voyageur = mysqli_fetch_array($result);

      // Logo : 8 >position à gauche du document (en mm), 2 >position en haut du document, 80 >largeur de l'image en mm). La hauteur est calculée automatiquement.
      $this->SetFillColor(255);
      $this->SetDrawColor(255);
      $this->SetFont('Courier','',11);
      $d=date( "d/m/Y H:i:s", time() );
      $this->SetX(155);
    $this->Cell(50,6,$d,0,1,'L',1);
      $this->Image('Gestion1.png',8,2,50);

      
      // Saut de ligne 20 mm
      $this->Ln(20);
  
      // Titre gras (B) police Helbetica de 11
      $this->SetFont('Helvetica','B',11);
      // fond de couleur gris (valeurs en RGB)
      $this->setFillColor(230,230,230);
       // position du coin supérieur gauche par rapport à la marge gauche (mm)
      $this->SetX(70);
      // Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok  
      $this->Cell(60,8,'Facture de Commande N: '.$data_voyageur['id_com'],0,1,'C',1);
      // Saut de ligne 10 mm
      $this->Ln(10);    
    }
    // Footer
    function Footer() {
      // Positionnement à 1,5 cm du bas
      $this->SetY(-15);
      // Police Arial italique 8
      $this->SetFont('Helvetica','I',9);
      // Numéro de page, centré (C)
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
  }
  $pdf = new PDF('P','mm','A4');
 
// Nouvelle page A4 (incluant ici logo, titre et pied de page)
$pdf->AddPage();
// Polices par défaut : Helvetica taille 9
$pdf->SetFont('Helvetica','',9);
// Couleur par défaut : noir
$pdf->SetTextColor(0);
// Compteur de pages {nb}
$pdf->AliasNbPages();
// Sous-titre calées à gauche, texte gras (Bold), police de caractère 11
$pdf->SetFont('Helvetica','I',11);
// couleur de fond de la cellule : gris clair
$pdf->setFillColor(230,225,225);
// Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise
$pdf->Cell(190,6,'                   Du '.$data_voyageur['date'].'                                                  Email: '.$data_voyageur['email'],0,1,'C',1);    
$pdf->Cell(190,6,'           Pour Mr\Mme: '.$data_voyageur['nom'].'                                            Telephone: '.$data_voyageur['tele'],0,1,'C',1); 


//$pdf->Cell(75,6,strtoupper(utf8_decode($data_voyageur['id_cli'].' '.$data_voyageur['date'])),0,1,'L',1);        
$pdf->Ln(40); // saut de ligne 10mm

// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
function entete_table($position_entete) {
    global $pdf;
    $pdf->SetDrawColor(255); // Couleur du fond RVB
    $pdf->SetFillColor(210,215); // Couleur des filets RVB
    $pdf->SetTextColor(0); // Couleur du texte noir
    $pdf->SetFont('Courier','B',13);
    $pdf->SetY($position_entete);
    // position de colonne 1 (10mm à gauche)  
    $pdf->SetX(10);
    $pdf->Cell(50,8,'Produit',1,0,'C',1);  // 60 >largeur colonne, 8 >hauteur colonne
    // position de la colonne 2 (70 = 10+60)
    $pdf->SetX(50); 
    $pdf->Cell(50,8,'Quantite',1,0,'C',1);
    // position de la colonne 3 (130 = 70+60)
    $pdf->SetX(100); 
    $pdf->Cell(50,8,'Prix vente',1,0,'C',1);

    $pdf->SetX(150); 
    $pdf->Cell(50,8,'Prix*Quantite',1,0,'C',1);
   // $pdf->Ln(); // Retour à la ligne
  }
  // AFFICHAGE EN-TÊTE DU TABLEAU
  // Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
  $position_entete = 80;
  // police des caractères
  $pdf->SetFont('Helvetica','',9);
  $pdf->SetTextColor(0);
  // on affiche les en-têtes du tableau
  entete_table($position_entete);

  $position_detail = 90; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)
// $requete2 = "SELECT * FROM produit WHERE reference='63'";
// $result2 = mysqli_query($link, $requete2);
$result = mysqli_query($link, $requete);
while ($data_visit = mysqli_fetch_array($result)) {
  // position abcisse de la colonne 1 (10mm du bord)
  $pdf->SetFont('Helvetica','',10);
  $pdf->SetY($position_detail);
  $pdf->SetX(10);
  $pdf->MultiCell(50,8,$data_visit['intitule'],1,'C');
    // position abcisse de la colonne 2 (70 = 10 + 60)  
  $pdf->SetY($position_detail);
  $pdf->SetX(50); 
  $pdf->MultiCell(50,8,$data_visit['qte'],1,'C');
  // position abcisse de la colonne 3 (130 = 70+ 60)
  $pdf->SetY($position_detail);
  $pdf->SetX(100); 
  $pdf->MultiCell(50,8,$data_visit['prix_vente']." dhs",1,'C');
  $pdf->SetY($position_detail);
  $pdf->SetX(150); 
  $pdf->MultiCell(50,8,$data_visit['prix_vente']*$data_visit['qte']." dhs",1,'C');

  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
  $position_detail += 8; 
}
mysqli_free_result($result);
$pdf->Ln(8);
$pdf->SetFillColor(255);
$pdf->SetDrawColor(255); // Couleur du fond RVB
$pdf->SetX(160);
$pdf->SetFont('Courier','B',11); 
$pdf->SetTextColor(239,37,37,0.6);
$pdf->Cell(50,6,'Total :  '.$total1['total']. " Dhs",0,1,'L',1); 
$pdf->Ln(20);$pdf->SetX(160);
$pdf->SetTextColor(0);
$pdf->Cell(50,6,'Signature: ',0,1,'L',1);
$pdf->SetX(160);
$pdf->SetFont('Courier','',9); 
//$pdf->AddFont('Comic', 'I');
$pdf->Cell(50,6,'Gestionnaire de Stock. ',0,1,'L',1);

/*
// Nouvelle page PDF
$pdf->AddPage();
// Polices par défaut : Helvetica taille 9
$pdf->SetFont('Helvetica','',11);
// Couleur par défaut : noir
$pdf->SetTextColor(0);
// Compteur de pages {nb}
$pdf->AliasNbPages();
$pdf->Cell(500,20,utf8_decode('Plus rien à vous dire ;-)'));
*/
// affichage à l'écran...
$pdf->Output('test.pdf','I');
 // ...ou export sur le serveur dans un dossier "fic"
 $pdf->Output('F', '../fic/test.pdf');
 header("location:index.php");
?>