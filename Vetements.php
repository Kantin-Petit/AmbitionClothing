<?php session_start();
include 'database.php';
global $db;
header( 'content-type: text/html; charset=utf-8' );

?>

<!DOCTYPE html>
<html>
<head>
	<title>AMBITION</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<div id="container">
<body>
	<!-- entete -->
	<header>
		<p></p>
		<p class="titre_page">Boutique</p>
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

	<?php 
	if (!isset($_SESSION['numero'])) 
	{
		?>
		<div id="T-shirts">
			<p align="center"> T-shirt </p>
			<?php

				$q = $db->prepare("SELECT * FROM boutique WHERE type='tshirts'");
				$q -> execute();
				while($tshirts=$q->fetch())
				{
					?>
					<div class="vete" align="center">
					<?php
					echo '<img class="vet" src="'. $tshirts['img'].'">';
					echo '<p>'.$tshirts['nom'].'</p><br>';
					echo '<p class="bprix">'.$tshirts['prix'].'€ </p><br>';
					echo '<form method="post"><input type="submit" name="'.$tshirts['numero'].'" id="'.$tshirts['numero'].'" value="voir"></form>';
					if (isset($_POST[$tshirts['numero']])) 
					{
						$_SESSION['numero'] = $tshirts['numero'];
						header('Location:Vetements.php');
					}
					?>
					</div>
					<?php
				}
			?>
		</div>

		
		<div id="Sweats">
			<p align="center"> Sweats </p>
			<?php
				$q = $db->prepare("SELECT * FROM boutique WHERE type='sweats'");
				$q -> execute();
				while($sweet=$q->fetch())
				{
					echo '<img class="vet" src="'. $sweet['img'].'">';
					echo '<p>'.$sweet['nom'].'</p><br>';
					echo '<p class="bprix">'.$sweet['prix'].'€ </p><br>';
					echo '<form method="post"><input type="submit" name="'.$sweet['numero'].'" id="'.$sweet['numero'].'" value="voir"></form>';
					if (isset($_POST[$sweet['numero']])) 
					{
						$_SESSION['numero'] = $sweet['numero'];
					}
				}
			?>
		</div>

		<div id="Casquettes">
			<p align="center"> Casquette </p>
			<?php
				$q = $db->prepare("SELECT * FROM boutique WHERE type='casquettes'");
				$q -> execute();
				while($casquette=$q->fetch())
				{
					echo '<img class="vet" src="'. $casquette['img'].'">';
					echo '<p>'.$casquette['nom'].'</p><br>';
					echo '<p class="bprix">'.$casquette['prix'].'€ </p><br>';
					echo '<form method="post"><input type="submit" name="'.$casquette['numero'].'" id="'.$casquette['numero'].'" value="voir"></form>';
				}
			?>
		</div>
	<?php
	}
	else
	{
		?>
			<div class="article">
				<?php
				$q = $db->prepare("SELECT * FROM boutique WHERE numero='".$_SESSION['numero']."'");
				$q -> execute();
				if($article=$q->fetch())
				{
					?>
					
					<div id="article">
						<div class="bout">
							<?php
							echo '<img width="300px" src="'. $article['img'].'">';
							?>
						</div>
						<div class="bout">
							<?php
							echo "<br><p>Collection :".$article['collection']."</p>";
							echo "<br><p>nom :".$article['nom']."</p>";
							echo "<br><p width='350px'>description :".$article['description']."</p>";
							echo "<br><p>".$article['prix']."€</p>";
							?>
							<form method="post">
							<p>Ajouté au panier</p>
							<input type="submit" name="S" id="tailleS" value="S">
							<input type="submit" name="M" id="tailleM" value="M">
							<input type="submit" name="L" id="tailleL" value="L">
							<input type="submit" name="XL" id="tailleXL" value="XL">
							<input type="submit" name="XXL" id="tailleXXL" value="2XL">
							</form>
						</div>
					</div>
					<?php
					if (isset($_POST['S'])) 
					{
						if(isset($_SESSION['id']))
						{
							$a = $db->prepare("INSERT INTO `mon_compte`(`id`, `article`, `taille`, `etat`, `prix`, `numero`) VALUES ('".$_SESSION['id']."','".$article['nom']."','S','panier','".$article['prix']."','".$article['numero']."')");
							$a->execute();
							echo "cet article as été ajouté a votre panier";
							unset($_SESSION['numero']);
							unset($_POST['S']);
							header('Location : Vetements.php');
							exit();
						}
						else
						{
							header('Location: Mon%20compte.php');
						}
					}
					elseif (isset($_POST['M'])) 
					{
						if(isset($_SESSION['id']))
						{
							$a = $db->prepare("INSERT INTO `mon_compte`(`id`, `article`, `taille`, `etat`, `prix`, `numero`) VALUES ('".$_SESSION['id']."','".$article['nom']."','M','panier','".$article['prix']."','".$article['numero']."')");
							$a->execute();
							echo "cet article as été ajouté a votre panier";
							unset($_SESSION['numero']);
							unset($_POST['M']);
							header('Location : Vetements.php');
							exit();
						}
						else
						{
							header('Location: Mon%20compte.php');
						}
					}
					elseif (isset($_POST['L'])) 
					{
						if(isset($_SESSION['id']))
						{
							$a = $db->prepare("INSERT INTO `mon_compte`(`id`, `article`, `taille`, `etat`, `prix`, `numero`) VALUES ('".$_SESSION['id']."','".$article['nom']."','L','panier','".$article['prix']."','".$article['numero']."')");
							$a->execute();
							echo "cet article as été ajouté a votre panier";
							unset($_SESSION['numero']);
							unset($_POST['L']);
							header('Location : Vetements.php');
							exit();
						}
						else
						{
							header('Location: Mon%20compte.php');
						}
					}
					elseif (isset($_POST['XL'])) 
					{
						if(isset($_SESSION['id']))
						{
							$a = $db->prepare("INSERT INTO `mon_compte`(`id`, `article`, `taille`, `etat`, `prix`, `numero`) VALUES ('".$_SESSION['id']."','".$article['nom']."','XL','panier','".$article['prix']."','".$article['numero']."')");
							$a->execute();
							echo "cet article as été ajouté a votre panier";
							unset($_SESSION['numero']);
							unset($_POST['XL']);
							header('Location : Vetements.php');
							exit();
						}
						else
						{
							header('Location: Mon%20compte.php');
						}
					}
					elseif (isset($_POST['XXL'])) 
					{
						if(isset($_SESSION['id']))
						{
							$a = $db->prepare("INSERT INTO `mon_compte`(`id`, `article`, `taille`, `etat`, `prix`, `numero`) VALUES ('".$_SESSION['id']."','".$article['nom']."','XXL','panier','".$article['prix']."','".$article['numero']."')");
							$a->execute();
							echo "cet article as été ajouté a votre panier";
							unset($_SESSION['numero']);
							unset($_POST['XXL']);
							header('Location : Vetements.php');
							exit();
						}
						else
						{
							header('Location: Mon%20compte.php');
						}
					}
				}
			?>
			</div>
		<?php
	}
	?>
	
	


	
	
</body>
<!-- pied de page -->
<footer>
		<a href="Mention Legale.php">Mentions légales</a>
		<a href="CGV.php">Conditions générales de vente</a>
		<a>All right reserved to AMBITION CLOTHING</a>
</footer>
</div>

</html>