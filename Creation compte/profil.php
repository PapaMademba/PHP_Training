<?php
	session_start();
	$bdd = new PDO("mysql:host=localhost; dbname=test", "root", "root");


	?>
<!DOCTYPE html>
<html>
<head>
	<title>Espace abonné</title>
</head>
<body background="rap/images/Acceuil.jpeg">
	<div align="right">
		<table align="right">
			<td><a href="deconnexion.php"><font color="white"> Déconexion</font></a></td>
		</table>

	</div>
<div align="center"><font color="white">
	<h1>Espace abonné</h1>
	<br>
	<br>
	<h2>Bienvenue <?php echo $_SESSION['pseudo']; ?>! Tu peux éditer ton profil <a href="editionprofil.php"><font color="white"> ici</font></a> </h2>
	<br>
	<br>
	<h2>Tu peux également visiter mon <a href="rap/Acceuil.php" target="_blank"><font color="white">site</font></a></h2>
	

</font>
</div>

</body>
</html>