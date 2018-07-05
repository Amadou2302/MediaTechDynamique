<?php
//création variable bdd et connexion à notre base de donnée espace-membre
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', 'auf');

//préparation de la requête
$pdostat = $bdd->prepare('DELETE FROM membres WHERE id=:num LIMIT 1');

//liaison du parametre nommé "num"
$pdostat->bindValue(':num',$_GET['id'], PDO::PARAM_INT);
//exécution de la requete
 $executeIsOK = $pdostat->execute();

if ($executeIsOk) {

	$message = 'negatif';
}
else
{
		  header('location:utilisateurs.php');
		  
}

?>

<!DOCTYPE html>
<html>
		<head>
			<title> Suppresion</title>
			<meta charset="utf-8">
			<meta name="viewport" content="widht=device-widht, user-scale=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

			<link rel="stylesheet" type="text/css" href="style.css">
			<link rel="shortcut icon"  href="b.png">
		</head>

		<body>
				<h1>Suppression</h1>

				<p> <?= $message ?> </p>


		</body>
</html>