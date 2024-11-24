<?php
		if (isset($_POST['connsend']))
		{
			extract($_POST);

			global $db;

			if (!empty($cemail) && !empty($cpassword)) 
			{
				
				$q = $db->prepare("SELECT * FROM user WHERE email = :email");
				$q->execute(['email' => $cemail]);
				$result = $q->fetch();

				if ($result == true) 
				{
					
					if(password_verify($cpassword, $result['password']))
					{
						$_SESSION['email'] = $result['email'];
						$_SESSION['password'] = $result['password'];
						$_SESSION['id'] = $result['id'];

						echo "Vous etes bien connecté";
						header('Location: Mon%20compte.php');
					}
					else
					{
						echo "Mot de passe incorrect";
					}

				}
				else
				{
					echo "Le compte utilisant cet email n'éxiste pas";
				}
			}
			else 
			{
				echo "Veuillé remplire l'ensemble des élément ";
			}

		}

	?>