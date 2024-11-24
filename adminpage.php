<?php session_start();

?>
<?php 
	include 'database.php';
	global $db;
if($_SESSION['id'] == 0)
{

?>

<!DOCTYPE html>
<html>
<head>
	<title>AMBITION</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
	<!-- entete -->
	<header>
		<p></p>
		<p class="titre_page">Mon compte</p>
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
					<li><a href="Mon compte.php#Mes_récompense"> Mes récompenses</a></li>
					<?php 
					if(isset($_SESSION['id']))
					{
					?>
						<li><a href="deconnexion.php">Déconnexion</a></li>
						<?php
						if($_SESSION['id'] == 0)
						{
							?>
							<li><a href="adminpage.php">Admin page</a></li>
							<?php
						}

					}
					?>
				</ul>
			</li>
		</ul>
	</nav>

	<div id="Les_Commandes" align="center">

		<p>Les commandes</p>

		<?php 
			$q = $db->prepare("SELECT * FROM mon_compte WHERE etat = 'commmande' ORDER BY nombre");
			$q -> execute();
		?> 
		<table id="tableau">
			<thead>
				<tr>
					<th>
						<p>nom</p>
					</th>
					<th>
						<p>article</p>
					</th>
					<th>
						<p>adresse</p>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
						if ($ligne=$q->fetch()) 
						{
							?>
							<tr>
								<td>
									<?php echo $ligne['Nom Prenom']; ?>
								</td>
								<td>
									<?php echo $ligne['article']; ?>
								</td>
								<td>
									<?php echo $ligne['taille']; ?>
								</td>
								<td>
									<form method="post">
									<input type="submit" name="validé" id="validé" value="envoyer" >
									</form>
									<?php
										if (isset($_POST['validé'])) 
										{
											$d = $db->prepare( 'UPDATE `mon_compte` SET `etat`="envoyer" WHERE nombre = "'.$ligne['nombre'].'"');
											$d -> execute();
											header('Location: Mon compte.php');
											exit();

										}
									?>
								</td>
							</tr>
							<?php
								while ($ligne=$q->fetch()) 
								{
							?>
									<tr>
										<td>
											<?php echo $ligne['Nom Prenom']; ?>
										</td>
										<td>
											<?php echo $ligne['article']; ?>
										</td>
										<td>
											<?php echo $ligne['taille']; ?>
										</td>
										<td>
											<form method="post">
											<input type="submit" name="validé" id="validé" value="envoyer" >
											</form>
										<?php
											if (isset($_POST['validé'])) 
											{
												$d = $db->prepare( 'UPDATE `mon_compte` SET `etat`="envoyer" WHERE nombre = "'.$ligne['nombre'].'"');
												$d -> execute();
												header('Location: Mon compte.php');
												exit();
											}
											?>
										</td>
									</tr>
									<?php
								}
							}
							else
							{
								?>
									<tr>
										<td>
											Il n'y as aucun article en attente.
										</td>
									</tr>
								<?php
							}

						?>
					</tr>
				</tbody>
			</table>
	</div>

	<div id="nouveau">
		<form method="post" enctype="multipart/form-data"  action="upload.php">
			<div>
				<p align="center">Nouveaux articles</p>
				<input name="picture" type="file" required>
				<input type="text" id="nom" name="nom" placeholder="Le nom" required>
				<input type="text" id="collection" name="collection" placeholder="La collection" required>
				<input type="text" id="description" name="description" placeholder="La description" required>
				<input type="text" id="prix" name="prix" placeholder="Le prix" required>
				<input type="text" id="type" name="type" placeholder="tshirts/sweats/casquettes" required><p>attention pour le type de vetements il faut la même orthographe que moi : tshirts/sweats/casquettes</p>
				<input type="submit" name="new" id="new" placeholder="envoyer">
				

			</div>
		</form>
	</div>






	<div id="Les_stocks" align="center">

		<p>Les stocks</p>

		<?php 
			$q = $db->prepare("SELECT * FROM boutique ORDER BY numero");
			$q -> execute();
		?>

		<table id="tableau">
			<thead>
				<tr>
					<th>
						<p>image</p>
					</th>
					<th>
						<p>article</p>
					</th>
					<th>
						<p>stocks</p>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
						if ($ligne=$q->fetch()) 
						{
							?>
							<tr>
								<td>
									<?php echo '<img src="'.$ligne['img'].'">'; ?>
								</td>
								<td>
									<?php echo $ligne["nom"]; ?>
								</td>
								<form method="post">
									<td>

										<?php echo '<input type="text" size="3" name="S" id="S" value="S'.$ligne['stockS'].'">'; ?>
										<?php echo '<input type="text" size="3" name="M" id="M" value="M'.$ligne['stockM'].'">'; ?>
										<?php echo '<input type="text" size="3" name="L" id="L" value="L'.$ligne['stockL'].'">'; ?>
										<?php echo '<input type="text" size="3" name="XL" id="XL" value="XL'.$ligne['stockXL'].'">'; ?>
										<?php echo '<input type="text" size="3" name="XXL" id="XXL" value="XXL'.$ligne['stockXXL'].'">'; ?>
									</td>
									<td>
									
										<input type="submit" name="validé" id="validé" value="validé" >
								</form>
									<?php
										if (isset($_POST['validé'])) 
										{
											$d = $db->prepare( 'UPDATE `boutique` SET `stockS`="'.$_POST['S'].'", `stockM`="'.$_POST['M'].'", `stockL`="'.$_POST['L'].'", `stockXL`="'.$_POST['XL'].'", `stockXXL`="'.$_POST['XXL'].'"  WHERE `numero` = "'.$ligne['numero'].'"');
											$d -> execute();
											header('Location: Mon compte.php');
											exit();

										}
									?>
								</td>
							</tr>
							<?php
								while ($ligne=$q->fetch()) 
								{
								?>
									<tr>
										<td>
											<?php echo '<img src="'.$ligne['img'].'">'; ?>
										</td>
										<td>
											<?php echo $ligne["nom"]; ?>
										</td>
								<form method="post">
									<td>

										<?php echo '<input type="text" size="3" name="S" id="S" value="S'.$ligne['stockS'].'">'; ?>
										<?php echo '<input type="text" size="3" name="M" id="M" value="M'.$ligne['stockM'].'">'; ?>
										<?php echo '<input type="text" size="3" name="L" id="L" value="L'.$ligne['stockL'].'">'; ?>
										<?php echo '<input type="text" size="3" name="XL" id="XL" value="XL'.$ligne['stockXL'].'">'; ?>
										<?php echo '<input type="text" size="3" name="XXL" id="XXL" value="XXL'.$ligne['stockXXL'].'">'; ?>
									</td>
									<td>
									
										<input type="submit" name="validé" id="validé" value="validé" >
								</form>
									<?php
										if (isset($_POST['validé'])) 
										{
											$d = $db->prepare( 'UPDATE `boutique` SET `stockS`="'.$_POST['S'].'", `stockM`="'.$_POST['M'].'", `stockL`="'.$_POST['L'].'", `stockXL`="'.$_POST['XL'].'", `stockXXL`="'.$_POST['XXL'].'"  WHERE `numero` = "'.$ligne['numero'].'"');
											$d -> execute();
											header('Location: Mon compte.php');
											exit();

										}
									?>
								</td>
							</tr>
							<?php
								}
							}

						?>
					</tr>
				</tbody>
			</table>
	</div>








	</body>
<!-- pied de page -->
<footer>
		<a href="Mention Legale.php">Mentions légales     </a>
		<a href="CGV.php">Conditions générales de vente     </a>
		<a>All right reserved to AMBITION CLOTHING</a>
</footer>


</html>
<?php
}
else
{
	header('location: Mon compte.php');
}
?>