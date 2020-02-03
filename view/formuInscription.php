<h2>Inscrivez-vous</h2>
<form action="index.php?module=inscription" method="post">
	<p>
		<label for="nom">Choisissez votre surnom :</label>
		<input type="text" name="nom" id="nom" placeholder="Surnom" /><br />
		<label for="pass">Votre mot de passe :</label>
		<input type="password" name="pass" id="pass" /><br />
		<label for="confirm">Confirmez votre mot de passe :</label>
		<input type="password" name="confirm" /><br />
		<input type="submit" name="btnInscrit" value="Valider">
	</p>
</form>
<p><a href="index.php?module=connexion">Vous étiez déjà enregistré ? Connectez-vous !</a></p>