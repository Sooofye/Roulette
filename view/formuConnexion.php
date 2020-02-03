<h2>Connectez-vous</h2>
<form action="index.php?module=connexion" method="post">
	<p>
		<label for="surnom">Votre surnom :</label>
		<input type="text" name="surnom" id="surnom" placeholder="Surnom" /><br />
		<label for="pass">Votre mot de passe :</label>
		<input type="password" name="pass" id="pass" /><br />
		<input type="submit" name="btnValider" value="Valider">
		<input type="submit" value="Effacer" />
	</p>
</form>
<p><a href="index.php?module=inscription">Pas encore inscrit ? Inscrivez-vous !</a></p>