<?php include ('pdo.php');?>

	 <!doctype html>
<html>
    <head>
        <style>
            body {
                background-color: gray; }
            table { 
                position : relative;
                margin-left : 25%;
                margin-top : 5%;
                margin-right : 25%;
                font-size : 12px;
                font-family : Verdana, arial, helvetica, sans-serif;
                color : #333333;
                text-align : center;
                background-color : #c6c3bd;
            }
        </style>
        <title>Liste des contacts</title>
        <meta charset="utf-8" />
    </head>
    <body>        
    	<form action="list.php" method="post">
            <input type="submit" name="retour" value="retour">
            <?php
                if(isset($_POST['retour'])){
                header("Location: http://localhost/contactmanager/list.php");
                exit;
                }

            ?>
            </form>
    	<table class="table table-list-search table table-hover" border="1">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Mail</th>
                            <th>Téléphone</th>
                        </tr>
                     </thead>
                    <tbody>
                        <?php
                            $nom=$_GET['nom']; 
							$stmt=$pdo->query('SELECT  * FROM contact WHERE nom LIKE "% . $nom . %"'); 
                            while($donnees = $stmt->fetch()) { 

 							
                            

                            ?>
                            <tr>
                            <td><?php echo $donnees['id']?></td>
                            <td><?php echo $donnees['nom'];?></td>
                            <td><?php echo $donnees['prenom']?></td>
                            <td><?php echo $donnees['mail']?></td>
                            <td><?php echo $donnees['telephone']?></td>
                            </tr>


                          <?php                             	

                            } ?>



                    </tbody>
        </table>  
    </body>
</html>        
