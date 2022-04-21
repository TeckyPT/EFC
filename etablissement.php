

<?php 

function list_etablissement() {
    ?>		
    <h3>List Etablissement</h3>
 <?php
    try {
        $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
        $etablissement = 'SELECT * FROm etablissement';
        $dpoState = $pdo->prepare($etablissement);
        if ($dpoState->execute()){
    
        } else {
            var_dump($dpoState->errorInfo());
        };
        foreach ($pdo->query($etablissement,PDO::FETCH_ASSOC) as $etablissements){
            echo '<div class="text-center etablissment1">
            <div class="etaimg"><img class="im" src="'.$etablissements['lien'].'"></div>
            <div class="etadescript">
              <div class="etaleft">
                <h5 class="nometa text-left">'.$etablissements['nom'].'</h5>
                <p class="tx">'.$etablissements['ville'].'</p>
                <p class="tx lws">'.$etablissements['adress'].'</p>
                <div class ="tx">
                ID : '.$etablissements['id_ville'].'
                 </div>
                </div>
              </div>
            </div>
          </div>';
        }
    } catch (PDOException $e) {
        echo 'impossibel de se connecter a base de donnes';
      };
    };
    "<div class='sucess'>
    <h3>Vous êtes inscrit avec succès.</h3>
    <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
    </div>";
    
function remove_etablissement(){
            ?>		
                <h3>Supprimer Etablissement</h3>
                    <form method="post" id="form3">
                    <label>ID etablissement</label>
                    <input type="text" name="id_ville">
                    <input type="submit" value="Supprimer" form="form3">
                </form>
             <?php
             if (isset($_POST['id_ville'])) {
                $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
                $id = $_POST['id_ville'];
                    $sql = "DELETE frOM etablissement WHERE `id_ville` = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':id', $id);
                    $res = $stmt->execute(); 
            }}

function add_etablissement(){

    $mysqli = new mysqli("localhost:3307", "tecky", "tecky", "hotel");
      ?><div class="etaform">
		<form method="post" id="form1">
            <div class="d-flex flex-column text-right">
                <h3>Ajouter un Etablissement</h3>
                <div class="p-2">
                 <label>Nom</label>
                 <input type="text" name="nom">
                 </div>
                <div class="p-2">
                 <label>Ville</label>
                 <input type="text" name="ville">
                </div>
                <div class="p-2">
                <label>Adress</label>
                <input type="text" name="adress">
                </div>
                <div class="p-2">
                <label>Lien Photo</label>
                <input type="text" name="lien">
                </div>
                <div class="p-2 align-middle">
                <label>Description</label>
                <textarea type="text" name="description"></textarea>
                </div>
                <input class="btnajouter" type="submit" value="Ajouter" form="form1">
                </div> 
		</form>
        </div>	
		<?php
		if (isset($_POST['nom'],($_POST['ville']),$_POST['adress'],$_POST['description'])) {
			$nom = $_POST['nom'];
			$ville = $_POST['ville'];
			$adress = $_POST['adress'];
			$description = $_POST['description'];
            $lien = $_POST['lien'];
            $mysqli->set_charset("utf8");
            $requete = "INSERT INTO etablissement VALUES('$nom','$ville','$adress','$description','$lien','0')";
		    $resultat = $mysqli->query($requete);
            if ($resultat)
                echo "<p>Le Etablissement a été ajouté</p>";
            else
                echo "<p>Erreur</p>";
		}
};


?>




