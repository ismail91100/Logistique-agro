<?php 
    include('protection.php');

    //titre de la page
    $titre="Contact Manager : gestion des contacts | Congo Connexion";

    include ('pdo.php');

    //requete à executer
    $query='SELECT * FROM users';


    //requete pour filtrer
    if(isset($_GET['search'])){
        $query="SELECT  * FROM users WHERE nom LIKE" .  "'%" . $_GET['valueToSearch'] . "%'";
    }
    try {
        //instanciation 
        $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        //execution de la requete et obtention d'un statement
        $stmt = $pdo->query($query);

        //mode de fetch
        $stmt->setFetchMode(PDO::FETCH_OBJ);

    }
    catch(PDOException $e) {
        $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
        echo $msg;
        exit;
    }
    
?>

<?php 
        include("includes/header.php");
        include("includes/bandeau.php");
        include("includes/searchuser.php");
?>


<div class ="container-fluid contenu"> 
    <div class ="container">
        <div class ="row">
            <div class="col-md-12">
                <?php
                    if ($stmt->rowCount()>0) {

                        echo "<h1>Liste des utilisateurs</h1>";

                        echo "<br>";

                        echo "<table class='table table-hover table-bordered'>
                                <tr class = 'entetetable'> 
                                    <td>Login</td> 
                                    <td>Nom</td> 
                                    <td>Prénom</td> 
                                    <td>Role</td> 
                                    <td>MAJ</td> 
                                    <td>Supp</td>
                                </tr>";
                                
                                    while($donnees = $stmt->fetch()) {
                                        $id = $donnees->id;
                                        $login = $donnees->login;
                                        $nom = $donnees->nom;
                                        $prenom = $donnees->prenom;
                                        $role = $donnees->role;



                                        echo "<tr>" .
                                                "<td>" . $login . "</td>" .
                                                "<td>" . $nom . "</td>" .
                                                "<td>" . $prenom . "</td>" .
                                                "<td>" . $role . "</td>" .

                                                "<td><a href='modifierUser.php?id=$id'><img src='images/update.png' width='25'/></a></td>" .

                                                "<td><a href='#' onclick=deleteUsers($id)><img src='images/delete.png' width='20'/></a></td>" .
                                             "</tr>"; 
                                    }
                        echo "</table>"; 
                    }
                    else {
                        echo 'Aucun utilisateur trouvé';
                        echo "<script>alert('Aucun utilisateur trouvé')</script>";
                        }
                ?>

            </div>
        </div>
    </div>
    <br/>
        <br/>
    <br/>

</div>
<?php 
    include("includes/footer.php");
    $pdo=null;

?>


