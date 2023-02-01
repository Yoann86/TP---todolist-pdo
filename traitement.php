<?php

require 'connection.php';


try {

    $db = new PDO($dsn,"root","",$options);

    switch($_GET['traitement']){
        case "ajout":
            $contenu = $_POST['contenu'];

            if ($contenu==""){
                header('Location: ./index.php?erreur=1');
                break;
            }

            $sql = "INSERT INTO liste (contenu,statut) VALUES ('$contenu',0)";
            $db->exec($sql);

            header('Location: ./index.php');
            break;
    
        case "suppression":
            $id = $_GET['id'];
            $sql = "DELETE FROM liste WHERE id=$id";
            $db->exec($sql);

            header('Location: ./index.php');
            break;
    
        case "check":
            $id = $_GET['id'];
            $statut = $_GET['statut'];

            if ($statut){
                $sql = "UPDATE liste SET statut=0  WHERE id='$id'";
                header('Location: ./index.php?1');
            }

            else {
                $sql = "UPDATE liste SET statut=1  WHERE id='$id'";
                header('Location: ./index.php?0');
            }

            $resultat = $db->query($sql);

            header('Location: ./index.php');
            break;
        
        case "obliteration":
            $sql = "DELETE FROM liste WHERE statut=1";
            $resultat = $db->query($sql);

            header('Location: ./index.php');
            break;
    }

} catch (Exception $e) {
    die("erreur :".$e->getMessage());
}


?>