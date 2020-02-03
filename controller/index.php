<?php
session_start();

//traitement deconnexion
if (isset($_GET['deco'])) {
	session_destroy();
}
if (isset($_SESSION['username'])) {
	header('location: roulette.php');
	exit;
}
if (!isset($_GET['module'])) {
	$_GET['module']='';
}

$erreur='';


require_once "../model/DAO_utilisateurs.php";
$bdd = new DAO_utilisateurs();

//traitement de la connexion
if (isset($_POST['btnValider'])) { 
	$surnom = htmlspecialchars($_POST['surnom']);
	if (empty($surnom)){
		$erreur = 'Attention, le surnom est nécessaire !';
	} else {
		$erreur = '';
		$pass_co = htmlspecialchars($_POST['pass']);
		if (empty($pass_co)){
			$erreur = 'Vous n\'oubliez rien ? Et le mot de passe ?';
		} else {
			$pass_verif = $bdd->testConnexion($surnom,$pass_co);
			if (empty($pass_verif)) {
				$erreur = 'Désolé, ce surnom n\'est pas connu...';
			} else if (!(password_verify($pass_co, $pass_verif['pass']))) {
				$erreur = 'Attention, le mot de passe ne correspond pas.';
			} else {
				$_SESSION['username'] = $surnom;
				$bdd->connexion($surnom);
				header('Location: roulette.php');
			}
		}
	}
}

// Traitement du questionnaire si "effacer"
if (isset($_POST['btnEffacer'])) {
	unset($_POST);
}


// Hachage du mot de passe
if (isset($_POST['btnInscrit'])) { 
	$surnom = htmlspecialchars($_POST['nom']);
	if (empty($surnom)){
		$erreur = 'Attention, le surnom est nécessaire !';
	} else {
		$erreur = '';
		if ((htmlspecialchars($_POST['pass']) == htmlspecialchars($_POST['confirm']))) {
			if (!empty(htmlspecialchars($_POST['pass']))){
				$pass_hache = password_hash(htmlspecialchars($_POST['pass']), PASSWORD_DEFAULT);
				$surnomverif = $bdd->testInscription($surnom);
				if ($surnomverif>0) {
					$erreur = 'Ce surnom est déjà utilisée.';
				} else {
					$_SESSION['username'] = $surnom;
					$bdd->inscription($surnom,$pass_hache);
					header('Location: roulette.php');
				}
			} else {
				$erreur = 'Vous devez definir un mot de passe, même moche.';
			}
		} else {
			$erreur = 'Vos mots de passe sont différents, retentez !';
		}
	}
}

?>

<!DOCTYPE html>

<html lang="fr">
	
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../view/style.css" media="screen"/>
	<title>Connexion</title>
</head>

<?php include("../view/headerbis.php"); ?>

<main class="container">
		<section>
				<?php if ($erreur!='') {
						echo $erreur;
					}
					if ($_GET['module']=='inscription') {
						include "../view/formuInscription.php";
					} else {
						include "../view/formuConnexion.php";
					}
				?>
		</section>
</main>
     
<?php include("../view/footer.php"); ?>
     
</html>
