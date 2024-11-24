<?php
		if (isset($_POST['inscrsend']))
		{
			extract($_POST);

			global $db;

			if (!empty($iemail) && !empty($ipassword) && !empty($Confirm_Password)) 
			{
				if($ipassword == $Confirm_Password)
				{
					$option= ['cost' => 12];						
					$passwordhash = password_hash($ipassword, PASSWORD_BCRYPT, $option);

					$c = $db->prepare("SELECT email FROM user WHERE email = :email");
					$c->execute(['email' => $iemail]);
					$result = $c->rowCount();

					if($result == 0)
					{
						$q = $db->prepare("INSERT INTO user(email, password) VALUES(:email,:password)");
						$q->execute(['email' => $iemail,'password' => $passwordhash	]);
						echo "Le compte as bien été créer vous pouvez vous connecter.";
							
						$_SESSION['email'] = $iemail;
						$_SESSION['password'] = $ipassword;

					}
						else
						{
							echo "L'email as déja été utilisé sur ce site";
						}
					}					
				}
		}

	?>