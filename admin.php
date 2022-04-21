<link rel="stylesheet" href="../style/admin.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../style/main.css">
<?php 
include('./etablissement.php');
include('./gerant.php');
include('../main/header.php');

	$admin = $_SESSION["email"];

	if($admin !== 'Admin@hotmail.com'){
		header("Location: ../index.php");
		exit(); 
	}
		add_etablissement();
		remove_etablissement();
		list_etablissement();

        add_gerant();
		remove_gerant();
		list_gerant();
	?>
