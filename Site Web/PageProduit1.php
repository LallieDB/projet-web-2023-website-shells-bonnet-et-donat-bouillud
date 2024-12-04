<?php
include("includes/connect.php");
require("includes/functions.php");
$annonce = $_GET["annonce"];
$requete = 'SELECT * FROM coquillage WHERE NUM_ANNONCE=:uneannonce';
$response = $bdd->prepare($requete);
$response->execute(array('uneannonce' => $annonce));
$ligne = $response->fetch();

// On récupère le nombre de photo rentrée par l'utilisateur
if (empty($ligne["PHOTO"]) == false && empty($ligne["PHOTO2"]) == false && empty($ligne["PHOTO3"]) == false) {
  $nombrephoto = 3;
} else if ((empty($ligne["PHOTO"]) == false && empty($ligne["PHOTO2"]) == false) || (empty($ligne["PHOTO"]) == false && empty($ligne["PHOTO3"]) == false)) {
  $nombrephoto = 2;
} else {
  $nombrephoto = 1;
}

// On cherche à obtenir le nom du vendeur
$requetevendeur = 'SELECT * FROM utilisateur WHERE IDENTIFIANT_UTILISATEUR=:idvendeur';
$responsevendeur = $bdd->prepare($requetevendeur);
$responsevendeur->execute(array('idvendeur' => $ligne["IDENTIFIANT_UTILISATEUR"]));
$ligneVendeur = $responsevendeur->fetch();

//On prend les données de toutes les annonces postées par leur ordre de mise en ligne
$requeteArticle = 'SELECT * FROM coquillage HAVING (NUM_ANNONCE!=:uneannonce) ORDER BY DATE_MISE_EN_LIGNE DESC';
$responseArticle = $bdd->prepare($requeteArticle);
$responseArticle->execute(array('uneannonce' => $annonce));
$tab = $responseArticle->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<?php
$pageTitle = $ligne["TITRE"]; 
require_once("includes/head.php") ?>

