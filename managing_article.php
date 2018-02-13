<?php
include ('connect.php');

// On crée la requete
// On envoie la requete
$req=$db->query('SELECT * FROM video ORDER BY id_video ASC');
//on va scanner les tuples 1 à 1
$data=$req->fetchAll(PDO::FETCH_OBJ);
  
$i=0; // i est initialisé pour la coloration des lignes
?>


    <!DOCTYPE html>
    <html lang="fr">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mes articles en mode Admin</title>
    <style>
        .ligne_tableau td {
            padding: 10px;
            }
    
            .ligne_tableau .mod a {
                text-decoration: none;
                background-color: bisque;
            }
    
            .ligne_tableau .mod {
                width: 150px;
            }
    
            @media screen and (max-width: 720px) {
    
                table,
                tbody,
                tr,
                td {
                    display: block;
                    width: auto!important;
                    /* parceque tu as mis des style inline grrr */
                }
    
                #tr_column {
                    display: none;
                }
    
            }
        </style>
    </head>

    <body>
        
        <div class="entete">
            <h1>Bonjour, bienvenue sur la videotheque de Mr LAMBERT</h1>
            <p><a href="dashboard.php">Cliquez ici pour revenir à l'accueil du site</a></p>
        </div>
        <!-- PArtie recherche par genre etc -->

        <p id="selectp">Selectionnez ici pour classer par genre, titre ou realisateur</p>
        
            <form method="post" action="genre.php" id="form_genre" style="text-align:center">
                
                    <!--- Par genre -->
                    
                        <select name="genre" onChange="trier_film();">
                <option value="">------ Par Genre ------</option>
                <?php
                $req_genre=$db->query('SELECT DISTINCT id_genre FROM video');
                $donnees=$req_genre->fetchAll(PDO::FETCH_OBJ);
                foreach($donnees as $donnees):
                ?>
                <option value="<?= $donnees->id_genre ?>"><?php echo $donnees->id_genre ?></option>
                
                <?php endforeach ?>
               </select>
                    

                    <!-- Par titre -->
                    
                        <select name="titre" onChange="trier_film();">
                <option value="">------ Par Titre ------</option>
                <?php
                $titre=$db->query('SELECT DISTINCT titre FROM video');
                $donnees=$titre->fetchAll(PDO::FETCH_OBJ);
                foreach($donnees as $donnees):
                ?>
                <option value="<?= $donnees->titre ?>"><?php echo $donnees->titre ?></option>
                
                <?php endforeach ?>
               </select>
                     
                       <!-- par realisateur -->
                        <select name="realisateur" onChange="trier_film();">
                <option value="">------ Par Realisateur ------</option>
                <?php
                $real=$db->query('SELECT DISTINCT realisateur FROM video');
                $donnees=$real->fetchAll(PDO::FETCH_OBJ);
                foreach($donnees as $donnees):
                ?>
                <option value="<?= $donnees->realisateur ?>"><?php echo $donnees->realisateur ?></option>
                
                <?php endforeach ?>
               </select>
                
                <input type="submit" id="button_form" value="ok">
            </form>
    

        <div id=container>
            <h1 style="background-color:#C0C0C0; text-align:center"> Affichage de mes films preferes</h1>
            <table>
                <tr id="tr_column" style="background-color:#C0C0C0; text-align:center">
                    <td class="entete_tableau">ID video</td>
                    <td class="entete_tableau">ID genre</td>
                    <td class="entete_tableau">Titre</td>
                    <td class="entete_tableau">Realisateur</td>
                    <td class="entete_tableau">Acteurs</td>
                    <td class="entete_tableau">Description</td>
                    <td class="entete_tableau">Jaquette</td>
                    <td class="entete_tableau">Modifier</td>
                    <td class="entete_tableau">Supprimer</td>
                </tr>
                <?php
            foreach($data as $data):
       ?>

                    <tr class="ligne_tableau" style="background-color:<?php echo (++$i%2==0 ? " #C0C0C0 " : "#FFFFFF "); ?>">
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

                        <td><img src="images/<?php echo $data->jaquette ?>" alt="jaquette" /></td>

                        <td class="mod"><a href="?id=<?php echo $data->id_video?>" class="a_modif">Modif' la fiche </a></td>

                        <td class="mod"><a href="?id=<?php echo $data->id_video?>" class="a_supp">Supprim' la fiche </a></td>
                    </tr>
                    <?php endforeach ?>
                    <!-- FERMETURE BOUCLE !!! -->
            </table>

        </div>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
            $(".a_modif").click(function(e) {
                var href = $(this).attr('href');
                e.preventDefault(e);  //empeche le href du lien de se lancer
                $('#center').load(
                "update.php" + href, 
            )});
                $(".a_supp").click(function(e) {
                var href = $(this).attr('href');
                e.preventDefault(e);  //empeche le href du lien de se lancer
                $('#center').load(
                "delete.php" + href, 
            )});
                
                /**** Chargement page genre / par tri ****/
                $("#form_genre").submit(function(){
                    $.ajax({type:"POST", data: $(this).serialize(), url:"genre.php",
                    success: function(data){
                        $("#center").html(data);
                     
                },
                    error: function(){
                        $("#center").html('Une erreur est survenue.');
                }
            });
            return false;
        });
     
            function trier_film() {
                document.form_genre.submit();
            }
});

            
            
            
            
            
            
            /*$(document).ready(function() {
                $('.a_modif').click(function(e) {
                    e.preventDefault();
                    var index = $(".a_modif").index(this);
                    var index2 = index + 1;
                    $('#center').empty().append($.ajax({
                        url: 'update.php', // La ressource ciblée
                        type: 'GET', // Le type de la requête HTTP.
                        data: 'id=' + index2,
                        async: false,
                    }).responseText);
                    return false;
                });
                $('.a_supp').click(function(e) {
                    e.preventDefault();
                    var index = $(".a_supp").index(this);
                    var index2 = index + 1;
                    $('#center').empty().append($.ajax({
                        url: 'delete.php', // La ressource ciblée
                        type: 'GET', // Le type de la requête HTTP.
                        data: 'id=' + index2,
                        async: false,
                    }).responseText);
                    return false;
                });
                

            });*/
        </script>
    </body>

    </html>