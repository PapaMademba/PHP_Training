<?php

	$bdd = new PDO("mysql:host=localhost; dbname=test", "root", "root");
	if (isset($_POST['forminscription'])) {
			
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$mail = htmlspecialchars($_POST['mail']);
			$mail2 = htmlspecialchars($_POST['mail2']);
			$mdp = sha1($_POST['mdp']);
			$mdp2 = sha1($_POST['mdp2']);

		if (empty($_POST['pseudo']) or empty($_POST['mail']) or empty($_POST['mail2']) or empty($_POST['mdp']) or empty($_POST['mdp2'])) {
				$error = "Tous les champs doivent être remplis";
			}
		else {

			
				if ($mail == $mail2)
				{
					if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
					{
						$reqmail = $bdd->prepare('SELECT * FROM membres WHERE mail = ?');
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();
						if ($mailexist == 0) 
						{

						 	if ($mdp == $mdp2) 
						 	{
						 		$insertmbr = $bdd->prepare('INSERT INTO membres(pseudo, mail, mdp) VALUES(?, ?, ?)');
						 		$insertmbr->execute(array($pseudo, $mail, $mdp));
						 		header('Location: connexion.php');
						 	} 
						 	else 
						 	{
						 		$error = "Le mot de passe entré n'est pas le même";
							}
						}
						else 
						{ 
							$error = "Adresse mail déjà utilisée";
						}
				 	}
				 	else {
				 		$error= "Votre adresse mail n'est pas valide";
				 	}
				} 
				else
				{
				 	$error= "Vos adresses mail ne correspondent pas";
				}
			}
		
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Page d'inscription </title>
</head>
<body background="rap/images/Acceuil.jpeg">
<div align="center"><font color="white">
	<h1>Page D'inscription</h1>
	
	<form method="post" action="#">
		<table>
			<tr>
				<td align="right">
					<label for="pseudo">Pseudo</label>
				</td>
				<td><input type="text" maxlength="255" placeholder="Pseudo" name="pseudo" value="<?php if (isset($pseudo)) { echo $pseudo; } ?>" id="pseudo"></td>
			</tr>
			<tr>
				<td align="right">
					<label for="mail">Mail</label>
				</td>
				<td><input type="email" name="mail" placeholder="Mail" value="<?php if (isset($mail)) { echo $mail; } ?>" id="mail"></td>
			</tr>
			<tr>
				<td align="right">
					<label for="mail2">Confirmation du Mail</label>
				</td>
				<td><input type="email" name="mail2" placeholder="Mail de Confirmation" value="<?php if (isset($mail2)) { echo $mail2; } ?>" id="mail2"></td>
			</tr>
			<tr>
				<td align="right">
					<label for="mdp">Mot de passe</label>
				</td>
				<td><input type="password" name="mdp" placeholder="Mot de Passe" id="mdp"></td>
			</tr>
			<tr>
				<td align="right">
					<label for="mdp2"> Confirmation Mot de passe</label>
				</td>
				<td><input type="password" name="mdp2" placeholder="Mot de Passe" id="mdp2"></td>
			</tr>
			<tr>
				<td></td>
				<td align="center"><input type="submit" value="Je m'incris!" name="forminscription"></td>
				<td></td>
			</tr>
			
			
		</table>

	</form>
	<div align="center"> <?php
				if($error){ echo $error; } ?></div>

</font>
</div>

</body>
</html>