<?php
$pageTitle = "Mon Profil";
require_once("includes/head.php");
require("includes/functions.php");
include("includes/connect.php");
// On récupère les informations de l'utilisateur
$utilisateur = $_SESSION["identifiant"];
$requete = 'SELECT * FROM utilisateur WHERE IDENTIFIANT_UTILISATEUR=:unid';
$response = $bdd->prepare($requete);
$response->execute(array('unid' => $utilisateur));
$infosUtilisateur = $response->fetch();

//On récupère les données pour savoir si l'utilisateur à posté des annonces
$requetevendeur = 'SELECT * FROM coquillage WHERE IDENTIFIANT_UTILISATEUR=:idvendeur';
$responsevendeur = $bdd->prepare($requetevendeur);
$responsevendeur->execute(array('idvendeur' => $infosUtilisateur["IDENTIFIANT_UTILISATEUR"]));
$infostest = $responsevendeur->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">

<body>

  <?php require_once("includes/navConnecte.php");?>

  <header> 
    <!-- Page d'un vendeur -->
    <br><br>
    <h1 style="text-align:center">🐌 <span class="titre-vendeur">
        <?= "Bonjour " . $_SESSION["identifiant"] ?>
      </span> 🐌
    </h1>
    <hr><br>
    <div class="cadre" style="display:block; padding-left:5%;padding-right:5%">
      <h2 style="text-align:center">Mes informations personnelles</h2>

      <div class="infoProfil2">
        <div><h3 style="color:#015379" >Informations personnelles</h3></div>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Nom</span>
          </div>
          <div>
            <?php if (!empty($infosUtilisateur["NOM"])) {
                  echo $infosUtilisateur["NOM"];
                } else {
                  echo "Non renseigné";
                } ?>
          </div>
        </div>
        <br>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Prénom</span>
          </div>
          <div>
            <?php if (!empty($infosUtilisateur["PRENOM"])) {
                echo $infosUtilisateur["PRENOM"];
              } else {
                echo "Non renseigné";
              } ?>
          </div>
        </div>
        <br>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Numéro de téléphone</span>
          </div>
          <div>
            <?php if (!empty($infosUtilisateur["NUM_TEL"])) {
                echo "0" . $infosUtilisateur["NUM_TEL"];
              } else {
                echo "Non renseigné";
              } ?>
          </div>
        </div>
        <br>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Email</span>
          </div>
          <div>
            <?php if (!empty($infosUtilisateur["EMAIL"])) {
              echo $infosUtilisateur["EMAIL"];
            } else {
              echo "Non renseigné";
            } ?>
          </div>
        </div>
        <br>
    
        <div><h3 style="color:#015379">Localisation</h3></div>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Plage</span>
          </div>
          <div>
            <?php if (!empty($infosUtilisateur["PLAGE"])) {
                echo $infosUtilisateur["PLAGE"];
              } else {
                echo "Non renseigné";
              } ?>
          </div>
        </div>
        <br>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Latitude</span>
          </div>
          <div>
            <?php if (!empty($infosUtilisateur["LATITUDE"])) {
                echo $infosUtilisateur["LATITUDE"];
              } else {
                echo "Non renseigné";
              } ?>
          </div>
        </div>
        <br>

        <div class="infoProfil">
        <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Longitude</span>
          </div>
          <div>
          <?php if (!empty($infosUtilisateur["LONGITUDE"])) {
                  echo $infosUtilisateur["LONGITUDE"];
                } else {
                  echo "Non renseigné";
                } ?>
          </div>
        </div>
        <br>

        <div><h3 style="color:#015379">Description</h3></div>

        <div class="infoProfil">
        <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Description</span>
          </div>
          <div>
          <?php if (!empty($infosUtilisateur["DESCRIPTION"])) {
                  echo $infosUtilisateur["DESCRIPTION"];
                } else {
                  echo "Non renseigné";
                } ?>
          </div>
        </div>
        <br>
      
        <div class="infoProfil">
        <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Exigence</span>
          </div>
          <div>
          <?php if (!empty($infosUtilisateur["EXIGENCES"])) {
                  echo $infosUtilisateur["EXIGENCES"];
                } else {
                  echo "Non renseigné";
                } ?>
          </div>
        </div>
        <br>

        <div class="infoProfil">
          <div style="margin-right:5%;margin-left:5%">
            <span class="policeSkyBlue">Ancienneté</span>
          </div>
          <div>
          <?php if (!empty($infosUtilisateur["ANCIENNETE"])) {
                  echo $infosUtilisateur["ANCIENNETE"];
                } else {
                  echo "Non renseigné";
                } ?>
          </div>
        </div>
        <br>

    </div>
  </header>

  <main>
      <br><hr><br>
      <?php if (empty($infostest) == false) {
        ?>
        <h5 style="text-align:center;">Suivez les annonces que vous avez postées</h5>
        <?php
        foreach ($infostest as $key => $ligne) { ?>
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
                        <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=MonProfil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                        <?php
                      } else { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=MonProfil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                        <?php
                      }
                      ?>
                  </div>
                </div>
              </div> <!--fin du col-sm-3-->

            <div class="col-sm-9" >
              <div>
              <h5 class="card-title"><strong><?= $ligne['TITRE'] ?><br></strong></h5><br><br>
                <p class="card-text">
                  <?php echo $ligne['DESCRIPTION'] ?><br>
                </p>
                <p class="card-text">
                  <small class="text-body-secondary">
                    <?php echo $ligne['DATE_MISE_EN_LIGNE'] ?>
                  </small></p>
              </div>
            </div>
            
          </div> <!--fin row-->
          <div><br><br></div> <!-- ici-->

        <?php } 
      } ?>
      <div style="display: flex;justify-content: center;">
        <div><a class="boutonFond" style="margin-left:2%; margin-bottom:20px"  href="logout.php">Déconnexion</a></div>
      </div>
  </main>


  <?php require_once("includes/footer.php"); ?>
</body>
<?php require_once("includes/script.php"); ?>
</html>