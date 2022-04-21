<?php  include('header.php');


if (isset($_SESSION["email"],)){
            $emailuser = $_SESSION["email"];
            $reserva = "SELECT email,bookingid,id,bookingstart,bookingend,adress,id_ville,etablissement.nom as hotel_nom 
            FROM client 
            INNER JOIN booking ON booking.clientid = client.id
            INNER JOIN etablissement ON etablissement.id_ville = booking.hotelid
            WHERE email='$emailuser'";
            $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
   
              $dpoState = $pdo->prepare($reserva); 
       try {

                if ($dpoState->execute()){
       
                } else {
                    var_dump($dpoState->errorInfo());
                };

                $count = $dpoState->rowCount();
            if ($count == 0) {
                echo 'Vouz ne avez pas de reservation sur notre site';
            } else {
                foreach ($pdo->query($reserva,PDO::FETCH_ASSOC) as $reservas){

                    $start = $reservas['bookingstart'];
                    $end = date("Y-m-d");

                    $Nombres_jours =  NbJours($end, $start);
                    if ($Nombres_jours >= 3) {
                        echo '
                        <div class="box">
                        <div class="ne">
                            <div class="sp3">Reserv N:'.$reservas['bookingid'].'</div>
                            <div class="sp3">'.$reservas['hotel_nom'].'</div>
                            <div class="sp4">'.$reservas['adress'].'</div>
                            <div class="sp1">'.$reservas['bookingstart'].': </div> 
                            <div class="sp2">'.$reservas['bookingend'].'</div>
                            <form method="post" id="form4">
                                <input type="hidden" name="id" value="'.$reservas['bookingid'].'">
                            <input type="submit" value="Supprimer" form="form4">
                        </form>
                        </div>
                    </div>';
                    if (isset($_POST['id'])) {

                        $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
                        $id = $_POST['id'];
                            $sql = "DELETE FROM BOOKING WHERE `bookingid` = :id";
                            $stmt = $pdo->prepare($sql);
                            $id = $_POST['id'];
                            $stmt->bindValue(':id', $id);
                            $res = $stmt->execute(); 
                            header("Refresh:0");
                }   

                    } else {
                        echo '
                        <div class="box">
                        <div class="ne">
                            <div class="sp3">Reserv N:'.$reservas['bookingid'].'</div>
                            <div class="sp3">'.$reservas['hotel_nom'].'</div>
                            <div class="sp4">'.$reservas['adress'].'</div>
                            <div class="sp1">'.$reservas['bookingstart'].': </div> 
                            <div class="sp2">'.$reservas['bookingend'].'</div>
                        </div>
                    </div>';    
                    };
           }}

      } catch (PDOException $e) {
        echo 'impossibel de se connecter a base de donnes';
      };      
    };
    function NbJours($debut, $fin) {
        $tDeb = explode("-", $debut);
        $tFin = explode("-", $fin);
        $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
                mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
        return(($diff / 86400)+1);
      }


  ?>