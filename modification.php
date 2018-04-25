<?php

$id= $_GET['id'];
$mysqli= new mysqli('localhost','root','auf','espace_membre');
$query = $mysqli->query("SELECT * FROM membres WHERE id='$id' limit 0,1");
$row = $query->fetch_assoc();

if (isset($_POST['update'])) {
   $idm= $_POST['id'];
   $psd= $_POST['psd'];
   $ml= $_POST['ml'];
   $mdp= $_POST['mdp'];

   $result= $mysqli->query("UPDATE membres set pseudo=' $psd', mail=' $ml', motdepasse='$mdp' WHERE id='$idm' ");

   if ($result) {
      echo "Info membre mis à jour";
   }

   else{
      echo "Echec mise à jour";
   }

}





?>

<!DOCTYPE html>
<html>
		<head>
			<title> Modification</title>
			<meta charset="utf-8">
			<meta name="viewport" content="widht=device-widht, user-scale=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

			<link rel="stylesheet" type="text/css" href="style.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		</head>

		<body style="background-image: url(IMG.jpg);">
				<font style="color: skyblue;text-decoration: underline; "><h1>Modification</h1></font>

				<div  align="center" style="margin-right: 210px">
         <br /><br />
         <form method="POST"> <br> 

               <div style="margin-left: 300px">
              <label for="id">ID:</label> </b> 
                  
             <input type="text" size="35px"  id ="id" name="id" value="<?php echo $row['id'];?>" readonly > 
               </div> <br>

                 
               <div style="margin-left: 300px">

                   <label for="psd">Pseudo :</label> 
                  
                <input type="text"  size="35px"  id="psd" name="psd" value="<?php echo $row['pseudo']?>"/>

               </div> <br>

           
                  
                <div style="margin-left:300px">

               <label for="ml">Mail :</label>
                <input type="email" size="35px"  id="ml" name="ml" value="<?php echo $row['mail']?>"/>

                   </div> <br>



                 <div style="margin-left: 300px">
               <label for="mdp">Mot de passe :</label>

                <input type="password" size="35px"  id="mdp" name="mdp" value="<?php echo $row['motdepasse']?>">

                   </div> <br>
                  
                
                      <div style="margin-left: 300px">

                     <button type="submit" class="btn btn-info" name="update">Entregistrer les modifications</button>
                        </div> <br>
                    

             


                 
         </form>  <br>
         
      </div>


		</body>
</html>