<!DOCTYPE html>
<html lang="fr">

<?php
$pageTitle = "Toutes les annonces";
require_once("includes/head.php");
require("includes/functions.php");
include("includes/connect.php");
?>

<body>
  <?php
  if (empty($_SESSION["identifiant"])) {
    require_once("includes/navVisiteur.php");
  } else {
    require_once("includes/navConnecte.php");
  }
  ?>

  <header>
    <br><br>
    <h2 style="text-align: center">Voici toutes nos coquillages mis en vente !</h2>
    <hr>
    <!-- 
      supprimé car les pub sont finalement en bas de la page
      <div class="alert alert-info" role="alert">
      Des supers promos pour votre repas universitaire, ne loupez pas l'info !
      <a href="Images/Publicité/crous pub.gif">ICI</a>
    </div> -->
  </header>

  <main>
    <!-- Le main contient toutes les annonces des produits -->
    <?php
    $requete = "SELECT * FROM coquillage";
    $resultat = $bdd->query($requete);
    $tab = $resultat->fetchAll();
    foreach ($tab as $key => $ligne) { ?>

      <div class="row" style="">
        <div class="row cadre">
          <div class="col-sm-3 ">
            <div>
              <img src="./Images/Annonces/<?php echo $ligne['PHOTO']; ?>" style="width:100%;border-radius:5%;"
                alt="Image de l'annnonce" />
            </div>
            <br>
            <div style="display: flex;justify-content: space-between;">
              <div>
                <a href="PageProduit1.php?annonce=<?php echo $ligne['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                  class="boutonFond">Consulter</a>
              </div>
              <div>
                <?php
                if (empty($_SESSION["identifiant"]) || estEnFavoris($ligne['NUM_ANNONCE']) == "non") { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=LesAnnonces.php"
                    title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                  <?php
                } else { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=LesAnnonces.php"
                    title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                  <?php
                }
                ?>
              </div>
            </div>
          </div> <!--fin col-sm-3-->

          <div class="col-sm-9">
            <div>
              <h5 class="card-title"><strong>
                  <?= $ligne['TITRE'] ?><br>
                </strong></h5><br><br>
              <p class="card-text">
                <?php echo $ligne['DESCRIPTION'] ?><br>
              </p>
              <p class="card-text">
                <small class="text-body-secondary">
                  <?php echo $ligne['DATE_MISE_EN_LIGNE'] ?>
                </small>
              </p>
            </div>
          </div>
        </div> <!--fin row-->
      </div>
      <div><br><br></div>
    <?php }

    // affichage des publicités-->
    require_once("includes/publicites.php"); ?>

  </main>

  <?php require_once("includes/footer.php"); ?>
</body>
<?php require_once("includes/script.php"); ?>

</html>