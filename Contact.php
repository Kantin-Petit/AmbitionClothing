<!DOCTYPE html>
<html>
<head>
	<title>AMBITION</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<div id="container">
<body>
	<!-- entete -->
	<header>
		<p></p>
		<p class="titre_page">Contact</p>
	</header>

	<!-- menu de navigation -->
	<nav>
		<ul>
			<li><img src="img/Logo.PNG"></li>
			<li><a href="Vetements.php">Vétements</a>
				<ul>
					<li><a href="Vetements.php"> Voir tout</a></li>
					<li><a href="Vetements.php#T-shirts"> T-shirts</a></li>
					<li><a href="Vetements.php#Sweats">Sweats</a></li>
					<li><a href="Vetements.php#Casquettes"> Casquettes</a></li>
				</ul>
			</li>
			<li><a href="Collection.php">Collection</a></li>
			<li><a href="La marque.php">La marque</a></li>
			<li><a href="Contact.php">Contact</a></li>
			<li><a href="Mon compte.php">Mon compte</a>
				<ul>
					<li><a href="Mon compte.php#Mes commandes"> Mes commandes</a></li>
					<li><a href="Mon compte.php#Mes avoirs"> Mes avoirs</a></li>
					<li><a href="Mon compte.php#Mes adresses"> Mes adresses</a></li>
					<li><a href="Mon compte.php#Mes informations personnelles"> Mes informations personnelles</a></li>
					<li><a href="Mon compte.php#Mes bons de réductions"> Mes bons de réductions</a></li>
					<li><a href="Mon compte.php#Mes récompense"> Mes récompenses</a></li>
				</ul>
			</li>
		</ul>
	</nav>


	<div class="form">
			<form method="post" id="mail">
				<p>Envoyer un mail</p>
				<input type="text" name="nom" id="nom" placeholder="Votre nom" required>
				<input type="text" name="prenom" id="prenom" placeholder="Votre prenom" required>
				<input type="text" name="email" id="email" placeholder="Votre email" required>
				<input class="champ" type="text" name="contmail" id="contmail" placeholder="Votre mail" required>
				<input type="submit" name="envmail" id="envmail" value="Envoyer">
				<?php
					if(isset($_POST['envmail']))
					{
						$retour = mail('LucasDelrieux@yahoo.fr', 'Envoi depuis la page Contact de Ambition', $nom . $prenom . "," . $mail . "," . $contmail);
			    	if ($retour) 
			    	{
			        	echo '<p>Votre message a bien été envoyé.</p>';
			    	}
					}
			    ?>
			</form>
		</div>






	
	
</body>
<!-- pied de page -->
<footer>
		<a href="Mention Legale.php">Mentions légales     </a>
		<a href="CGV.php">Conditions générales de vente     </a>
		<a>All right reserved to AMBITION CLOTHING</a>
</footer>
</div>

</html>