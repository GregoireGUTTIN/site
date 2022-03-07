<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>Accueil</title> 
<link type="text/css" href="style.css" rel="stylesheet" media="screen" />
</head>
	<table width="100%">
		<tr>
			<td width=400px>
			<img src="images/ours2.gif">
			</td>
			<td>
<?php
	include("../../cecilegregoire.fr/fonctions/fonctions.php");
	$pb='0';
	//-----------------------------------------------
    //TEST DES VARIABLES
    //-----------------------------------------------
	/*if($_POST["mail"] == "e-mail")
	{
		?>
		<li>L'adresse mail est erronnée.</li>
		<?php
		$pb++;
	}
	
	if($_POST["prenom"] == "Prénom")
	{
		?>
		<li>Le prénom est erronné.</li>
		<?php
		$pb++;
	}
	
	if($_POST["nom"] == "Nom")
	{
		?>
		<li>Le nom est erronné.</li>
		<?php
		$pb++;
	}
	
	if($_POST["message"] == "Message")
	{
		?>
		<li>Le message est erronné.</li>
		<?php
		$pb++;
	}*/
	 
	//-----------------------------------------------
    //DECLARE LES VARIABLES
    //-----------------------------------------------
	$destinataire='cecilegregoire@live.fr';
	$objet='Naissance';
	
	//-----------------------------------------------
    //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET PIECE JOINTE
    //-----------------------------------------------

    $frontiere = '-----=' . md5(uniqid(mt_rand()));
	
    //-----------------------------------------------
    //PIECE JOINTE
    //-----------------------------------------------
	$taille_max = 1000000;
	$taille = filesize($_FILES['image']['tmp_name']);
	if($pb == '0') 
	{
		if(!isset($_POST["piece_joint"])) //Si le message ne contient pas d'image
		{
			$message_pret = mise_en_forme_message_sans_image($_POST["message"],$frontiere);
		}
		else //Sinon on test le type et la taille de l'image.
		{
			if(($_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/pjpeg") && $taille <= $taille_max )
			{
				$message_pret = mise_en_forme_message($_POST["message"],$_FILES["image"],$frontiere);
			}
			else
			{
				if( $taille > $taille_max)
				{
				?>
				<li>Le fichier joint a une taille trop grande.</li>
				<?php
				}
				else
				{
				?>
				<li>Le fichier joint n'est pas une image JPEG : "<?php echo $_FILES['image']['type']; ?>"</li>
				<?php
				$m = 'Avec erreur : '.print_r($_FILES,true).htmlEntities($_SERVER["HTTP_USER_AGENT"]);
				mail('gregoire.guttin@gmail.com', 'Avec erreur', mise_en_forme_message_sans_image($m,$frontiere), mise_en_forme_header($_POST["mail"],$_POST["prenom"],$_POST["nom"],$frontiere));
				}
				$pb++;
			}
		}
	}
	
	

if($pb == '0')
{
	ini_set('SMTP','smtp.orange.fr');
	ini_set("maximum_execution_time", '0');
	if (mail($destinataire, $objet, $message_pret, mise_en_forme_header($_POST["mail"],$_POST["prenom"],$_POST["nom"],$frontiere))) // Envoi du message
	{?>
		<center>
		<H2>Nous vous remercions pour votre message !</H2>
		<a href="javascript:history.go(-1)">Retour à l'envoi d'un message.</a>
		</center>
		</td>
		<?php
		$m = 'Sans erreur : '.htmlEntities($_SERVER["HTTP_USER_AGENT"]);
		mail('gregoire.guttin@gmail.com', 'Sans erreur', mise_en_forme_message_sans_image($m,$frontiere), mise_en_forme_header($_POST["mail"],$_POST["prenom"],$_POST["nom"],$frontiere));
	}
	else // Non envoyé
	{
	?>
		</td>
		<td>
			<center>
			<H2>Votre message n'a pas pu être envoyé !</H2>
			<a href="javascript:history.go(-1)">Retour à l'envoi d'un message.</a>
			</center>
		</td>
  		<td>
			
		</td>
	<?php
	}
}
else
{
?>
		</td>
		<td>
			<center>
			<H3>Votre message n'a pas pu être envoyé !</H3>
			<a href="javascript:history.go(-1)">Retour à l'envoi d'un message.</a>
			</center>
		</td>
  		<td>
			
		</td>
	<?php
}
?>
</tr>
	<tr>
		<td>
			&nbsp;
 		</td>
		<td width=90%>
			&nbsp;
 		</td>
  		<td>
			<img src="images/empreinte.png" width=150/>
		</td>
	</tr>
</table>
</font>
</body>
</html>
