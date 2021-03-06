<?php
/*pour bien utiliser les variables de session que nous allons déclaré un peu plus tard, il faudra démarrer notre session avec la fonction session_start*/
session_start();
//création variable bdd et connexion à notre base de donnée espace-membre
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', 'auf');

//debut des tests 
	if(isset($_POST['connexion']))
   {/*création des variable de connexion pour mail et le mdp
    htmlspécialchars est une fonction qui permet d'enlever tous les caractères html 
    sha1 permet de cripter(haché) les mdp dans notre bdd  */
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect =($_POST['mdpconnect']);

   //vérification si notre formulaire envoyé a été bien rempli ou non (empty)
   if(!empty($mailconnect) AND !empty($mdpconnect))
      {/*préparation et éxécution de nos requètes avec les fonctions prepare et execute*/
      $requser = $bdd->prepare("SELECT * FROM Administrateur WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      /*rowCount nous compte le nombre colonne afin de vérifier si l'utilisateur éxite bien dans notre bdd*/
      $userexist = $requser->rowCount();
      if($userexist == 1) 
         {/*création de la variable userinfo pour récupérer les infos du users et le rapporter grace à la fonction "fetch"*/
   
      //création des variables de session

         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['mail'] = $userinfo['mail'];
         $_SESSION['motdepasse'] = $userinfo['motdepasse'];
          header('location:utilisateurs.php');
        
      } else {
         $erreur = "Mail ou mot de passe incorrect !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
      <title>CONNEXION</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <link rel="shortcut icon"  href="b.png">


   </head>
   <body style="background-image: url(IMG.jpg);">

    <font color="skyblue">  <u><h1>Réservé à l'Administrateur</h1></u></font>


    <nav>
              <ul>
                  
                  <li>  <a href="accueil.php">MA CHAINE</a> </li>
                  <li>  <a href="info.php">VOS AVIS </a> </li>
                  <li>  <a href="#pageAdmin.php"> Adminitration </a> </li>
                  <li>  <a href="connexion.php"> Déconnexion </a> </li>
              </ul>


        </nav>




     <div align="center" style="background-color:rgb(33, 50, 146 ,0.85); margin-top: 80px; border-radius: 60px 20px 60px 20px;width:600px; margin-left: 400px;height: 300px;" >  <br> <br><br>

     	
     	
         <form method="POST" action="">
         	 <b> <label for="mailconnect"> <font color="black"> Saisir email:</font></label> <br>
            <input type="email" size="30px" name="mailconnect" placeholder="ex:am@gmail.com" /><br /><br/><br/>

           <b>  <label for="mailconnect"><font color="white"> Mot de passe: </font></label> <br>
            <input type="password" size="30px" name="mdpconnect" placeholder="Mot de passe" /><br/><br/>
            <br />
           

            <button type="submit" name="connexion" class="btn btn-info  btn-lg-default">Se connecter</button>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="white">'.$erreur."</font>";
         }
         ?>
      </div> 


      <div style="margin-top: 310px;">Copyright:ABT</div>
   




   </body>
</html>