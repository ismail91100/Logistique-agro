
<?php 
        $titre = "Modifier";
        include("includes/header.php");
        include("includes/bandeau.php");

?>
<?php

include ('pdo.php');
      //recuperation de l'id du contact
     if(isset($_GET['id_aliment'])){
        $id=$_GET['id_aliment'];
      
      try {
              //instanciation 
              $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
              $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $req="SELECT * FROM aliment WHERE id_aliment=" . $id;

              //execution de la requete et obtention d'un stmt  
              $stmt=$pdo->query($req);

              //mode de fetch
              $stmt->setFetchMode(PDO::FETCH_OBJ);
              $donnees = $stmt->fetch();
            }
                              
      catch(PDOException $e) {
              $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
              echo $msg;
              exit;
      }
     }

        if (!empty($_POST['submit'])) {
            $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password);
            $id=$_POST['id_aliment'];
            $nom=$_POST['nom'];
            $quantite=$_POST['quantite'];
            $id_fournisseur=$_POST['id_fournisseur'];




        $req = $pdo->prepare('UPDATE aliment SET nom=:nom, quantite=:quantite, id_fournisseur=:id_fournisseur WHERE id = :id');

        $req->execute(array(
            'id' => $id,

            'nom' => $nom,

            'quantite' => $quantite,

            'id_fournisseur' => $id_fournisseur,


            ));            header('location: list.php');


         
        
}
?>


  <body>
    <form method="post" action="modifier.php">
      <div class="addform">
        <div class="form-group row ">
            <label for="nom" class="col-2 col-form-label">Nom</label>
            <div class="col-10">
              <input class="form-control" type="text"  id="nom" name="nom" value="<?php echo $donnees->nom?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-2 col-form-label">quantite</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?php echo $donnees->quantite?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="mail" class="col-2 col-form-label">id_fournisseur</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?php echo $donnees->id_fournisseur?>">
            </div>
        </div>
        <button type = "submit" id="submit" name="submit" value="submit" class="btn btn-primary">Modifier</button>
        <br/>
<br/>
<br/>
<br/>

      </div>
    </form>
<?php 
    include("includes/footer.php");

?>
