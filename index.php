<?php

require 'connection.php';

$erreur = 0;

if (isset($_GET['erreur'])){
    if ($_GET['erreur']==1){
        $erreur = 1;
    }
}

try {

    $db = new PDO($dsn,"root","",$options);
    $sql = "SELECT * FROM liste";
    $resultat = $db->query($sql);

} catch (Exception $e) {
    die("erreur :".$e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <div class="container">

    <h1>Ma Todo-list en php</h1>

    <form action="./traitement.php?traitement=ajout" method="post">
        <input class="" type="text" name="contenu" placeholder="Ici votre Todo">
        <input type="submit" name="submit" value="Soumettre Todo" >
    </form>
    
    <?php
    
    foreach ($resultat as $valeur) {?>
        
        <div class="li">
            <div class="statut<?php echo $valeur['statut'] ?>" ><?= $valeur['contenu'] ?></div>
            <a href='./traitement.php?traitement=suppression&id=<?= $valeur['id'] ?>'><div class="actionsup">X</div></a>
            <a class="actioncheck" href='./traitement.php?traitement=check&id=<?= $valeur['id'] ?>&statut=<?= $valeur['statut'] ?>'><div class="actioncheck">V</div></a>
        </div>
        
    <?php } ?>
    
    <br>
    <a class="obliteration "href="./traitement.php?traitement=obliteration">Supprimer les tâches effectuées</a>

    </div>

    <?php

        if ($erreur){
            echo "<br><h2>Erreur, votre todo est vide !</h2>";
        }

    ?>

</body>
</html>