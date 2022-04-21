<link rel="stylesheet" href="../style/admin.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../style/main.css">
<?php 
include('./etablissement.php');
include('./gerant.php');
include('../main/header.php');

	$emailuser = $_SESSION["email"];
    $queryuser = "SELECT * FROM `client` WHERE email='$emailuser'";
    $uservalidator = mysqli_query($conn,$queryuser);
    $role = $uservalidator->fetch_assoc();

if($role['role'] !== 'Gerant'){
	header("Location: ../index.php");
	exit(); 
} else {

	function add_suites(){

		$mysqli = new mysqli("localhost:3307", "tecky", "tecky", "hotel");
		  ?><div class="etaform">
			<form method="post" id="form1">
				<div class="d-flex flex-column text-right">
					<h3>Ajouter une Suite</h3>

					<div class="p-2">
						 <label>Titre</label>
						 <input type="text" name="titre">
						 </div>
								<div class="p-2">
								<label>Text</label>
								<input type="text" name="text">
								</div>
										<div class="p-2">
										<label>Price</label>
										<input type="text" name="price">
										</div>

		<div class="p-2">
			<label>Photo mise en avant</label>
			<input type="text" name="photo">
	   		</div>	
					<div class="p-2 align-middle">
					<label>Lien Booking</label>
					<input type="text" name="lien">
					</div>
								<fieldset>
							<label for="sponsor">Hotel</label>

							<select name="idhotel" id="sponsor">
								<?php 
										$pdo = new PDO('mysql:host=localhost:3307;dbname=hotel','tecky','tecky');
										try {
											$etablissment = 'SELECT id_ville,nom,ville FROm etablissement';
											foreach ($pdo->query($etablissment,PDO::FETCH_ASSOC) as $etablissments){
												echo '<option value="'.$etablissments['id_ville'].'">'.$etablissments['nom'].' - '.$etablissments['ville'].' </option>';
											}
										} catch (PDOException $e) {
											echo 'impossibel de se connecter a base de donnes';
										};
										?>	

								</select>	
							</fieldset>

								<div class="p-2 align-middle">
								<label>Room Number</label>
								<input type="text" name="rnumber">
								</div>

			<input class="btnajouter" type="submit" value="Ajouter" form="form1">
	</div> 
</form>
			</div>	
			<?php
			if (isset($_POST['titre'],($_POST['rnumber']),($_POST['text']),$_POST['price'],$_POST['photo'],$_POST['lien'],$_POST['idhotel'])) {
				$titre = $_POST['titre'];
				$text = $_POST['text'];
				$price = $_POST['price'];
				$photo = $_POST['photo'];
				$lien = $_POST['lien'];
				$idhotel = $_POST['idhotel'];
				$rnumber = $_POST['rnumber'];
				$mysqli->set_charset("utf8");
				$requete = "INSERT INTO room VALUES('$idhotel','$rnumber','	$titre','$photo','$text','$price','$lien')";
				$resultat = $mysqli->query($requete);
				if ($resultat)
					echo "<p>Le Etablissement a été ajouté</p>";
				else
					echo "<p>Erreur</p>";
			}
	};

	add_suites();



}



?>

