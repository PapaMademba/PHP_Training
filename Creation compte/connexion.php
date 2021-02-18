<?php

	$bdd = new PDO("mysql:host=localhost; dbname=test", "root", "root");

	if (isset($_POST['formconnect'])) 
	{
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if (empty($mailconnect) or empty($mdpconnect)) 
		{
			$error = "Tous les champs doivent être saisis.";
		}
		else 
		{
			$req = $bdd->prepare('SELECT * FROM membres WHERE mail = ? and mdp = ?');
			$req->execute(array($mailconnect, $mdpconnect));
			$resultat = $req->fetch();

			if (!$resultat) 
			{
				$error = "Votre adresse mail ou votre mot de passe est incorrect";
			}
			else 
			{
			
			session_start();
			$_SESSION['pseudo'] = $resultat['pseudo'];
			$_SESSION['mail'] = $resultat['mail'];
			$_SESSION['mdp'] = $resultat['mdp'];
			header('Location: /profil.php');
			}

		}

			
	}
	

	?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
</head>
<body background="rap/images/redbone.jpg">
<div align="center"><font color="white">
	<h1>Page de connexion</h1>
	<br>
	<br>
	<br>
	<br>
	<br>
	
	<form method="post" action="#">
		<input type="email" name="mailconnect" placeholder="Mail" value="<?php if (isset($mailconnect)) { echo $mailconnect; } ?>"><br>
		<input type="password" name="mdpconnect" placeholder="Mot de passe"><br>
		<input type="submit" name="formconnect" value="Se connecter">

	</form>
	<div align="center"> <?php
		if($error){ echo $error; } ?></div>

</font>
</div>

</body>
</html>