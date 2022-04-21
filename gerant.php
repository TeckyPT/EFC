<?php


function add_gerant(){
    ?>
    <h1>Ajouter Compte Gerant</h1>
        <form method="post" id="form2">
            <label>Nom</label>
            <input type="text" name="nom_gerant">
            <label>Prenom</label>
            <input type="text" name="prenom">
            <label>email</label>
            <input type="text" name="email">
            <label>password</label>
            <input type="password" name="password">
            <label>Choiser son Role<label>
            <div>
            <input type="radio" id="Gerant" name="role" value="Gerant"
                    checked>
            <label for="Gerant">Gerant</label>
            </div>
            <div>
            <input type="radio" id="Client" name="role" value="Client">
            <label for="Client">Client</label>
            </div>
            <input type="submit" value="Ajouter" form="form2">

        </form>
    
    <?php
  $mysqli = new mysqli("localhost:3307", "tecky", "tecky", "hotel");
    if (isset($_POST['nom_gerant'])) {
        $nom = $_POST['nom_gerant'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $mysqli->set_charset("utf8");
        $requete = "INSERT INTO client VALUES('0','$nom','$prenom','$email','Gerant','".hash('sha256', $password)."')";
        $resultat = $mysqli->query($requete);
        if ($resultat)
            echo "<p>Le Compte gerent a été ajouté</p>";
        else
            echo "<p>Erreur email already in use</p>";
    }
}

function list_gerant() {
    ?>		
    <h1>List Gerant</h1>
 <?php
    try {
        $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
        $gerant = 'SELECT * FROm client';
        $dpoState = $pdo->prepare($gerant);
        if ($dpoState->execute()){
    
        } else {
            var_dump($dpoState->errorInfo());
        };
        foreach ($pdo->query($gerant,PDO::FETCH_ASSOC) as $gerants){
            echo 'Nom : '.$gerants['nom'].
             ' Prenom : ' .$gerants['prenom'].
             ' Email : '. $gerants['email'].
             ' Role : '. $gerants['role'].
             ' ID : '. $gerants['id'].
             '<br>' ;
        }
    } catch (PDOException $e) {
        echo 'impossibel de se connecter a base de donnes';
      };
    };

    function remove_gerant(){
        ?>		
            
                <form method="post" id="form4">
                <h1>Supprimer gerant</h1>
                <label>ID gerant</label>
                <input type="text" name="id">
                <input type="submit" value="Supprimer" form="form4">
            </form>
         <?php
         if (isset($_POST['id'])) {
            $pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
            $id = $_POST['id'];
                $sql = "DELETE frOM client WHERE `id` = :id";
                $stmt = $pdo->prepare($sql);
                $id = $_POST['id'];
                $stmt->bindValue(':id', $id);
                $res = $stmt->execute(); 
        }}
?>