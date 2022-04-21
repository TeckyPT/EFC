<?php 
 include('header.php'); 
 $checkin = $_POST['checkin'];
 $checkout = $_POST['checkout'];

 if (!empty($checkin) && !empty($checkout)) {
   

 $idhotel = $_POST['idhotel'];
 $roomnumber = $_POST['roomnumber'];
 $price = $_POST['price'];


 $idclient = $_POST['iduser'];

 function NbJours($debut, $fin) {
    $tDeb = explode("-", $debut);
    $tFin = explode("-", $fin);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    return(($diff / 86400)+1);
  }
    $Nombres_jours =  NbJours($checkin, $checkout);
    $pricetotal = $price * $Nombres_jours;


 if(isset($_SESSION["email"],)) {
   
 
        $emailuser = $_SESSION["email"];
        $queryuser = "SELECT id,nom FROM `client` WHERE email='$emailuser'";
        $uservalidator = mysqli_query($conn,$queryuser);
        $user = $uservalidator->fetch_assoc();
        echo '
        <div class="confirmreserv">
           <h4> Salut '. $user['nom'].'</h4>
                <div>
                 <p>Votre Reserve Du '.$checkin.' au '.$checkout.'</p>
                <p>Pour '. $Nombres_jours.'  Jours</p>
                 <p>Prix '. $pricetotal.' Euros </p>
                </div>
        

        <div class="divconfirm">
             <form method="post" id="form1">
                <input id="price" name="confirm" type="hidden" value="">
                <input id="price" name="checkin" type="hidden" value="'.$checkin.'">
                <input id="price" name="checkout" type="hidden" value="'.$checkout.'">
                <input id="price" name="idhotel" type="hidden" value="'.$idhotel.'">
                <input id="price" name="roomnumber" type="hidden" value="'.$roomnumber.'">
                <input id="price" name="price" type="hidden" value="'.$price.'">
                <input id="price" name="iduser" type="hidden" value="'.$idclient.'">

             <input class="btnajouter" type="submit" value="Confirmer" form="form1">
         </form>
        </div>';
            
                if (isset($_POST['confirm'])) {

                    $checkin = $_POST['checkin'];
                    $checkout = $_POST['checkout'];
                    $idhotel = $_POST['idhotel'];
                    $roomnumber = $_POST['roomnumber'];
                    $price = $_POST['price'];
                    $idclient = $_POST['iduser'];

                    $mysqli = new mysqli("localhost:3307", "tecky", "tecky", "hotel");
                    $mysqli->set_charset("utf8");
                    $requete = "INSERT INTO booking VALUES('','$checkin',' $checkout','$roomnumber','$idhotel','$idclient')";
                    $resultat = $mysqli->query($requete);

                    if ($resultat) {
                        echo "<p>Le Reserv est confirme";
                    } else {
                        echo   "<p>Erreur</p>";
                    }}
                    
      '</div>
        ';} 

 } else {
   echo 'introduir les dates avant de reserver';
 }
 ?>
