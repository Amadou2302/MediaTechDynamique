<?php
//création variable bdd et connexion à notre base de donnée espace-membre
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', 'auf');

//debut des tests pour voir si notre formulaire est bien envoyé
if(isset($_POST['forminscription'])) {
   //htmlspécialchars est une fonction qui permet d'enlever tous les caractères html
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   /*sha1 permet de cripter(haché) les mdp dans notre bdd 
   il y'a aussi md5 mais celui ci commence à être obsolétes*/
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);

   //vérification si notre formulaire envoyé a été bien rempli ou non (empty)
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      /*vérification de la taille du pseudo
      parce que dans notre base de donnée sa taille est de 255 caractère
      Nous déclarons la variable pseudolength et pour trouver le nombre de caractère dans une chaine caractère on utilise la fonction strlen */
      $pseudolength = strlen($pseudo);

      if($pseudolength <= 255) {

         //vérification de la correspondance des 2 mails
         if($mail == $mail2) {

            /*utilisation de la fonction filter_var pour filtrer le mail et vérifier si c'est bien un é-mail avec la fonction FILTER_VALIDATE_EMAIL*/
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
             {
               /* création de la variable reqmail et éxécution d"une requète pour vérifier si notre mail éxiste dans notre bdd
               Rowcount est une fonction qui permet de compter le nombre de colonne qui contient le même mail */
               $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) 
               {
             //vérification de la correspondance des 2 mdp
                  if($mdp == $mdp2)
                   {
                     /*insertion dans notre table membre avec les paramétres 
                     1.préparation de la base de donnée avec la fonction "prepare"
                     2.éxécution  "exucute" de notre requète avec des tableaux d'ou la fonction "array"*/
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));

                     //création de la variable erreur qui sera appelé à chaque erreur commit lors de l'inscription
                      header('location:connexion.php');
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mails ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<html>
   <head>
      <title>Inscription formumaire</title>
      <meta charset="utf-8">

   </head>
   <body style="background-image: url(IMG.jpg);background-size: 100%;">

      

  
      <div  align="center" >
         <font color="#000000  "> <u> <h1>Inscription</h1></font></u>
         <br /><br />
         <form method="POST" action=""> <br> 
            <table>


               <tr>
                  <td align="right">
              <h3>  <font color="#79F8F8">  <b>  <label for="pseudo">Pseudo :</label> </b> </h3>
                  </td></font>
                  <td>
                     <input type="text"  size="35px" placeholder="Votre pseudo" id="pseudo" name="pseudo"  />
                  </td>
               </tr>

               <tr>
                  <td align="right">
               <h3> <font color="#79F8F8">    <b> <label for="mail">Mail :</label></b> </h3>
                  </td>
                  <td>
                     <input type="email" size="35px" placeholder="Votre mail" id="mail" name="mail"  />
                  </td>
               </tr>

               <tr>
                  <td align="right">
                  <h3>  <font color="#79F8F8">  <b>  <label for="mail2">Confirmation du mail :</label></b>  </h3>
                  </td>
                  <td>
                     <input type="email" size="35px" placeholder="Confirmez votre mail" id="mail2" name="mail2"  />
                  </td>
               </tr>
               <tr>
                  <td align="right">
              <h3>   <font color="#79F8F8">   <b>  <label for="mdp">Mot de passe :</label></b>  </h3>
                  </td>
                  <td>
                     <input type="password" size="35px" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
              <h3>  <font color="#79F8F8">    <b>  <label for="mdp2">Confirmation du mot de passe :</label></b> </h3> 
                  </td>
                  <td>
                     <input type="password" size="35px" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" style="background-color: #79F8F8  " />  <br> <br><br>
             <div style="margin-left: 100px">     
          <h2> <font color=" #E5E8E8  ">    <b> <div align="right" style="background-color:black ">   Vous avez dèja un compte?  <a href="connexion.php"  >  <input type="button" value="Se connecter" style="background-color:#79F8F8      ">   </a></div></b> </h2> </div>   


                  </td>
               </tr>
            </table>
         </form>  <br>
         <?php
         if(isset($erreur)) {
            echo ' <h2><font color="red">'.$erreur."</font>";
         }
         ?>
      </div>

      <div style="margin-top: 120px;">Copyright:ABT</div>


   </body>
</html>