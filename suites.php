
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
        <link rel="stylesheet" href="../style/main.css">
        <link rel="stylesheet" href="../style/header.css">  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Hotel</title>
    </head>
    <body>

    <?php include('header.php'); 

         $idhotel = $_POST['idhotel'];
         

          if(isset($_SESSION["email"],)){
            $emailuser = $_SESSION["email"];
            $queryuser = "SELECT * FROM `client` WHERE email='$emailuser'";
            $uservalidator = mysqli_query($conn,$queryuser);
            $role = $uservalidator->fetch_assoc();
            try {
              $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
                 $room = "SELECT * FROm room where idhotel = {$idhotel} GROUP BY price";
                 $dpoState = $pdo->prepare($room);
                 if ($dpoState->execute()){
             
                 } else {
                     var_dump($dpoState->errorInfo());
                 };
          
              foreach ($pdo->query($room,PDO::FETCH_ASSOC) as $rooms){
                     echo '<div class="text-center etablissment">
                     <div class="etaimg"><img class="im" src="'.$rooms['image'].'"></div>
                     <div class="etadescript">
                       <div class="etaleft">
                         <h5 class="nometa text-left">'.$rooms['titre'].'</h5>
                         <p class="tx">'.$rooms['text'].'</p>
                         <p class="tx lws">Price : '.$rooms['price'].' Euros/nuite</p>
                       </div>
                       <div class="etaright fr">
                         <div>
                         <a target="_blank" href="'.$rooms['lienbooking'].'">Booking.com</a>
                         </div>
                          <div class="btnchambres">
                          <form method="POST" action="/main/reservas.php">
                              <input id="roomimage" name="roomimage" type="hidden" value="'.$rooms['image'].'">
                              <input id="price" name="price" type="hidden" value="'.$rooms['price'].'">
                              <input id="idhotel" name="idhotel" type="hidden" value="'.$rooms['idhotel'].'">
                              <input id="roomnumber" name="roomnumber" type="hidden" value="'.$rooms['roomnumber'].'">
                              <input id="iduser" name="iduser" type="hidden" value="'.$role['id'].'">
                              <span>Check IN : </span><input type="date" name="checkin" id="checkin" onblur="getVal()">
                              <span>Check Out :</span><input type="date" name="checkout" id="checkout">
                              <button type="submit" class="btn" id="btn">Reserver</button>
                         </form>
                          </div>
                       </div>
                     </div>
                   </div>';
   
                 }
             } catch (PDOException $e) {
                 echo 'impossibel de se connecter a base de donnes';
               }; 

          } else {
            try {
              $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
                 $room = "SELECT * FROm room where idhotel = {$idhotel} GROUP BY price";
                 $dpoState = $pdo->prepare($room);
                 if ($dpoState->execute()){
             
                 } else {
                     var_dump($dpoState->errorInfo());
                 };
          
              foreach ($pdo->query($room,PDO::FETCH_ASSOC) as $rooms){
                     echo '<div class="text-center etablissment">
                     <div class="etaimg"><img class="im" src="'.$rooms['image'].'"></div>
                     <div class="etadescript">
                       <div class="etaleft">
                         <h5 class="nometa text-left">'.$rooms['titre'].'</h5>
                         <p class="tx">'.$rooms['text'].'</p>
                         <p class="tx lws">Price : '.$rooms['price'].' Euros/nuite</p>
                       </div>
                       <div class="etaright fr">
                         <div>
                         <a target="_blank" href="'.$rooms['lienbooking'].'">Booking.com</a>
                         </div>
                          <div class="btnchambres">
                          <div>Pour reserver connectez vous</div>
                          <span>Check IN : </span><input type="date" name="checkin" id="checkin" onblur="getVal()">
                          <span>Check Out :</span><input type="date" name="checkout" id="checkout">
                          </div>
                       </div>
                     </div>
                   </div>';
                 }
             } catch (PDOException $e) {
                 echo 'impossibel de se connecter a base de donnes';
               }; 
          }
         
 ?>
    
    <footer><?php include('footer.php');  ?></footer>

    </body>
    </html>
