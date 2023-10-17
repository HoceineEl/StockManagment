<?php 
class DOA{
	static function getPDO(){
		return new PDO("mysql:host=localhost;port=3307;dbname=bakkas","root","");
	}
    static function submit($l,$p,$t){
		$con=DOA::getPDO();
   		$p=md5($p);
		$req=$con->prepare("SELECT * from administrateur where login='$l' and password='$p' and type='$t'");
		$req->execute();
		return $req;
	}
	static function get_admin($id){
		$con=DOA::getPDO();
		$req=$con->prepare("SELECT * from administrateur where id='$id'");
		$req->execute();
		return $req;	
	}
	static function modifier_admin($id,$nom,$prenom,$email,$tele,$adresse){
		try{
		$con=DOA::getPDO();
		$req=$con->prepare("UPDATE administrateur set nom='$nom',Telephone='$tele',email='$email',adresse='$adresse',prenom='$prenom' where id='$id'");
		return $req->execute();
	}catch(exception $e){
		return false;
	}
	}
    static function save_personne($n,$t,$e,$a,$ty){
		try{
			$con=DOA::getPDO();
        $req=$con->prepare("INSERT into personne values (null,'$n','$t','$e','$a','$ty')");
        return $req->execute();
		}catch(Exception $e){
			return false;
		}
    }
	static function modify_personne($id,$n,$t,$e,$a){
		try{
			$con=DOA::getPDO();
		$req=$con->prepare("UPDATE personne set nom='$n',tele='$t',email='$e',adresse='$a' where id='$id'");
		return $req->execute();
		}catch(Exception $e){
			return false;
		}
		
	} 
	static function afficher_personne($var,$type){
		$con=DOA::getPDO();
		if($var==0)
		$req=$con->prepare("SELECT * FROM personne where type='$type'");
		else $req=$con->prepare("SELECT * FROM personne  where (id='$var' and type='$type') or (nom='$var' and type='$type')");
		$req->execute();
		return $req;
	}
	static function get_personne($id){
		$con=DOA::getPDO();
		$req=$con->prepare("SELECT * from personne where id='$id'");
		$req->execute();
		return $req;	
	}
	
	static function supprimer_personne($id){
		$con=DOA::getPDO();
		$req=$con->prepare("DELETE FROM personne where id='$id'");
		return $req->execute();
	}
	// Les methodes relative au gestion des produits...
	static function save_produit($n,$q,$pu,$pv,$pa,$c,$p){
		try{
		$con=DOA::getPDO();
		$req=$con->prepare("INSERT INTO produit values(null,'$n','$q','$pu','$pv','$pa','$c','$p')");
		return($req->execute());
		}catch(Exception $e){
			return false;
		}
	} 
	
