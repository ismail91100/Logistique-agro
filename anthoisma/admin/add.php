<?php 
	include('protection.php');

	//titre de la page
    $titre="PROJET M1 | Gestion du stock";


		if (!empty($_POST['submit'])) {

			$nom=$_POST['nom'];
			$quantie=$_POST['quantite'];
			$id_fournisseur=$_POST['id_fournisseur'];

			include ('pdo.php');
			try {
			        //instanciation 
			        $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
			        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			        //requete prepare
			        $query='INSERT INTO contact(nom, quantite, id_fournisseur) VALUES(:nom, :quantite, :id_fournisseur)';
			        $req = $pdo->prepare($query);

			        // Attacher les parametres
			        $req->bindParam(':nom',$nom);
			       	$req->bindParam(':quantite',$quantite);
			       	$req->bindParam(':id_fournisseur',$id_fournisseur);

			        //execution de la requete
			        $req ->execute();
			        echo "Le contact de ID = " . $pdo->lastInsertId() . " a bien été ajouté !";
					
				    }
			    catch(PDOException $e) {
			        $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
			        echo $msg;
			    }

		header("location: list.php");
		}
header("location: list.php");

?>



	


<?php 
        include("includes/header.php");
        include("includes/bandeau.php");
?>


	<body>
	<div class="addform">
		<h1>Ajouter un contact</h1><br/>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			
				<div class="form-group row ">
	  				<label for="nom" class="col-2 col-form-label">Nom</label>
	  				<div class="col-10">
	    				<input class="form-control" type="text"  id="nom" name="nom">
	  				</div>
				</div>

				<div class="form-group row">
	  				<label for="prenom" class="col-2 col-form-label">Quantite</label>
	  				<div class="col-10">
	   					<input class="form-control" type="text"  id="prenom" name="prenom">
	  				</div>
				</div>

				<div class="form-group row">
				  	<label for="mail" class="col-2 col-form-label">id_fournisseur</label>
				  	<div class="col-10">
				    	<input class="form-control" type="email"  id="mail" name="mail">
				  	</div>
				</div>

				
				<button type = "submit" id="submit" name="submit" class="btn btn-primary" value="ajouter">Ajouter</button>
				<br/>
				<br/>
				<br/>
		</form>

		
</div>

<?php 
    include("includes/footer.php");
?>
