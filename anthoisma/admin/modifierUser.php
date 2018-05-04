
<?php 
        $titre = "Modifier users";
        include("includes/header.php");
        include("includes/bandeau.php");

?>
<?php

include ('pdo.php');
      //recuperation de l'id du contact
     if(isset($_GET['id'])){
        $id=$_GET['id'];


      
      try {
              //instanciation 
              $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
              $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              $req="SELECT * FROM users WHERE id=" . $id;

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
            $id=$_POST['id'];
            $login=$_POST['login'];
            $pwd=$_POST['pwd'];
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $role=$_POST['role'];
            $active=$_POST['active'];


      
        
        


        $req = $pdo->prepare('UPDATE users SET login=:login, nom=:nom, prenom=:prenom, role=:role WHERE id = :id');

        $req->execute(array(
            'id' => $id,

            'login' => $login,

            'nom' => $nom,

            'prenom' => $prenom,

            'role' => $role,


            ));
            header('location: user.php');

         
        
}
?>


  <body>
    <form method="post" action="modifierUser.php">
      <div class="addform">

      	<div class="form-group row">
            <label for="login" class="col-2 col-form-label">Login</label>
            <div class="col-10">
              <input class="form-control" type="text"  id="login" name="login" value="<?php echo $donnees->login?>">
            </div>
        </div>

        <div class="form-group row ">
            <label for="nom" class="col-2 col-form-label">Nom</label>
            <div class="col-10">
              <input class="form-control" type="text"  id="nom" name="nom" value="<?php echo $donnees->nom?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="prenom" class="col-2 col-form-label">Prenom</label>
            <div class="col-10">
              <input class="form-control" type="text"  id="prenom" name="prenom" value="<?php echo $donnees->prenom?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="role" class="col-2 col-form-label">Role</label>
            <div class="col-10">
               <input class="form-control" type="text" id="role" name="role" value = "<?php echo $donnees->role?>">
            </div>
              <input type ="hidden" name ="id" value="<?php echo $id;?>">

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