<body>
  <?php
  if (empty($_SESSION["identifiant"]) == true) {
    require_once("includes/navVisiteur.php");
  } else {
    require_once("includes/navConnecte.php");
  }
  ?>

  <header><br><br>
    <!-- Plus de pub ici
      <div class="alert alert-info" role="alert">
      Un nouveau livre est sorti, n'hésitez pas à le consulter !
      <a href="Images/Publicité/livre claverie pub.gif">ICI</a>
    </div> -->
  </header>

  <main>

    <div class="cadre">
      <!-- Le main contient l'annonce du produit, des infos sur le vendeur et d'autres articles mis en vente -->
      <!-- Annonce du vendeur -->
      <div class="container-fluid ">
        <div class="card mb-<?= $nombrephoto ?>">
        <!-- On fait un carroussel pour les images des annonces -->
          <div id="carouselExample" class="carousel slide" >
            <div class="carroussel-produit" >
              <div class="carousel-item active">
                <img src="./Images/Annonces/<?php echo $ligne['PHOTO']; ?>" class="carrousel image" alt="Vue générale">
              </div>
              <?php if ($nombrephoto > 1) {?>
              <div class="carousel-item">
                <img src="./Images/Annonces/<?php echo $ligne['PHOTO2']; ?>" class="carrousel image" alt="Deuxième angle">
              </div>
              <?php } ?>
              <?php if ($nombrephoto > 2) {?>
              <div class="carousel-item">
                <img src="./Images/Annonces/<?php echo $ligne['PHOTO3']; ?>" class="carrousel image" alt="Troisième angle">
              </div>
              <?php } ?>
            </div>
            <?php if ($nombrephoto > 1) {?>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            <?php } ?>
          </div> <!-- Fin du carroussel -->
          <br>
          <h1 style="text-align:center"><?= $ligne["TITRE"] ?></h1>
          <br>
          <!-- Description du produit -->
          <div>
            <h4 style="text-align:center;">Apprenez en plus sur le coquillage</h4>
            <div style="margin-left: 2%;">
              <p class="card-text">
                <h5 style="policeSkyBlue">Description</h5>
                <?= $ligne["DESCRIPTION"] ?>
              </p>
              <p>
                <span class="policeSkyBlue">Ce coquillage se situe :</span> 
                <?= $ligne["LOCALISATION"] ?><br>
                <span class="policeSkyBlue"> Prix :</span>
                <?= $ligne["PRIX"] ?> perle de nacre 🦪 
              </p>
              <p>
                <span class="policeSkyBlue"> Espace : </span>
                <?= $ligne["ESPACE_HABITABLE"] ?> cm^2 <br>
                <span class="policeSkyBlue"> Nombre de pièce : </span>  <?= $ligne["NB_PIECE"] ?> <br>
                <span class="policeSkyBlue"> Nombre d'étage : </span><?= $ligne["NB_ETAGE"] ?>
              </p>
              <p>
                <span class="policeSkyBlue">Couleurs : </span>
                <ul>
                  <li>
                    <?= $ligne["COULEUR1"] ?>
                  </li>
                  <?php if (empty($ligne["COULEUR2"]) == false) { ?>
                  <li>
                    <?= $ligne["COULEUR2"] ?>
                  </li>
                  <?php } ?>
                  <?php if (empty($ligne["COULEUR3"]) == false) { ?>
                  <li>
                      <?= $ligne["COULEUR3"] ?>
                  </li>
                  <?php } ?>
                </ul>
              </p>
              <p>
                <span class="policeSkyBlue">Taches : </span>
                <?php if ($ligne["TACHE"] == 0) {
                  echo "Oui";
                } else {
                  echo "Non";
                } ?> <br>

                <span class="policeSkyBlue">Rayures : </span>
                <?php if ($ligne["RAYURE"] == 0) {
                echo "Oui";
                } else {
                echo "Non";
                } ?>
              </p>

              <div class="card-text" style="display:flex; justify-content: space-between;">
                <div>
                  <small class="text-body-secondary">Date de mise en ligne : 
                  <?= $ligne["DATE_MISE_EN_LIGNE"] ?>
                  </small>
                </div>
                <div style="margin-right:2%;margin-bottom:2%"><?php
                  if (empty($_SESSION["identifiant"]) || estEnFavoris($ligneVendeur['ID']) == "non") { ?>
                    <a href="AjouterFavoris.php?numannonce=<?php echo $ligneVendeur['ID']; ?>&page=PageProduit1.php?annonce=<?= $annonce ?>"
                    title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                    <?php
                  } else { ?>
                    <a href="AjouterFavoris.php?numannonce=<?php echo $ligneVendeur['ID']; ?>&page=PageProduit1.php?annonce=<?= $annonce ?>"
                    title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                    <?php
                  }?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div> 
    </div>
    <br><br>

    <!-- Description du vendeur -->
    <div class="row">
      <div class="row cadre"  style="margin-bottom:40px">
        <div class="col-sm-3 ">
          <div>
            <img src="./Images/coquillcoin.png" style="width:70%;border-radius:5%;" alt="Image de l'annnonce" />
          </div>
        </div>
        <div class="col-sm-9" >
          <div>
            <br>
            <h4 style="text-align:center">Apprenez en plus sur le vendeur du coquillage</h4><br><br>
            <div style="margin-left: 2%;">

            <h5 class="card-title">
            <?= $ligneVendeur["IDENTIFIANT_UTILISATEUR"] ?>
            </h5><br>
            <p class="card-text">
              <?= $ligneVendeur["DESCRIPTION"] ?>
            </p>
            <p class="card-text"><small class="text-body-secondary">Ancienneté :
              <?= $ligneVendeur["ANCIENNETE"] ?>
              </small>
            </p>
            <div style="margin-top:7%">
              <a href="PageVendeur.php?vendeur=<?php echo $ligneVendeur['ID']; ?>" title="Consulter le vendeur"class="boutonFond">Consulter</a>
            </div>
          </div>
        </div>
      </div> <!--fin row-->
    </div>
            
    <!-- Description des autres articles -->
    <h3 style="text-align:center;margin-bottom:40px">D'autres articles pourraient vous intéresser !</h3><br><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2"></div>

        <div class="card" style="width: 18rem;">
          <img src="./Images/Annonces/<?php echo $tab[0]['PHOTO']; ?>" class="card-img-top" alt="Photo de l'annonce 1">
          <div class="card-body">
            <h4><?= $tab[0]["TITRE"] ?></h4>
            <h5 class="card-title">Prix :
              <?= $tab[0]["PRIX"] ?> perles de nacre 🦪
            </h5> <br>
            <h7 style="color: gray;">
              <?= $tab[0]["LOCALISATION"] ?>
            </h7> <br>
            <h7 style="color: gray;">Date de mise en ligne :
              <?= $tab[0]["DATE_MISE_EN_LIGNE"] ?>
            </h7> <br> <br>

            <div style="display: flex;justify-content: space-between;">
              <div>
                <a href="PageProduit1.php?annonce=<?php echo $tab[0]['NUM_ANNONCE']; ?>" title="Consulter l'annonce" class="boutonFond">Consulter</a>
              </div>
              <div>
                <?php
                if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[0]['NUM_ANNONCE']) == "non") { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[0]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                <?php
                } else { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[0]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                <?php
                }
                ?>
              </div>
            </div>

          </div> <!--fin de display flex pour les bouton-->
        </div> <!-- fin de card body-->

        <div class="card" style="width: 18rem;">
          <img src="./Images/Annonces/<?php echo $tab[1]['PHOTO']; ?>" class="card-img-top" alt="Photo de l'annonce 1">
          <div class="card-body">
            <h4><?= $tab[1]["TITRE"] ?></h4>
            <h5 class="card-title">Prix :
              <?= $tab[1]["PRIX"] ?> perles de nacre 🦪
            </h5> <br>
            <h7 style="color: gray;">
              <?= $tab[1]["LOCALISATION"] ?>
            </h7> <br>
            <h7 style="color: gray;">Date de mise en ligne :
              <?= $tab[1]["DATE_MISE_EN_LIGNE"] ?>
            </h7> <br> <br>

            <div style="display: flex;justify-content: space-between;">
              <div>
                <a href="PageProduit1.php?annonce=<?php echo $tab[1]['NUM_ANNONCE']; ?>" title="Consulter l'annonce" class="boutonFond">Consulter</a>
              </div>
              <div>
                <?php
                if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[1]['NUM_ANNONCE']) == "non") { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[1]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                <?php
                } else { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[1]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond" style="margin-left: 120px;">❤️</a>
                <?php
                }
                ?>
              </div>
            </div>

          </div> <!--fin de display flex pour les bouton-->
        </div> <!-- fin de card body-->


        <div class="card" style="width: 18rem;">
          <img src="./Images/Annonces/<?php echo $tab[2]['PHOTO']; ?>" class="card-img-top" alt="Photo de l'annonce 1">
          <div class="card-body">
            <h4><?= $tab[2]["TITRE"] ?></h4>
            <h5 class="card-title">Prix :
              <?= $tab[2]["PRIX"] ?> perles de nacre 🦪
            </h5> <br>
            <h7 style="color: gray;">
              <?= $tab[2]["LOCALISATION"] ?>
            </h7> <br>
            <h7 style="color: gray;">Date de mise en ligne :
              <?= $tab[2]["DATE_MISE_EN_LIGNE"] ?>
            </h7> <br> <br>

            <div style="display: flex;justify-content: space-between;">
              <div>
                <a href="PageProduit1.php?annonce=<?php echo $tab[2]['NUM_ANNONCE']; ?>" title="Consulter l'annonce" class="boutonFond">Consulter</a>
              </div>
              <div>
                <?php
                if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[2]['NUM_ANNONCE']) == "non") { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[2]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                <?php
                } else { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[2]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                <?php
                }
                ?>
              </div>
            </div>

          </div> <!--fin de display flex pour les bouton-->
        </div> <!-- fin de card body-->


        <div class="card" style="width: 18rem;">
          <img src="./Images/Annonces/<?php echo $tab[3]['PHOTO']; ?>" class="card-img-top" alt="Photo de l'annonce 1">
          <div class="card-body">
            <h4><?= $tab[3]["TITRE"] ?></h4>
            <h5 class="card-title">Prix :
              <?= $tab[3]["PRIX"] ?> perles de nacre 🦪
            </h5> <br>
            <h7 style="color: gray;">
              <?= $tab[3]["LOCALISATION"] ?>
            </h7> <br>
            <h7 style="color: gray;">Date de mise en ligne :
              <?= $tab[3]["DATE_MISE_EN_LIGNE"] ?>
            </h7> <br> <br>

            <div style="display: flex;justify-content: space-between;">
              <div>
                <a href="PageProduit1.php?annonce=<?php echo $tab[3]['NUM_ANNONCE']; ?>" title="Consulter l'annonce" class="boutonFond">Consulter</a>
              </div>
              <div>
                <?php
                if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[3]['NUM_ANNONCE']) == "non") { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[3]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                <?php
                } else { ?>
                  <a href="AjouterFavoris.php?numannonce=<?php echo $tab[3]['NUM_ANNONCE']; ?>&page=PageAccueil.php" title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                <?php
                }
                ?>
              </div>
            </div>

          </div> <!--fin de display flex pour les bouton-->
        </div> <!-- fin de card body-->
      </div>
    </div>
  </main>

  <?php require_once("includes/footer.php"); ?>
</body>
<?php require_once("includes/script.php"); ?>
</html>