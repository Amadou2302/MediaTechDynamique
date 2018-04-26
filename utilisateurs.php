<?php
//création variable bdd et connexion à notre base de donnée espace-membre
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', 'auf');

//préparation de la requête de séléction

$pdostat = $bdd->prepare('SELECT * FROM membres');

//éxécution de la requête
 $executeIsOK = $pdostat->execute();

 //récupération

 $users = $pdostat->fetchAll();


?>
<!DOCTYPE html>
<html>
	<head>
			<title>Utilisateurs</title>
			<link rel="stylesheet" type="text/css" href="style.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<meta name="viewport" content="width=device-width, intial-scale=1">

			<script src="jquery-3.2.1.min.js"></script>
			<script src="jquery-ui-1.10.4.custom.min.js"></script>
			<script src="jquery-ui-1.10.4.custom.min.css"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>




	</head>


	

			<body style="background-image: url(IMG.jpg);">
				<font color="skyblue">	<u><h1>Utilisateurs</h1></u></font>

					<nav>
							<ul>
									<li> 	<a href="accueil.php">MA CHAINE</a> </li>
									<li> 	<a href="info.php">VOS AVIS </a> </li>
									<li> 	<a href="#utilisateurs.php"> Adminitration </a> </li>
									<li> 	<a href="connexion.php"> Déconnexion </a> </li>
							</ul>


				</nav>

	<div style="margin-left:100px;margin-top: 50px;background-image: url(a.jpeg);margin-right: 100px;color:#E5E7E9">





	<br> 

	<?php foreach ($users as $users): ?>
<table border="2px solid black" style="width: 100%;height: 50px">

	<h3>	


			<td style="font-size: bold"><h4><font style="color: black"> <?= $users['id'] ?> </font></h4></td>
			<td><h4> <font style="color: black"> <?= $users['pseudo'] ?> </font> </h4> </td>
			<td><h4><font style="color: black"> <?= $users['mail'] ?></font> </h4></td>
			<td><h4> <font style="color: black"><?= $users['motdepasse'] ?></font> </h4></td>  <td><div style="float: right;margin-right:30px "><a href="modification.php?id=<?= $users['id'] ?>"><button type="button" class="btn btn-success">Modifier</button></a>  </div> 
			</td> <td>
				<div style="float: right;margin-right:30px "><a class="ab" href="supprimer.php?id=<?= $users['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>  </div> </td>

		
	</h3>	
		


	<?php endforeach ?>


	<script>

$('a.ab').confirm({
		title:'Confirmation',	
		theme:'supervan',

    content: "Voulez vous vraiment supprimer ce membre?",



});
$('a.ab').confirm({

    buttons: {
        hey: function(){
            location.href = this.$target.attr('href');
        }
    }
});
</script>

</table>


</div>	












		</body>
</html>