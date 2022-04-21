

<?php
   require('config.php');
   ?>
<link rel="stylesheet" href="../style/header.css">
<link rel="stylesheet" href="../style/reservas.css">
<link rel="stylesheet" href="../style/voirres.css">
<header>
   <div class="logo">
      <img class="logohotel" src="../images/logo.png" alt="">
   </div>
   <div class="menu">
      <a href="../index.php">Accueil</a>
      <a href="/main/contact.php">Contact</a>
   </div>
   <div class="connection">
      <?php
         session_start();

         if(isset($_SESSION["email"],)){
            $emailuser = $_SESSION["email"];
            $queryuser = "SELECT * FROM `client` WHERE email='$emailuser'";
            $uservalidator = mysqli_query($conn,$queryuser);
            $role = $uservalidator->fetch_assoc();

               if($role['role'] === 'Admin') {   
                        echo $role['role'];       
                  ?>
                        <div><a href="/login/logout.php" class="deconnexion">Déconnexion</a></div>
                        <div> <a href="/administration/admin.php" class="deconnexion">Gerer</a></div>
                   <?php                 
                } else if($role['role'] === 'Gerant'){ 
                  echo $role['role'];       
                  ?>
                        <div><a href="/login/logout.php" class="deconnexion">Déconnexion</a></div>
                        <div> <a href="/administration/suitesgerant.php" class="deconnexion">Gerer</a></div>
                   <?php   
                   
                } else {

                      echo $role['prenom']. '<br>';?>
                     <div><a href="/login/logout.php" class="deconnexion">Déconnexion</a></div>
                     <a href="/main/voirres.php">Reserves</a>
                     <?php };         
         } else {
         ?><a href="../login/login.php">Connection</a> <?php
         };

         ?>
   </div>
</header>
