<?php
include ('connect.php');



if(isset($_POST['genre']) OR isset($_POST['titre']) OR isset($_POST['realisateur'])){

if($choix=$_POST['genre']){
$req=$db->prepare('SELECT * FROM video WHERE id_genre = :choix');

$data = $req -> execute([
    'choix' => $choix
]);}
elseif($choix=$_POST['titre']){
$req=$db->prepare('SELECT * FROM video WHERE titre = :choix');

$data = $req -> execute([
    'choix' => $choix
]);}
elseif($choix=$_POST['realisateur']){
$req=$db->prepare('SELECT * FROM video WHERE realisateur = :choix');
    
$data = $req -> execute([
    'choix' => $choix
]);}
}else{
    echo 'ça marche pas';
}

//on va scanner les tuples 1 à 1
$data=$req->fetchAll(PDO::FETCH_OBJ);
  
$i=0; // i est initialisé pour la coloration des lignes
?>



    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Videotheque Index</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div id=container>
           <h1 style="background-color:#C0C0C0; text-align:center"> Affichage de mes films preferes</h1>
            <table>
                <tr style="background-color:#C0C0C0;">
                    <td class="entete_tableau">ID video</td>
                    <td class="entete_tableau">ID genre</td>
                    <td class="entete_tableau">Titre</td>
                    <td class="entete_tableau">Realisateur</td>
                    <td class="entete_tableau">Acteurs</td>
                    <td class="entete_tableau">Description</td>
                    <td class="entete_tableau">Jaquette</td>
                </tr>
                <?php
            foreach($data as $data):
       ?>

                    <tr class="ligne_tableau"  style="background-color:<?php echo (++$i%2==0 ? "#C0C0C0" : "#FFFFFF"); ?>">
                        <td>
                            <?php echo $data->id_video ?>
                        </td>


                        <td>
                            <a href="fiche_categorie.php?id=<?= $data->id_genre ?>"><?php echo $data->id_genre ?></a>
                        </td>


                        <td>
                            <?php echo $data->titre ?>
                        </td>


                        <td>
                            <?php echo $data->realisateur ?>
                        </td>


                        <td>
                            <?php echo $data->acteurs ?>
                        </td>

                        <td>
                            <?php echo $data->description ?>
                        </td>

                        <td><a href="fiche_cine.php?id=<?php echo $data->id_video?>"><img src="<?php echo $data->jaquette ?>" alt="jaquette"/></a></td>
                    </tr>
                    <?php endforeach ?> <!-- FERMETURE BOUCLE !!! -->
            </table>
        </div>
        </body>