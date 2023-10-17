<?php
include("dao.php");
    if(isset($_GET['producteur'])){
        $id=$_GET['producteur'];
        $con=DOA::getPDO();
        $req=$con->prepare("SELECT * from produit where reference='$id'");
        $req->execute();?>
        <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>intitule</th>
                <th>prix unitaire</th>
                <th>prix vente</th>
                <th>prix achat</th>
                <th>catégorie</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
require_once("dao.php");
$var=0;
if(isset($_POST['s_button'])) $var=$_POST['s_produit'];
foreach(DOA::afficher_produit($var) as $result){
?>
<tr>
<td class="table-plus"><?php echo $result['reference']?></td>
<td><?php echo $result['intitule']?></td>
<td><?php echo $result['prix_unitaire']?></td>
<td><?php echo $result['prix_vente']?></td>
<td><?php echo $result['prix_achat']?></td>
<td><?php echo $result['cat']?></td>
<td><?php echo $result['qte']?></td>
<td><img data-toggle="modal" style="cursor:pointer" data-target="#alert-modal"src="effacer.png" onclick="show(<?php echo $result['reference']?>)"></img>
<a href="ajouter_produit.php?id=<?=$result['reference']?>"><img src="update.png" style="width:24px"></img></a></td>
</tr>
<?php }
?>						
        </tbody>
    </table>
    <?php }

?>