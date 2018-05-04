<?php 
    include('protection.php');

    //titre de la page
    $titre="PROJET M1 | Gestion du stock";

    include ('pdo.php');

    $dsn=array($pdo_connect_bd, $pdo_username, $pdo_password);


    // La requête à exécuter
    if(!isset($_GET['nom'])){
        $query='SELECT * FROM aliment';
        $param="";
        } 


    //requete pour rechercher
    if(isset($_GET['nom'])){
        $nom=$_GET['nom'];
        $query="SELECT  * FROM aliment WHERE nom LIKE" .  "'%" . $_GET['nom'] . "%'";
        $param = "nom=" . $nom . "&";
    }
    try {
        //instanciation 
        $pdo = new PDO($pdo_connect_bd, $pdo_username, $pdo_password); // instancie la connexion
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        //execution de la requete et obtention d'un statement
        //$stmt = $pdo->query($query);
        // Le vrai total
        $sql = $query;
        $result = $pdo->query($sql);
        $total = $result->rowCount();
        
        
        // -----------------------------------
        // Nb étudiants par page
        $records_per_page=4;
        
        // Nouvelle requête
        $newquery = paging($query,$records_per_page);
        // -----------------------------------
        
        
        // Exécute la requête avec query() :renvoie une instance de PDOStatement
        $stmt = $pdo->query($newquery);

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
        include("includes/search.php");
        $nom_table = "stock";
?>


<div class ="container-fluid contenu"> 
    <div class ="container">
        <div class ="row">
            <div class="col-md-12">
                <?php
                    if ($stmt->rowCount()>0) {

                        echo "<h1>Liste des aliments&nbsp;&nbsp;<a href='add.php'><button type='button' class='btn btn-primary'>Ajouter des aliments</button></a>&nbsp;&nbsp</h1>";
                        
                     

                        echo "<br>";

                        echo "<table class='table table-hover table-bordered'>
                                 <tr class = 'entetetable'> 
                                    <td>id_aliment</td> 
                                    <td>nom</td>
                                    <td>quantite</td> 
                                    <td>id_fournisseur</td> 
 
                                    <td>MAJ</td> 
                                    <td>Supp</td>
                                </tr>";
                                
                                    while($donnees = $stmt->fetch()) {
                                        $id_aliment = $donnees->id_aliment;
                                        $nom = $donnees->nom;
                                        $quantite = $donnees->quantite;
                                        $id_fournisseur = $donnees->id_fournisseur;



                                        echo "<tr>" .
                                            "<td>" . $id_aliment . "</td>" .
                                            "<td>" . $nom . "</td>" .
                                            "<td>" . $quantite . "</td>" .
                                            "<td>" . $id_fournisseur . "</td>" .

                                             "<td><a href='modifier.php?id=$id_aliment'><img src='images/update.png' width='25'/></a></td>" .
                                      
                                            "<td><a href='#' onclick=deleteAliment($id_aliment)><img src='images/delete.png' width='20'/></a></td>" .
                                        "</tr>"; 
                                    }
                        echo "</table>"; 
                        echo "<br><b><p class='total'>Nombre total d'aliments : " . $total . "<br></p></b>";

                        // Liens de pagination
                            paginglink($query,$records_per_page, $param,$dsn);
                    }
                    else {
                        echo 'Aucun aliment trouvé';
                        echo "<script>alert('Aucun aliment trouvé')</script>";

                        }
                ?>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
   
</div>
<?php
    include ('pdo.php');

    // Pagination
    function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }
    
    // Liens de la pagination
    function paginglink($query,$records_per_page, $param,$dsn)
    {
        // La page courante
        $self = $_SERVER['PHP_SELF'];
        
        $pdo = new PDO($dsn[0], $dsn[1], $dsn[2]); // instancie la connexion

        
        $result = $pdo->query($query);
        //$result->execute();
        
        $total_no_of_records = $result->rowCount();
        
        if($total_no_of_records > 0)
        {
            ?><ul class="pagination"><?php
            
            // Nb total de pages = ceil(total des lignes / nb lignes par page)
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            
            // Page courante par défaut
            $current_page=1;
            
            // Page courante lue dans $_GET["page_no"]
            if(isset($_GET["page_no"]))
            {
                $current_page=$_GET["page_no"];
            }
            
            // Si on n'est pas à la 1ère page
            if($current_page!=1){
                // On peut revenir, définir $previous
                $previous =$current_page-1;
                
                // Afficher les liens : Premier et Précédent
                echo "<li><a href='".$self."?$param" . "page_no=1'>Premier</a></li>";
                echo "<li><a href='".$self."?$param" . "page_no=".$previous."'>Précédent</a></li>";
            }
            
            // Boucler pour avoir les liens intermédiaires
            for($i=1;$i<=$total_no_of_pages;$i++){
                if($i==$current_page){
                    echo "<li><a href='".$self."?$param" . "page_no=".$i."' style='color:red;'>".$i."</a></li>";
                }
                else{
                    echo "<li><a href='".$self."?$param" . "page_no=".$i."'>".$i."</a></li>";
                }
            }
            
            // Si on n'est pas à la dernière page, créer les liens Suivant et Dernier
            if($current_page!=$total_no_of_pages){
                $next=$current_page+1;
                echo "<li><a href='".$self."?$param" . "page_no=".$next."'>Suivant</a></li>";
                echo "<li><a href='".$self."?$param" . "page_no=".$total_no_of_pages."'>Dernier</a></li>";
            }
            ?></ul><?php
        }
    } // Fin liens de la pagination

?>
<?php 
    include("includes/footer.php");
    $pdo=null;

?>


