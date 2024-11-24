<?php
global $db;
include 'database.php';

				if(isset($_POST['new']))
				{

					extract($_POST);

					$content_dir = "img/";
					$tmp_file = $_FILES['picture']['tmp_name'];

					if (!is_uploaded_file($tmp_file)) 
					{
						echo "fichier introuvable ";
					}
					$type_file = $_FILES["picture"]['type'];
					if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
			    	{
			    	    exit("Le fichier n'est pas une image");
			    	}
			    	$name_file = $_FILES['picture']['name'];

			    	if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
			    	{
			    	    exit("Impossible de copier le fichier dans $content_dir");
			    	}
			    	echo "fichier upload ";
				

					$add = $db->prepare("INSERT INTO `boutique`(`nom`, `description`, `collection`, `prix`, `img`, `type`) VALUES ('".$nom."', '".$description."', '".$collection."', '".$prix."', 'img/".$name_file."', '".$type."')");
					$add->execute();
					header('location: adminpage.php');
					exit();

				}

?>