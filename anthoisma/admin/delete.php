<?php include ('pdo.php');?>

    <?php
       
         //Tu recuperes l'id du contact
         $id = $_GET['id_aliment'];
         //Requete SQL pour supprimer le contact dans la base
        
         try {
        //instanciation 
        $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $req = "DELETE FROM stock WHERE id_aliment = '$id'";
        //execution de la requete et obtention d'un statement
        $stmt = $pdo->query($req);

        //mode de fetch
        $stmt->setFetchMode(PDO::FETCH_OBJ);

    }
    catch(PDOException $e) {
        $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        echo $msg;
    }


         //Et la tu rediriges vers ta page contacts.php pour rafraichir la liste
         header("location:" . "list.php");
    ?>