	static function modify_produit($id,$n,$q,$pu,$pv,$pa,$cat,$photo){
		try{
		$con=DOA::getPDO();
		if($photo!=0)
			$req=$con->prepare("UPDATE produit set intitule='$n', 			 		 
			     qte='$q',prix_unitaire='$pu',prix_achat='$pa',prix_vente='$pv',
		cat='$cat',photo='$photo' where reference='$id'");
		else 
		$req=$con->prepare("UPDATE produit set intitule='$n', 
		 qte='$q',prix_unitaire='$pu',prix_achat='$pa',prix_vente='$pv',
		cat='$cat' where reference='$id'");
		$req->execute() ;
		return $req;
		}catch(EXCEPTION $e){
			return false;
		}
	}
	static function get_produit($id){
		$con=DOA::getPDO();
		$req=$con->prepare("SELECT * from produit where reference='$id'");
		$req->execute();
		return $req;	
	}
	static function afficher_produit($id){
		$con=DOA::getPDO();
		if($id==0)
		$req=$con->prepare("SELECT * FROM produit  JOIN categorie ON produit.cat=categorie.id_cat");
		else $req=$con->prepare("SELECT * FROM produit  JOIN categorie ON produit.cat=categorie.id_cat where
		produit.reference='$id' or produit.intitule='$id'");
		$req->execute();
		return $req;
	}
	static function afficher_produit_categorie($id){
		$con=DOA::getPDO();
		if($id==0)
		$req=$con->prepare("SELECT * FROM produit  JOIN categorie ON produit.cat=categorie.id_cat");
		else $req=$con->prepare("SELECT * FROM produit  JOIN categorie ON produit.cat=categorie.id_cat where
		cat='$id'");
		$req->execute();
		return $req;
	}
	static function supprimer_produit($id){
		$con=DOA::getPDO();
		$prod= DOA::get_produit($id);
		$prod=$prod->fetch();
		$file = $prod['photo'];

		if (file_exists($file)) {
 		 unlink($file);
		}
		$req=$con->prepare("DELETE FROM produit where reference='$id'");
		return $req->execute();
	}
	// gestion des categories
	
	static function save_categorie($n,$remarque){
		try{
			$con=DOA::getPDO();
        $req=$con->prepare("INSERT into categorie values (null,'$n','$remarque')");
        return $req->execute();
		}catch(Exception $e){
			return false;
		}
	}
		static function afficher_categorie($var){
			$con=DOA::getPDO();
			if($var==0) $req=$con->prepare("SELECT id_cat,Nom,remarque FROM categorie   ");
			else $req=$con->prepare("SELECT * FROM categorie where id_cat='$var' or
			Nom='$var' GROUP BY id_cat");
			$req->execute();
			return $req;
		}
		static function supprimer_categorie($id){
			$con=DOA::getPDO();
			$req=$con->prepare("DELETE FROM categorie where id_cat='$id'");
			return $req->execute();
		}
		static function modify_categorie($id,$n,$r){
			$con=DOA::getPDO();
			$req=$con->prepare("UPDATE categorie set Nom='$n', remarque='$r' where id_cat='$id'");
			if($req->execute()) return $req;
			return null;
		}
		static function get_categorie($id){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * from categorie where id_cat='$id'");
			$req->execute();
			return $req;	
		}
		static function prod_exist_pannier($id_prod,$qte,$t){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * FROM pannier where produit='$id_prod' and type='$t'");
			$req->execute();
			if($req->rowCount()>0){
				$req1=$con->prepare("SELECT * FROM produit where reference='$id_prod' and qte-'$qte'>=0");
				$req1->execute();
				return $req1->rowCount();
			}
			return -1;
		}
		static function ajouter_commande_pannier($p,$q,$t){
			try{
			$con=DOA::getPDO();
			if($t==0){
				//Verifier la disponibilité du stock
			if(DOA::verifier_stock($q,$p)>0){
			
				DOA::modifier_stock($q,$p);
				//Verifier si le produit existe déja dans la pannier
				if(DOA::prod_exist_pannier($p,$q,$t)>0){
					$req=$con->prepare("UPDATE pannier SET qte=qte+'$q' where produit='$p'");
				}else{
					$req=$con->prepare("INSERT INTO pannier values(null,'$p','$q','$t')");
				}
		}else {return false;	}
		}else{
			if(DOA::prod_exist_pannier($p,$q,$t)>0){
				$req=$con->prepare("UPDATE pannier SET qte=qte+'$q' where produit='$p'");
			}else{
				$req=$con->prepare("INSERT INTO pannier values(null,'$p','$q','$t')");
			}
		}		
		return $req->execute();
	}catch(PDOException $e){
   return false ;
	}
		}
		static function afficher_pannier($var){
			$con=DOA::getPDO();
			//if($var==0)
			 $req=$con->prepare("SELECT * FROM pannier  ");
			$req->execute();
			return $req;
		}
		static function nb_pannier($type){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("SELECT * FROM pannier where type='$type' ");
				$req->execute();
				return $req->rowCount();
			}catch(exception $e){
				return -1;
			}
		}
		static function get_date($type){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT date from pannier where type='$type' and id>=all(SELECT id fRom pannier where type='$type')");
			$req->execute();
			return $req;
		}
		
		static function verifier_stock($qte,$prod){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * from produit where reference='$prod' and qte-'$qte'>=0");
			$req->execute();
			return $req->rowCount();
		}
		static function modifier_stock($qte,$prod){
			try{
			$con=DOA::getPDO();
			$req=$con->prepare("UPDATE produit set qte=qte-'$qte' where reference='$prod'");
			return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function supprimer_stock($qte,$prod){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("UPDATE produit set qte=qte+'$qte' where reference='$prod'");
				return $req->execute();
				}catch(EXCEPTION $e){
					return false;
				}
		}
		static function get_pannier($type){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT p.id,p.qte,pr.intitule,p.produit,pr.prix_vente from pannier p JOIN produit pr  ON p.produit=pr.reference where  type='$type'");
			$req->execute();
			return $req;
		}
		static function vider_pannier($var){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("DELETE FROM pannier where id='$var'");
				return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function ajouter_ligne($ncom,$prod,$qte){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("INSERT INTO detail values('$ncom','$prod','$qte')");
				return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function get_commande(){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT id_com from commande where id_com>=all(SELECT id_com from commande)");
			$req->execute();
			return $req;
		}
		static function get_commande_id($id,$id_cli,$pro){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id 
			and D.ncom=Com.id_com and P.reference=D.nprod and (Com.id_com='$id' and cli.id='$id_cli' and P.reference='$pro')");
			$req->execute();
			return $req;
		}
		static function ajouter_commande($cli,$date){
			try{
			$con=DOA::getPDO();
			$req=$con->prepare("INSERT INTO commande values(null,'$cli','$date')");
			return $req->execute();
		}catch(EXCEPTION $e){
			return false;
		}
		}
		static function supprimer_commande($id){
			try{
				$con=DOA::getPDO();
			$req=$con->prepare("DELETE FROM commande where id_com='$id'");
			return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function supprimer_ligne_commande($id_com,$id_pro){
			try{
				$con=DOA::getPDO();
			$req=$con->prepare("DELETE FROM detail where ncom='$id_com' and nprod='$id_pro' ");
			return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function modifier_commande_pannier($id,$pro,$qte,$date){
			try{
			$con=DOA::getPDO();
		$req=$con->prepare("UPDATE pannier set produit='$pro', qte='$qte',date='$date' where id='$id'");
		if($req->execute()) return $req;}
		catch(exception $e){
			return false;
		}
		}
		static function verifier_nombre_commande($id_com){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * from detail where ncom='$id_com'");
			$req->execute();
			return $req->rowCount();
		}
		static function afficher_all_commande(){
			try{
				$con=DOA::getPDO();
					$req=$con->query("SELECT * FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id 					and D.ncom=Com.id_com and P.reference=D.nprod;");
		
			    return $req;
			}catch(EXCEPTION $e){
				return null;
			}
		} 
		static function afficher_commande($id){
			try{
				$con=DOA::getPDO();
				if($id==0)
				$req=$con->query("SELECT * FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id 					and D.ncom=Com.id_com and P.reference=D.nprod;");
				else $req=$con->prepare("SELECT * FROM commande Com,personne cli,produit P,detail D where Com.id_cli=cli.id 
				and D.ncom=Com.id_com and P.reference=D.nprod and (Com.id_com='$id' or cli.id='$id' or cli.nom='$id')");
				$req->execute();
				return $req;
			}catch(EXCEPTION $e){
				return false;
			}
		} 
		static function modify_commande($id_com,$id_cli,$date){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("UPDATE commande set id_cli='$id_cli', date='$date' where id_com='$id_com'");
				return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		// GESTION DE CAISSE
		static function ajouter_ticket($produit,$qte,$prix_v){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("INSERT INTO ticket values(null,'$produit','$qte','$prix_v')");
				return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		
		static function ajouter_ticket_histo(){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("INSERT INTO ticket_histo values(null,now())");
				return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function get_id_ticket(){
			$con=DOA::getPDO();
				$req=$con->prepare("SELECT id_ticket From ticket_histo where id_ticket>=all(SELECT id_ticket From ticket_histo)");
				 $req->execute();
				 return $req;
		}
		static function get_ticket(){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * from ticket");
			$req->execute();
			return $req;
		}
		static function ajouter_ligne_caisse($id_ticket,$id_prod,$qte,$prix_v){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("INSERT INTO ticket_detail values('$id_ticket','$id_prod','$qte','$prix_v')");
				return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}

			
		}
		static function afficher_ticket(){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("SELECT T.qte,T.prix_v,P.intitule,T.id_ticket,T.produit FROM ticket T,produit P where T.produit=P.reference;");
				$req->execute();
				return $req;
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function afficher_total(){
			
			$con=DOA::getPDO();
			$sql=$con->prepare("SELECT SUM(T.qte*prix_v) as total FROM ticket T JOIN produit P ON T.produit=P.reference");
			$sql->execute();
			return $sql;
		}
		static function prod_exist_ticket($id_prod){
			$con=DOA::getPDO();
			$req=$con->prepare("SELECT * FROM ticket where produit='$id_prod'");
			$req->execute();
			return $req->rowCount();
		}
		static function supprimer_ticket($id){
			try{
				$con=DOA::getPDO();
			$req=$con->prepare("DELETE FROM ticket where id_ticket='$id'");
			return $req->execute();
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function vider_ticket(){
			$con=DOA::getPDO();
			$req=$con->prepare("DELETE FROM ticket");
			return $req->execute();
		}
		// LES APPROVISIONNEMENTS...
		static function afficher_appro($id){
			try{
				$con=DOA::getPDO();
				if($id==0)
				$req=$con->prepare("SELECT * FROM approvisionnement app,personne four,produit P,apro_detail D where app.id_four=four.id and D.n_apro=app.numero and P.reference=D.nprod;");
				else $req=$con->prepare("SELECT * FROM approvisionnement app,personne four,produit P,apro_detail D where  app.id_four=four.id and D.n_apro=app.numero and P.reference=D.nprod
				 and (app.numero='$id' or four.id='$id' or four.nom='$id')");
				$req->execute();
				return $req;
			}catch(EXCEPTION $e){
				return false;
			}
		}
		static function ajouter_appro($four,$date){
			try{
			$con=DOA::getPDO();
			$req=$con->prepare("INSERT INTO approvisionnement values(null,'$four','$date')");
			return $req->execute();
		}catch(EXCEPTION $e){
			return false;
		}
		}
		static function ajouter_stock($qte,$prod){
			try{
				$con=DOA::getPDO();
				$req=$con->prepare("UPDATE produit set qte=qte+'$qte' where reference='$prod'");
				return $req->execute();
				}catch(EXCEPTION $e){
					return false;
				}
			}
			static function get_appro(){
				$con=DOA::getPDO();
				$req=$con->prepare("SELECT numero from approvisionnement where numero>=all(SELECT numero from approvisionnement)");
				$req->execute();
				return $req;
			}
			static function ajouter_ligne_apro($numero,$produit,$qte){
				$con=DOA::getPDO();
				$req=$con->prepare("INSERT INTO apro_detail values('$numero','$produit','$qte')");
				return $req->execute();
			}
			static function supprimer_stock_apro($qte,$prod){
				try{
					$con=DOA::getPDO();
					$req=$con->prepare("UPDATE produit set qte=qte-'$qte' where reference='$prod'");
					return $req->execute();
					}catch(EXCEPTION $e){
						return false;
					}
				}
				static function verifier_nombre_apro($id_com){
					$con=DOA::getPDO();
					$req=$con->prepare("SELECT * from apro_detail where n_apro='$id_com'");
					$req->execute();
					return $req->rowCount();
				}
				static function supprimer_ligne_apro($id_com,$id_prod){
					try{
						$con=DOA::getPDO();
					$req=$con->prepare("DELETE FROM apro_detail where n_apro='$id_com' and nprod='$id_prod' ");
					return $req->execute();
					}catch(EXCEPTION $e){
						return false;
					}
				}	
				static function supprimer_apro($id){
					try{
						$con=DOA::getPDO();
					$req=$con->prepare("DELETE FROM approvisionnement where numero='$id'");
					return $req->execute();
					}catch(EXCEPTION $e){
						return false;
					}
				}	
				static function modify_apro($id_com,$id_cli,$date){
					try{
						$con=DOA::getPDO();
						$req=$con->prepare("UPDATE approvisionnement set id_four='$id_cli', date='$date' where numero='$id_com'");
						
						return $req->execute();
					}catch(EXCEPTION $e){
						return false;
					}
				}
				static function get_apro_id($id,$id_cli,$pro){
					$con=DOA::getPDO();
					$req=$con->prepare("SELECT * FROM approvisionnement Com,personne cli,produit P,apro_detail D where Com.id_four=cli.id 
			and D.n_apro=Com.numero and P.reference=D.nprod and (Com.numero='$id' and cli.id='$id_cli' and P.reference='$pro')");
					$req->execute();
					return $req;
				}
}	
?>