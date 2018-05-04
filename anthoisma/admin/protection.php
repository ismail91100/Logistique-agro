<?php 
	session_start();

    //test de l'existence de $_SESSION[auth] --------> login
    if(!isset($_SESSION['auth'])){

        //pas authentifié
        $msg="Vous n'êtes pas authentifié"; // message d'erreur 

         header("location:" . "../index.php?msg=" . $msg); //redirige vers la page de connexion
    }
?>