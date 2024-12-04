<!DOCTYPE html>
<html lang="fr">

<?php
$pageTitle = "Mes favoris"; 
include("includes/connect.php");
require_once("includes/head.php");
require("includes/functions.php");
?>

<body>
    <?php require_once("includes/navConnecte.php");?>
    <header>
        <br><br><br>
        <h2 style="text-align: center; color : crimson ">🤍 Regardez vos favoris ! 🤍</h2><hr>
        <!-- plus de pub, pas approprié pour cette page
            <div class="alert alert-info" role="alert"> 
            Des supers promos pour votre repas universitaire, ne loupez pas l'info !
            <a href="Images/Publicité/crous pub.gif">ICI</a>
        </div> -->
    </header>
    <main><br>
        <!-- Le main contient toutes les annonces des produits -->
        <?php
        $requete = "SELECT * FROM favoris WHERE NUM_UTILISATEUR = :unutilisateur ";
        $resultat = $bdd->prepare($requete);
        $resultat->execute(array('unutilisateur' => $_SESSION["identifiant"]));
        $annonceFavorite = $resultat->fetchAll();
        if ($annonceFavorite != null) {
            for ($i = 0; $i < count($annonceFavorite); $i++) {
                $requete2 = "SELECT * FROM coquillage WHERE NUM_ANNONCE = :uncoquillage";
                $resultat2 = $bdd->prepare($requete2);
                $resultat2->execute(array('uncoquillage' => $annonceFavorite[$i]["NUM_COQUILLAGE"]));
                $tab[$i] = $resultat2->fetch();
            }
            foreach ($tab as $key => $ligne) { ?>
                <div class="row" style="">
                    <div class="row cadre">
                        <div class="col-sm-3 ">
                            <div>
                                <img src="./Images/Annonces/<?php echo $ligne['PHOTO']; ?>" style="width:100%;border-radius:5%;" alt="Image de l'annnonce" />
                            </div>
                            <br>
                            <div style="display: flex;justify-content: space-between;">
                                <div>
                                    <a href="PageProduit1.php?annonce=<?php echo $ligne['NUM_ANNONCE']; ?>" title="Consulter l'annonce" class="boutonFond">Consulter</a>
                                </div>
                                <div>
                                    <?php
                                    if (empty($_SESSION["identifiant"]) || estEnFavoris($ligne['NUM_ANNONCE']) == "non") { ?>
                                        <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=MesFavoris.php"
                                        title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                                        <?php
                                    } else { ?>
                                        <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=MesFavoris.php"
                                        title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                                        <?php
                                    }?>
                                </div>
                            </div>
                        </div> <!-- fin col-sm-3-->

                        <div class="col-sm-9" >
                            <div>
                                <h5 class="card-title"><strong><?= $ligne['TITRE'] ?><br></strong></h5><br><br>
                                <p class="card-text">
                                    <?php echo $ligne['DESCRIPTION'] ?><br>
                                </p>
                                <p class="card-text">
                                    <small class="text-body-secondary">
                                    <?php echo $ligne['DATE_MISE_EN_LIGNE'] ?>
                                    </small>
                                </p>
                            </div>
                        </div> <!--fin col-sm-9-->

                </div> <!--fin row-->
                <div><br><br></div> <!-- ici-->
            <?php }


        } else {?>
            <p >
                <h3 style="text-align: center; margin-bottom:17%;margin-top:17%"><strong>Vous n'avez aucune annonce en favoris</strong></h3>
            </p>
        <?php
        }?>

    </main>

    <?php require_once("includes/footer.php"); ?>
</body>

<?php require_once("includes/script.php"); ?>
</html>
