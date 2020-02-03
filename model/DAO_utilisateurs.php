<?php

class DAO_Utilisateurs {

	private $hote = 'localhost';
	private $nomBase = 'p1920328';
	private $nomUtil = 'p1920328';
	private $mdp = '466805';
	
	public function __construct() {
		try {
			$this->bdd = new PDO('mysql:host='.$this->hote.';dbname='.$this->nomBase.';charset=utf8', $this->nomUtil, $this->mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}
	
	public function testConnexion($surnom,$pass) {
		$requete = 'SELEct pass FROM utilisateurs WHERE surnom= ? ';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute(array($surnom));
		$pass_verif = $dem->fetch();
		$dem->closeCursor();
		return $pass_verif;
	}
	
	public function connexion($surnom) {
		$requete = 'SELEct * FROM utilisateurs WHERE surnom= ?';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute(array($surnom));
		$sql = $dem->fetch();
		$_SESSION['id'] = $sql['id'];
		$_SESSION['argent'] = $sql['argent'];
		$dem->closeCursor();
	}
	
	public function testInscription($surnom) {
		$requete = 'SELEct surnom FROM utilisateurs WHERE surnom= ?';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute( array($surnom));
		$surnomverif = $dem->rowCount();
		$dem->closeCursor();
		return $surnomverif;
	}
	
	public function inscription($surnom,$pass) {
		$req = ($this->bdd)->prepare('INSERT INTO utilisateurs (surnom, pass) VALUES(?, ?)');
		$req->execute(array($surnom, $pass));
		$req->closeCursor();
		$requete = 'SELEct * FROM utilisateurs WHERE surnom= ? ';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute(array($surnom));
		$sql = $dem->fetch();
		$_SESSION['id'] = $sql['id'];
		$_SESSION['argent'] = $sql['argent'];
		$dem->closeCursor();
	}
	
	public function argentDispo($id) {
		$requete = 'SELECT argent FROM utilisateurs WHERE id = ?';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute(array($id));
		$montant = $dem->fetch();
		$dem->closeCursor();
		return $montant['argent'];
	}
	
	public function majArgent($somme,$id) {
		$requete = 'UPDATE utilisateurs SET argent = ? WHERE id = ?';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute(array($somme,$id));
		$dem->closeCursor();
	}
	
}






?>