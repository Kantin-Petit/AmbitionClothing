<?php session_start();

?>
<?php 
	include 'database.php';
	global $db;
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






	<?php 
	if(!isset($_SESSION['id']))
	{
	?>
		<div class="form">
			<form method="post" id="connexion">
				<p>Connexion</p>
				<input type="text" name="cemail" id="cemail" placeholder="Votre adresse mail" required>
				<input type="password" name="cpassword" id="cpassword" placeholder="Votre mot de passe" required>
				<input type="submit" name="connsend" id="connsend" value="connexion">
			</form>
		</div>

		<?php include 'connexion.php'; ?>

		<div class="form">
			<form method="post" id="inscription">
				<p>Créer un compte</p>
				<input type="text" name="iemail" id="iemail" placeholder="Votre adresse mail" required><br/>
				<input type="password" name="ipassword" id="ipassword" placeholder="Votre mot de passe" required><br/>
				<input type="password" name="Confirm_Password" id="Confirm_Password" placeholder="Confirmé votre mot de passe" required><br/>
				<input type="submit" name="inscrsend" id="inscrsend" value="inscription">
			</form>
		</div>
	<?php include 'inscription.php'; ?>	
	<?php 
	}
	
	

	else
	{
		?>
		<div id="Mes_commandes" align="center">

			<p>Mon panier</p>

			<?php 
				$q = $db->prepare("SELECT article, prix, taille, id, etat, nombre FROM mon_compte WHERE etat = 'panier' AND id ='". $_SESSION['id'] . "'");
				$q -> execute();
			?> 
			<table id="tableau">
				<thead>
					<tr>
						<th>
							<p>Article</p>
						</th>
						<th>
							<p>Prix</p>
						</th>
						<th>
							<p>taille</p>
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
										<?php echo $ligne['article']; ?>
									</td>
									<td>
										<?php echo $ligne['prix'] . "€"; ?>
									</td>
									<td>
										<?php echo $ligne['taille']; ?>
									</td>
									<td>
										<form method="post">
										<input type="submit" name="suppr" id="suppr" value="X" >
										</form>
										<?php
											if (isset($_POST['suppr'])) 
											{
												$d = $db->prepare('DELETE FROM `mon_compte` WHERE nombre = "'.$ligne['nombre'].'"');
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
											<?php echo $ligne['article']; ?>
											</td>
											<td>
											<?php echo $ligne['prix'] . "€"; ?>
											</td>
											<td>
											<?php echo $ligne['taille']; ?>
											</td>
											<td>
												<form method="post">
												<input type="submit" name="suppr" id="suppr" value="X">
												</form>
												<?php
													if (isset($_POST['suppr'])) 
													{
														$q = $db->prepare('DELETE FROM `mon_compte` WHERE nombre ="'.$ligne['nombre'].'"');
														$q -> execute();
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
											Vous n'avez aucun article dans le panier.
										</td>
									</tr>
								<?php
							}

						?>
					</tr>
				</tbody>
			</table>
		</div>
<p align="center">----------------------------------------</p>
		<div id="Mes_avoirs" align="center">

			<p>Mes avoirs</p>
			<?php 
				
				$q = $db->prepare("SELECT article, prix, taille, id, etat FROM mon_compte WHERE etat = 'achete' AND id ='". $_SESSION['id'] . "'");
				$q -> execute();
			?> 
			<table id="tableau">
				<thead>
					<tr>
						<th>
							<p>Article</p>
						</th>
						<th>
							<p>Prix</p>
						</th>
						<th>
							<p>taille</p>
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
										<?php echo $ligne['article']; ?>
									</td>
									<td>
										<?php echo $ligne['prix'] . "€"; ?>
									</td>
									<td>
										<?php echo $ligne['taille']; ?>
									</td>
								</tr>
								<?php
								while ($ligne=$q->fetch()) 
								{
									?>
										<tr>
											<td>
											<?php echo $ligne['article']; ?>
											</td>
											<td>
											<?php echo $ligne['prix'] . "€"; ?>
											</td>
											<td>
											<?php echo $ligne['taille']; ?>
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
											Vous n'avez acheté aucun article.
										</td>
									</tr>
								<?php
							}

						?>
					</tr>
				</tbody>
			</table>
		</div>
<p align="center">----------------------------------------</p>
		<div id="Mes_adresses" align="center">

			<?php 
				
				$adr = $db->prepare("SELECT password, adresse, id FROM user WHERE id ='". $_SESSION['id'] . "'");
				$adr -> execute();
				$adre = $adr->fetch();

			?> 
			<table id="tableau">
				<thead>
					<tr>
						<th>
							<p>adresse</p>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							if($adre['adresse'] != '') 
							{
								?>
								<td>
									<?php echo $adre['adresse']; ?>
								</td>
								<?php

							}
							else
							{
								?>
								<td>
									<form method="post">
										<input type="text" name="adresses" id="adresses" placeholder="Votre adresse" required><br/>
										<input type="password" name="ipassword" id="ipassword" placeholder="Votre mot de passe" required><br/>
										<input type="submit" name="Aregister" id="Aregister" value="enregistré">
									</form>
								</td>
								<?php
									if (isset($_POST['Aregister']))
									{
										if(password_verify($_POST['ipassword'], $_SESSION['password']))
										{
											$adresse = $_POST['adresses'];
											$a = $db->prepare("UPDATE user SET adresse ='". $adresse . "' WHERE id = '" . $_SESSION['id'] . "'");
											$a->execute();
										}
										else
										{
											echo "Mot de passe incorrect";
										}

									}
							}

						?>
					</tr>
				</tbody>
			</table>	
		</div>
<p align="center">----------------------------------------</p>
		<div id="Mes_informations_personnelles" align="center">
			<?php 
				
				$q = $db->prepare("SELECT email, password, id FROM user WHERE id ='". $_SESSION['id'] . "'");
				$q -> execute();
				while ($ligne=$q->fetch()) 
				{
					
			?> 
					<p>Mon email :<?php echo $ligne['email']; ?></p>
					<p align="center">Changer mot de passe :<form method="post">
										<input type="password" name="npassword" id="npassword" placeholder="Nouveau mot de passe" required><br/>
										<input type="submit" name="Pregister" id="Pregister" value="changer"></p>
									</form>
					<?php
					if (isset($_POST['Pregister'])) 
					{
						$option= ['cost' => 12];
						$newpass = password_hash($_POST['npassword'], PASSWORD_BCRYPT, $option);
						$pr = $db -> prepare("UPDATE `user` SET `password`= '".$newpass."' WHERE `id`='".$_SESSION['id']."'");
						$pr->execute();
					}
				}
					?>
		</div>
<p align="center">----------------------------------------</p>
		<div id="Mes_bons_de_réductions" align="center">
			<?php 
				
				$b = $db->prepare("SELECT bons FROM mon_compte WHERE id ='". $_SESSION['id'] . "'");
				$b -> execute();
			?> 
			<table id="tableau">
				<thead>
					<tr>
						<th>
							<p>Bons</p>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							if ($ligne=$q->fetch()) 
							{
								while ($ligne=$q->fetch()) 
								{
									?>
										<tr>
											<td>
											<?php echo $ligne['bons']; ?>
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
											Vous n'avez pas reçu de bons.
										</td>
									</tr>
								<?php
							}

						?>
					</tr>
				</tbody>
			</table>
		</div>
<p align="center">----------------------------------------</p>
		<div id="Mes_récompense" align="center">

			<?php 
				
				$b = $db->prepare("SELECT cadeau FROM mon_compte WHERE id ='". $_SESSION['id'] . "'");
				$b -> execute();
			?> 
			<table id="tableau">
				<thead>
					<tr>
						<th>
							<p>Récompense</p>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							if ($ligne=$q->fetch()) 
							{
								while ($ligne=$q->fetch()) 
								{
									?>
										<tr>
											<td>
											<?php echo $ligne['bons']; ?>
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
											Vous n'avez pas reçu de bons.
										</td>
									</tr>
								<?php
							}

						?>
					</tr>
				</tbody>
			</table>
		</div>
	<?php
	}
	?>

	</body>
<!-- pied de page -->
<footer>
		<a href="Mention Legale.php">Mentions légales     </a>
		<a href="CGV.php">Conditions générales de vente     </a>
		<a>All right reserved to AMBITION CLOTHING</a>
</footer>


</html>