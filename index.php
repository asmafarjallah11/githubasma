<?php require_once 'parametres.php';  ?>

<html>
    <head>
        <title>Product Test With Bootstrap</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
        
        
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="jquery.validate.js"></script>
        <script src="validator.js"></script>
    </head>
       
    <body>

        <div class="container">
         <div class="row">
           </div>

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">
                    <h1>Formulaire Insertion Produit</h1>

     <form id="formStep"class="form-horizontal" role="form" method="post" action="index.php">
	<div class="form-group">
		<label for="nom" class="col-sm-2 control-label">Nom</label>
		<div class="col-sm-10">
	
			<input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom du produit" 
			value="<?php if (!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom']);} ?>">
		
		</div>
	
	
	</div>
	
	<div class="form-group">
		<label for="nom" class="col-sm-2 control-label">Prix</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="prix" name="prix" placeholder="Entrez le prix de votre produit" 
			value="<?php if (!empty($_POST['prix'])) {echo htmlspecialchars($_POST['prix']);} ?>"> 
		
		</div>
		<label for="nom" class="col-sm-2 control-label left">
		<?php echo'$                  '?>
		</label>
		<div class="col-sm-2">
		 </div>
			<div class="col-sm-10">
	
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-sm-2 control-label">Description</label>
		<div class="col-sm-10">
	 <textarea class="form-control" rows="4" class="form-control" id="description" name="description" >
	 <?php if (!empty($_POST['description'])) {echo htmlspecialchars($_POST['description']);}?></textarea>
	
		</div>
		
		</div>
	</div>
	
	
	
	
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Sauvegarder" class="btn btn-primary">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
		   <?php 

 
  
  if (isset($_POST["submit"])) {
  
      $nom = $_POST['nom'];
      $description = $_POST['description'];
      $prix = $_POST['prix'];
      if (isset( $nom) AND isset($prix))
      {
          if($prix!= NULL AND $nom != NULL)
          {
              echo  " <div class='alert alert-success'>
            <strong>Succes!</strong> Vous avez rempli vos donnees avec succes.
             </div>";
              $link = mysqli_connect($serverdb, $userdb, $passdb, $dbname);
              
              if (!$link) {
                  echo ' <div class="alert alert-danger" role="alert">';
                  echo "Error: impossible de se connecter a MySQL." . PHP_EOL;
                  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                  echo  ' </div>';
                  
                  exit;
              }
              echo ' <div class="alert alert-info" role="alert">';
              echo " <strong> Succes: </strong>connexion a la  base de donnee avec succes ." . PHP_EOL;
              echo  ' </div>';
              
          
              
              $nom =    $link->real_escape_string(htmlspecialchars($_POST['nom']));
              $prix = $_POST['prix'];
              $description  = $link->real_escape_string(htmlspecialchars($_POST['description']));
              
             $result = mysqli_query( $link,"INSERT INTO produit VALUES('', '".$nom."','".$prix."','".$description."')");
        
             
             echo ' <div class="alert alert-info" role="alert">';
             echo " <strong> Succes: </strong>insertion a la  base de donnee  etablie avec succes ." . PHP_EOL;
             echo  ' </div>';
              
              mysqli_close($link);
              
              
              ///  envoyer le  mail
              
              $to = $sendto;
              
              $subject = 'Nouveau produit insere';
              
              $headers = "From: " . strip_tags('asma@example.com') . "\r\n";
              $headers .= "Reply-To: ". strip_tags('asma@example.com') . "\r\n";
              $headers .=  "CC: asma@example.com\r\n";
              $headers .= "MIME-Version: 1.0\r\n";
              $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
              
              
              $message = '<html><body>';
              $message .=  "<p> un nouveau produit est insere </p> ";
              $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
              $message .= "<tr ><td style='background: #eee;'><strong>Nom:</strong> </td><td>" . strip_tags($_POST['nom']) . "</td></tr>";
              $message .= "<tr><td style='background: #eee;'><strong>Prix:</strong> </td><td>" . strip_tags($_POST['prix']) . '$'."</td></tr>";
              $message .= "<tr><td style='background: #eee;'><strong>Description:</strong> </td><td>" . strip_tags($_POST['description']) . "</td></tr>";
              $message .= "</table>";
              $message .= "</body></html>";
              
              
              if (mail($to, $subject, $message, $headers)) {
                  echo ' <div class="alert alert-info" role="alert">';
                  echo " <strong> Succes: </strong>Votre Message a ete envoye." . PHP_EOL;
                  echo  ' </div>';
          
              } else {
                  echo ' <div class="alert alert-danger" role="alert">';
                  echo 'There was a problem sending the email.';
                  echo  ' </div>';
              
              }
              
          
          }
      }
      
      
  }
  ?>
		</div>
	</div>
    </form> 

                </div>

            </div>

       
          <div class="row">
           </div>
       
        </div>
       

   
    </body>

</html>
