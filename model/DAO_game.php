<?php

class DAO_Game {

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
	
	public function enregistrementPartie($id,$mise,$gain) {
		$requete = 'INSERT INTO game(player, date, bet, profit) VALUES (?,CURRENT_TIMESTAMP,?,?)';
		$dem = ($this->bdd)->prepare($requete);
		$dem->execute(array($id,$mise,$gain));
		$dem->closeCursor();
	}
	
}






?>