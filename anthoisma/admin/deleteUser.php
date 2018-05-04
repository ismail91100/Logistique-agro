    <?php
        include ('pdo.php');
        //Tu recuperes l'id du contact
        $id = $_GET['id'];
        //Requete SQL pour supprimer le contact dans la base
        
        try {
        //instanciation 
        $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $req = "DELETE FROM users WHERE id = $id";
        //execution de la requete et obtention d'un statement
        $stmt = $pdo->query($req);
        //Et la tu rediriges vers ta page contacts.php pour rafraichir la liste
         header("location:" . "user.php");
    }
    catch(PDOException $e) {
        $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        echo $msg;
    }


         
    ?>