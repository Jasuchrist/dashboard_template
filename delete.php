<?php
include ('connect.php');

// on recupere l'ID du film dans l'url
$id=$_GET['id'];

$req=$db->query("SELECT * FROM video WHERE id_video = $id");

$film=$req->fetchALL((PDO::FETCH_OBJ));




if($_POST){
    $del= $db->query("DELETE FROM video WHERE id_video = $id");
    header('Location: index.php');
}else{
  echo 'ça n\'a pas marché';
}
        

?>


    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h2 style="background-color:#C0C0C0; text-align:center">Voulez-vous definitivement supprimer cette fiche du film n°
            <?= $id ?>
        </h2>
        <form style="background-color:#C0C0C0; text-align:center" action="delete.php?id=<?php echo $id ?>" method="post">
            <input type="hidden" name="num_film" value="<?= $film->id_video ?>">
            <button type="submit">Supprimer</button>
        </form>

    

    </body>

    </html>