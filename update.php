<?php
include ('connect.php');

// on recupere l'ID du film dans l'url
$id=$_GET['id'];

$req=$db->query("SELECT * FROM video WHERE id_video = $id");

$film=$req->fetchALL(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <h1 style="background-color:#C0C0C0; text-align:center">Page de modification du film n° <?= $id ?></h1>
   <form style="text-align:center" class="form_update" method="post" action="update.php?id=<?= $id ?>">
      <?php foreach ($film as $film): ?>
       
       <label for="">Titre du film</label><input type="text" name="titre" value="<?= $film->titre ?>"><br>
       <label for="">Realisateur</label><input type="text" name="realisateur" value="<?= $film->realisateur ?>"><br>
       <label for="">Acteurs</label><input type="text" name="acteurs" value="<?= $film->acteurs ?>"><br>
       <p>Description</p><textarea name="description" id="" cols="50" rows="8"><?= $film->description ?></textarea><br>
       
       <?php endforeach ?>
       <input type="submit" name="valider" value="Envoie ta modif' ma biche">
   </form>
   
<?php   
if($_POST){
    $titre=$_POST["titre"];
    $realisateur=$_POST["realisateur"];
    $acteurs=$_POST["acteurs"];
    $description=$_POST["description"];
   
    
    $sql = $db->prepare("UPDATE video SET titre = :titre, realisateur = :realisateur, acteurs = :acteurs, description = :description WHERE id_video = :id");
    
        $edit = $sql->execute([
            'titre'=> $titre,
            'realisateur' => $realisateur,
            'acteurs' => $acteurs,
            'description' => $description,
            'id' => $id
        ]);
            header('Location: dashboard.php');
   
}     
    ?>
</body>
</html>