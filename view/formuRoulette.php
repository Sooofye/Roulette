<form action="roulette.php" method="post">
	<p>
		<label for="mise">Entrez votre mise :</label>
		<input type="text" name="mise" id="mise" placeholder="Votre mise" /><br />
	</p>
		<fieldset>
			<legend>Miser sur un nombre :</legend>
			<input type="number" name="nombre" id="nombre" min="1" max="36"/><br />
		</fieldset>
		<p>ou</p>
		<fieldset>
			<legend>Miser sur la parite :</legend>
			<input type="radio" name="parite" value="pair" id="parite" />
			<label for="parite"> Pair</label>
			<input type="radio" name="parite" value="impair" id="parite" />
			<label for="parite"> Impair</label>
		</fieldset>
		<input type="submit" name="btnJouer" value="Jouer">
</form>