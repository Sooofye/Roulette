<?php	
session_start();
if (!isset($_SESSION)) {
	header('location: index.php');
	exit;
}
require_once "../model/DAO_utilisateurs.php";
require_once "../model/DAO_game.php";
$bdd = new DAO_utilisateurs();
$bdd2 = new DAO_game();

// genère le jeu
$messageJeu='';
$gain=0;
$nbre = rand (1,36);
$pari = $nbre%2;
if ($pari ==1) {
	$pari='impair';
} else {
	$pari = 'pair';
}

// Met à jour argent disponible

$_SESSION['argent'] = $bdd->argentDispo($_SESSION['id']);

//traitement du formulaire de jeu
$erreur='';
if (isset($_POST['btnJouer'])) { 
	$mise = htmlspecialchars($_POST['mise']);
	$messageJeu = '';
	if (empty($mise)) {
		$erreur='Veuillez entrer une mise';
	} else if ($mise>$_SESSION['argent']) {
		$erreur='Vous ne pouvez pas miser plus d\'argent que ce que vous n\'en détenez';
	} else {
		if (empty($_POST['parite']) && empty($_POST['nombre'])) {
			$erreur='Veuillez choisir un mode de jeu !';
		} else if (!empty($_POST['parite']) && (!empty($_POST['nombre']))) {
			$erreur='Merci de ne choisir qu\'un seul mode de jeu !';
			unset($_POST);
			} else {
				if (!empty($_POST['nombre'])){
					if ($_POST['nombre'] == $nbre) {
						$gain = $mise*35;
						$_SESSION['argent'] = $_SESSION['argent'] + $gain;
						$messageJeu='Vous avez misé sur le '.$_POST['nombre'].' et c\'est le '.$nbre.' qui a été tiré. Bravo, vous avez gagné '.$gain.' euros';
					} else {
						$gain=-$mise;
						$_SESSION['argent'] = $_SESSION['argent'] - $mise;
						$messageJeu='Vous avez misé sur le '.$_POST['nombre'].' et c\'est le '.$nbre.' qui a été tiré. Oups, vous avez perdu '.$mise.' euros';
				}
				} else if (!empty($_POST['parite'])){
					if ($_POST['parite'] == $pari) {
						$gain = $mise*2;
						$_SESSION['argent'] = $_SESSION['argent'] + $gain;
						$messageJeu='Vous avez misé que le nombre serait '.$_POST['parite'].' et c\'est le '.$nbre.' qui a été tiré. Bravo, vous avez gagné '.$gain.' euros';
					} else {
						$gain=-$mise;
						$_SESSION['argent'] = $_SESSION['argent'] - $mise;
						$messageJeu='Vous avez misé que le nombre serait '.$_POST['parite'].' et c\'est le '.$nbre.' qui a été tiré. Oups, vous avez perdu '.$mise.' euros';
					}
					$erreur='';
				}
				$bdd->majArgent($_SESSION['argent'],$_SESSION['id']);
				$bdd2->enregistrementPartie($_SESSION['id'],$mise,$gain);
				$erreur='';
			}
		}
}

?>
<!DOCTYPE html>
<html lang="fr">
	
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../view/style.css" media="screen"/>
	<title>Roulette</title>
</head>

<?php include("../view/header.php"); ?>
	

<main class="container">
		<section>
			<h2 id="hello">Bonjour <?php echo $_SESSION['username']; ?></h2>
			<p><a href="index.php?deco">Deconnexion</a></p>
			<?php
				if ($erreur!='') {
					echo $erreur;
				} ?>
				<p><?= $messageJeu; ?></p>
				<p>Vous disposez au total de <?= $_SESSION['argent']; ?> euros.</p>
				<?php include "../view/formuRoulette.php"; ?>
		</section>
</main>
     
<?php include("../view/footer.php"); ?>
     
</html>
