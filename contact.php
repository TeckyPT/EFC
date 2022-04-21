<?php
include('header.php');
?>

<div>
    <form class="contact" method="post" id="form1">
        <H2>Pousez votre Question</H2>
           <div>
                    <select name="sujets" id="sujets">
                            <option value="reclamation">Je souhaite poser une réclamation</option>
                            <option value="service">Je souhaite commander un service supplémentaire</option>
                            <option value="plus">Je souhaite en savoir plus sur une suite</option>
                            <option value="application">J’ai un souci avec cette application</option>
                    </select>
            </div>
                  <textarea class="area" type="text" name="description"></textarea>
                  <div>

                     <div>
                      <label>Votre Adress Email</label>
                      <input type="text" name="email"></text>
                      </div>
        <input class="btnajouter" type="submit" value="Envoyer" form="form1">
        </div>
       </div>
    </form>
<?php
	if (isset($_POST['sujets'])) {
        $mysqli = new mysqli("localhost:3307", "tecky", "tecky", "hotel");

        $sujets = $_POST['sujets'];
        $text = $_POST['description'];
        $email = $_POST['email'];
        $mysqli->set_charset("utf8");
        $requete = "INSERT INTO sujets VALUES('$sujets','$text','$email')";
        $resultat = $mysqli->query($requete);
        if ($resultat)
            echo "<p>Votre demande a ete bien ajoute</p>";
        else
            echo "<p>Erreur</p>";
    }
?>


    <style>

        .contact{

            margin: 0 auto;
            text-align: center;
        }

        .area{
            width: 400px;
            height: 200px;
            display: inline;
        }
    </style>

