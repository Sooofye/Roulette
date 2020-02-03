<?php
if(empty($_SESSION['username'])) {
  Header('Location: index.php');
  exit();
}
?>

<header class="top">

	<section class="entete">
		<h1>La roulette : jeu de hasard</h1>
	</section>

</header>

</html>
	
