
<div class="text-center textmain">
Hypnos est un groupe hôtelier fondé en 2004. Propriétaire de 7 établissements dans les quatre
coins de l\’hexagone
</div>

<?php

try {
  $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
  $etablissement = 'SELECT nom,ville,adress,discription,lien,id_ville,MIN(price) as minimum FROm etablissement INNER JOIN room on etablissement.id_ville = room.idhotel GROUP BY nom';
  $dpoState = $pdo->prepare($etablissement);
  if ($dpoState->execute()){

  } else {
      var_dump($dpoState->errorInfo());
  };
  foreach ($pdo->query($etablissement,PDO::FETCH_ASSOC) as $etablissements){


      echo '<div class="text-center etablissment">
      <div class="etaimg"><img class="im" src="'.$etablissements['lien'].'"></div>
      <div class="etadescript">
        <div class="etaleft">
          <h5 class="nometa text-left">'.$etablissements['nom'].'</h5>
          <p class="tx">'.$etablissements['ville'].'</p>
          <p class="tx lws">'.$etablissements['adress'].'</p>
          <div class ="tx">
          <span><img class="rest" src="https://www.to-toscane.fr/cmsdata/db/images/infopages/content/c/restaurant_icon-72-9.jpg" alt="">Restaurant</span>
           <span><img class="hotel" src="data:image/png;base64,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" alt="">  Hôtel</span>
           </div>
           <div class="reserv">
              <div class="lw tx bg">Confirmation immédiate</div>
              <div class="lx tx bg">Réservez maintenant, payez sur place</div>
           </div>
        </div>
        <div class="etaright fr">
          A partir d '.$etablissements['minimum'].'€
        <div>
        </div>
           <div class="btnchambres">
           <form method="POST" action="/main/suites.php">
            <input id="idhotel" name="idhotel" type="hidden" value="'.$etablissements['id_ville'].'">
            <button type="submit" class="btn">Voir les chambres</button>
          </form>
           
           </div>
        </div>
      </div>
      <div class="tx disc">'.$etablissements['discription'].'</div>
    </div>';
  }
} catch (PDOException $e) {
  echo 'impossibel de se connecter a base de donnes';
};

?>

