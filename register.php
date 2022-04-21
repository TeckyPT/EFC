<link rel="stylesheet" href="../style/login.css">
<?php
require('config.php');
if (isset($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['password'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$nom = stripslashes($_REQUEST['nom']);
	$nom = mysqli_real_escape_string($conn, $nom); 
    $prenom = stripslashes($_REQUEST['prenom']);
	$prenom = mysqli_real_escape_string($conn, $prenom); 
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	//requéte SQL + mot de passe crypté
    $query = "INSERT into `client` (nom, prenom, email, password)
              VALUES ('$nom', '$prenom' ,'$email','".hash('sha256', $password)."')";
	// Exécute la requête sur la base de données
    $queryemail = "SELECT * FROM `client` WHERE email='$email'";
    $emailvalidator = mysqli_query($conn,$queryemail);


    if (mysqli_num_rows($emailvalidator) > 0 ) {
   
        register('Email already in Use');

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
     
        register('Email is not valid');

    } else {
        
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
			 </div>";
      } else {
          echo 'erreur';
      }
    }
}else{

    register($error = '');
} ;

function register($error) { ?>
    <div class="container">
    <form class="box" action="" method="post">
        <div class="brand-logo"></div>
        <div class="brand-title"></div>
        <div class="inputs">
            <label>NOM</label>
            <input type="text" class="box-input" name="nom" placeholder="" required />
            <label>PRENOM</label>
            <input type="text" class="box-input" name="prenom" placeholder="" required />
            <label>EMAIL</label>
            <input type="text" class="box-input" name="email" placeholder="" required />
            <label>PASSWORD</label>
            <input type="password" class="box-input" name="password" placeholder="" required />
            <p style="color:red"><?php echo $error ?></p>
            <button type="submit">S'INSCRIRE</button>
            <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
        </div>
    </form>
</div>
<?php } ?>