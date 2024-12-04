<?php
include("includes/connect.php");
require("includes/functions.php");
$vendeur = $_GET["vendeur"];
$requete = 'SELECT * FROM utilisateur WHERE ID=:unid';
$response = $bdd->prepare($requete);
$response->execute(array('unid' => $vendeur));
$infosVendeur = $response->fetch();

$requete = 'SELECT * FROM coquillage WHERE IDENTIFIANT_UTILISATEUR=:unutilisateur';
$response = $bdd->prepare($requete);
$response->execute(array('unutilisateur' => $infosVendeur["IDENTIFIANT_UTILISATEUR"]));
$tab = $response->fetchAll();
if (empty($tab) == true) {
  $nombreAnnonce = 0;
} else {
  $nombreAnnonce = count($tab);
}

?>


<!DOCTYPE html>
<html lang="fr">

<?php
$pageTitle = "Page de ". $infosVendeur["IDENTIFIANT_UTILISATEUR"] ; 
require_once("includes/head.php") ?>

<body>
  <?php
  if (empty($_SESSION["identifiant"]) == true) {
    require_once("includes/navVisiteur.php");
  } else {
    require_once("includes/navConnecte.php");
  }
  ?>


  <main>
    <!-- Page d'un vendeur -->
    <h2 style="text-align:center"><br><br>🐚 <span class="titre-vendeur">Bienvenue sur la page de
        <?= $infosVendeur["IDENTIFIANT_UTILISATEUR"] ?>
      </span> 🐚</h2>
    <hr><br>
    <div style="margin-left: 2%;">
      <h3>Informations personnelles</h3>
      <ol>
        <table>
          <tr>
            <td><strong>Nom</strong></td>
            <td>
              <?= $infosVendeur["NOM"] ?>
            </td>
          </tr>
          <tr>
            <td><strong>Prénom</strong></td>
            <td>
              <?= $infosVendeur["PRENOM"] ?>
            </td>
          </tr>
          <tr>
            <td><strong>Numéro de téléphone</strong></td>
            <td>
              <?php if (!empty($infosVendeur["NUM_TEL"])) {
                echo "0" . $infosVendeur["NUM_TEL"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
          <td><strong>EMAIL</strong></td>
          <td>
            <?php if (!empty($infosVendeur["EMAIL"])) {
              echo $infosVendeur["EMAIL"];
            } else {
              echo "Non renseigné";
            } ?>
          </td>
          </tr>
          </tr>
        </table>
      </ol>
      <h3>Localisation</h3>
      <ol>
        <table>
          <tr>
            <td><strong>Plage</strong></td>
            <td>
              <?php if (!empty($infosVendeur["PLAGE"])) {
                echo $infosVendeur["PLAGE"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
          <tr>
            <td><strong>Latitude</strong></td>
            <td>
              <?php if (!empty($infosVendeur["LATITUDE"])) {
                echo $infosVendeur["LATITUDE"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
          <tr>
            <td><strong>Longitude</strong></td>
            <td>
              <?php if (!empty($infosVendeur["LONGITUDE"])) {
                echo $infosVendeur["LONGITUDE"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
        </table>
      </ol>
      <h3>Description</h3>
      <ol>
        <table>
          <tr>
            <td><strong>Description</strong></td>
            <td>
              <?php if (!empty($infosVendeur["DESCRIPTION"])) {
                echo $infosVendeur["DESCRIPTION"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
          <tr>
            <td><strong>Exigence</strong></td>
            <td>
              <?php if (!empty($infosVendeur["EXIGENCES"])) {
                echo $infosVendeur["EXIGENCES"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
          <tr>
            <td><strong>Ancienneté</strong></td>
            <td>
              <?php if (!empty($infosVendeur["ANCIENNETE"])) {
                echo $infosVendeur["ANCIENNETE"];
              } else {
                echo "Non renseigné";
              } ?>
            </td>
          </tr>
        </table>
      </ol>
      <hr><br>
      <h5 style="text-align:center">Voilà les annonces qui vous sont proposées par ce vendeur</h2>

        <?php foreach ($tab as $key => $ligne) { ?>

          <div class="card mb-3">
            <img src="./Images/Annonces/<?php echo $ligne['PHOTO']; ?>" width="40%" height="5%"
              class="class=img-fluid rounded-start" alt="Image de l'annnonce" />
            <div class="card-body">
              <h5 class="card-title"><strong>
                  <?php $ligne['TITRE'] ?><br>
                </strong></h5>
              <p class="card-text">
                <?php echo $ligne['DESCRIPTION'] ?><br>
              </p>
              <p class="card-text"><small class="text-body-secondary">
                  <?php echo $ligne['DATE_MISE_EN_LIGNE'] ?>
                </small></p>
              <a href="PageProduit1.php?annonce=<?php echo $ligne['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                class="boutonFond">Consulter</a>
              <?php
              if (empty($_SESSION["identifiant"]) || estEnFavoris(empty($_SESSION["identifiant"]) || $ligne['NUM_ANNONCE']) == "non") { ?>
                <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=PageVendeur.php?vendeur=<?= $vendeur ?>"
                  title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                <?php
              } else { ?>
                <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=PageVendeur.php?vendeur=<?= $vendeur ?>"
                  title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                <?php
              }
              ?>
            </div>
          </div>
        <?php } ?>
  </main>

  <?php require_once("includes/footer.php"); ?>
</body>
<?php require_once("includes/script.php"); ?>
</html>