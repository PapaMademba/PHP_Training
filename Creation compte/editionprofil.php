<?php
	session_start();
	$bdd = new PDO("mysql:host=localhost; dbname=test", "root", "root");
	if (isset($_POST['pseudo2'])) 
	{
		$pseudo2 = htmlspecialchars($_POST['pseudo2']);
		$req = $bdd->prepare('UPDATE membres SET pseudo = :pseudo2 WHERE pseudo = :pseudo');
		$req->execute(array(
		'pseudo' => $_SESSION['pseudo'],
		'pseudo2' => $pseudo2,
		));
		$error = "Votre pseudo a bien été modifié";
		$_SESSION['pseudo'] = $pseudo2;

	}	

	if (isset($_POST['submitmail'])) 
	{
		
		if (isset($_POST['oldmail']) and isset($_POST['mdpmail']) and isset($_POST['newmail']) and isset($_POST['newmail2']) and !empty($_POST['oldmail']) and !empty($_POST['mdpmail']) and !empty($_POST['newmail']) and !empty($_POST['newmail2'])) 
		{
		
			$oldmail = htmlspecialchars($_POST['oldmail']);
			$mdpmail = sha1($_POST['mdpmail']);
			$newmail = htmlspecialchars($_POST['newmail']);
			$newmail2 = htmlspecialchars($_POST['newmail2']);

			if ($oldmail == $_SESSION['mail']) 
			{
				if ($mdpmail == $_SESSION['mdp']) 
				{
					if ($newmail == $newmail2) 
					{
						$reqmail = $bdd->prepare('UPDATE membres SET mail = :newmail WHERE mail = :oldmail');
						$reqmail->execute(array(
						'newmail' => $newmail,
						'oldmail' => $oldmail
						));
						$_SESSION['mail'] = $newmail;
						$error3 = "Votre adresse mail a bien été modifiée";

					}
					else
					{
						$error3 = "Les deux adresses mails ne sont pas identiques";
					}
				}
				else
				{
					$error3 = "le mot de passe entré n'est pas le votre";
				}
			}

			else 
			{
				$error3 = "L'adresse mail entrée n'est pas la votre";
			}

		}

	}


	if (isset($_POST['changemdp'])) 
	{
		if (isset($_POST['mdp']) and isset($_POST['newmdp']) and isset($_POST['newmdp2']) and !empty($_POST['mdp']) and !empty($_POST['newmdp']) and !empty($_POST['newmdp2'])) 
		{
			$mdp = sha1($_POST['mdp']);
			$mail = htmlspecialchars($_POST['email']);
			$newmdp = sha1($_POST['newmdp']);
			$newmdp2 = sha1($_POST['newmdp2']);

			if ($mdp == $_SESSION['mdp']) 
			{
				if ($newmdp == $newmdp2) 
				{
					$reqmdp = $bdd->prepare('UPDATE membres SET mdp = :newmdp WHERE mail = :email');
					$reqmdp->execute(array(
					'newmdp' => $newmdp,
					'email' =>  $mail
					));

					$error2 = "Votre mot de passe a bien été modifié";

				}
				else 
				{
					$error2 = "Le mot de passe entré n'est pas le même";
				}
			}
			else
			{
				$error2 = "Votre ancien mot de passe n'est pas correct";
			}
		}
	}

?>
	
<!DOCTYPE html>
<html>
<head>
	<title>Edition du profil</title>
</head>
<body background="rap/images/reserve/galaxy.jpg">
	<div align="right">
		<table align="right">
			<td><a href="deconnexion.php"><font color="white"> Déconexion</font></a></td>
		</table>

	</div>
<div align="center"><font color="white">
	<h1>Page d'édition du profil</h1>
	
	<h2>Changer de pseudo</h2>
<table>


	<form method="post" action="#">
		<td align="right"><label for="pseudo">Ancien Pseudo :</label></td>
		<td><input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo']; ?>"><br></td>
		<tr>
			<td align="right"><label for="pseudo2">Nouveau Pseudo :</label></td>
			<td><input type="text" name="pseudo2" id="pseudo2" placeholder="Nouveau Pseudo"><br></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Changer de Pseudo"></td>
		</tr>
	</form>
</table>


	<br>
	<br>
	<h2><?php echo $error; ?></h2>

	<br>
	<br>

	<h2>Changer d'adresse mail</h2>
<table>
	<form method="post" action="#">
		
		<td align="right"><label for="oldmail">Ancien Mail :</label></td>
		<td><input type="email" name="oldmail" id="oldmail" value="<?php echo $_SESSION['mail']; ?>"><br></td>
		<tr>
			<td align="right"><label for="mdpmail">Mot de passe :</label></td>
			<td><input type="password" name="mdpmail" id="mdpmail" placeholder="Mot de passe"><br></td>
		</tr>
		<tr>
			<td align="right"><label for="newmail">Nouvelle adresse mail :</label></td>
			<td><input type="email" name="newmail" id="newmail" placeholder="Nouveau email"><br></td>
		</tr>
		<tr>
			<td align="right"><label for="newmail2">Confirmation du mail :</label></td>
			<td><input type="email" name="newmail2" id="newmail2" placeholder="Confirmer le nouveau mail"><br></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submitmail" value="Changer d'adresse mail"></td>
		</tr>
	</form>
</table>



<br>
<h2><?php echo $error3; ?></h2>
	<br>
	<h2>Changer de mot de passe</h2>

<table>
	<form method="post" action="#">
		<td align="right"><label for="mailmdp">Adresse mail</label></td>
		<td><input type="email" id="mailmdp" name="email" value="<?php echo $_SESSION['mail']; ?>"><br></td>
		<tr>
			<td align="right"><label for="mdp">Mot de Passe :</label></td>
			<td><input type="password" name="mdp" id="mdp" placeholder="Ancien mot de passe"><br></td>
		</tr>
		<tr>
			<td align="right"><label for="newmdp">Nouveau mot de passe</label></td>
			<td><input type="password" name="newmdp" id="newmdp" placeholder="Nouveau mot de passe"><br></td>
		</tr>
		<tr>
			<td align="right"><label for="newmdp2">Nouveau mot de passe</label></td>
			<td><input type="password" name="newmdp2" id="newmdp2" placeholder="Confirmation du mot de passe"><br></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Changer de Mot de passe" name="changemdp" value="Changer de mot de passe"></td>
		</tr>
		
		
	</form>

</table>
<br>
<br>
<h2><?php echo $error2; ?></h2>
<br>
<br>

<br>
<br>
<a href="profil.php">Retourner à la page d'acceuil</a>


</font>
</div>

</body>
</html>