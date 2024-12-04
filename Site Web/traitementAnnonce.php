<?php
include("includes/functions.php");
include("includes/connect.php");
//On sélectionne les autres articles du vendeur
$requetevendeur = 'SELECT * FROM coquillage WHERE IDENTIFIANT_UTILISATEUR=:idvendeur';
$responsevendeur = $bdd->prepare($requetevendeur);
$responsevendeur->execute(array('idvendeur' => $_SESSION["identifiant"]));
$infostest = $responsevendeur->fetchAll();


//On regarde si les images passent bien le format

$tmpName = $_FILES["image1"]['tmp_name'];
$name = $_FILES["image1"]['name'];
$size = $_FILES["image1"]['size'];
$error = $_FILES["image1"]['error'];


$tabExtension = explode('.', $name);
$extension = strtolower(end($tabExtension));
//Tableau des extensions que l'on accepte
$extensions = ['jpg', 'png', 'jpeg', 'gif'];
$maxSize = 400000;
if (in_array($extension, $extensions)) {
  move_uploaded_file($tmpName, './Images/Annonces/' . $name);
  $imageProbleme = "";
} else {
  $imageProbleme = "L'image 1 n'est pas passée, elle a une mauvaise extension ou la taille maximale a été dépassée.";
}

if (isset($_FILES["image2"]) == true) {
  $tmpName2 = $_FILES["image2"]['tmp_name'];
  $name2 = $_FILES["image2"]['name'];
  $size2 = $_FILES["image2"]['size'];
  $error2 = $_FILES["image2"]['error'];


  $tabExtension = explode('.', $name);
  $extension = strtolower(end($tabExtension));
  //Tableau des extensions que l'on accepte
  $extensions = ['jpg', 'png', 'jpeg', 'gif'];
  $maxSize = 400000;
  if (in_array($extension, $extensions)) {
    move_uploaded_file($tmpName, './Images/Annonces/' . $name);
    $imageProbleme = "";
  } else {
    $imageProbleme = "L'image 2 n'est pas passée, elle a une mauvaise extension ou la taille maximale a été dépassée.";
  }
}
if (isset($_FILES["image3"]) == true) {
  $tmpName3 = $_FILES["image3"]['tmp_name'];
  $name3 = $_FILES["image3"]['name'];
  $size3 = $_FILES["image3"]['size'];
  $error3 = $_FILES["image3"]['error'];

  if (isset($_FILES["image3"])) {
    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    //Tableau des extensions que l'on accepte
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $maxSize = 400000;
    if (in_array($extension, $extensions)) {
      move_uploaded_file($tmpName, './Images/Annonces/' . $name);
      $imageProbleme = "";
    } else {
      $imageProbleme = "L'image 3 n'est pas passée, elle a une mauvaise extension ou la taille maximale a été dépassée.";
    }
  }
}


if (empty($_POST["titre"]) == false && empty($_POST["description"]) == false && empty($_POST["prix"]) == false && empty($_POST["espaceH"]) == false && empty($_POST["nbEtage"]) == false) {
  $sql = "INSERT INTO coquillage(TITRE,DESCRIPTION, PHOTO,PHOTO2,PHOTO3,PRIX,ESPACE_HABITABLE,NB_ETAGE,NB_PIECE,COULEUR1,COULEUR2,COULEUR3,LOCALISATION,TACHE,RAYURE,DATE_MISE_EN_LIGNE, IDENTIFIANT_UTILISATEUR) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
  $req = $bdd->prepare($sql);
  // On exécute la requête en lui fournissant les variables à utiliser dans l’ordre
  $req->execute(
    array(
      $_POST["titre"], $_POST["description"], $_FILES["image1"]['name'], $_FILES["image2"]['name'],
      $_FILES["image3"]['name'], $_POST["prix"], $_POST["espaceH"], $_POST["nbEtage"], $_POST["nbPiece"], $_POST["couleur1"], $_POST["couleur2"],
      $_POST["couleur3"], $_POST["localisation"], $_POST["rayure"], $_POST["tache"], $_SESSION["identifiant"]
    )
  );
  $demande = "Votre annonce a bien été prise en compte";
} else {
  $demande = "Votre annonce a échouée, veuillez réessayez";
}
?>
<!DOCTYPE html>
<html lang="fr">
<?php
$pageTitle = "Validation de votre annonce";
require_once("includes/head.php")
  ?>

<body>
  <?php
  if (empty($_SESSION["identifiant"]) == true) {
    require_once("includes/navVisiteur.php");
  } else {
    require_once("includes/navConnecte.php");
  }
  ?>
  <main><br><br>
    <p class="centrer-texte" style="color: blue;"><strong>
        <h2>
          <?= $demande ?>
        </h2>
      </strong></p>
    <p class="centrer-texte" style=" color: red ; ">
      <?= $imageProbleme ?>
    </p><br>

    <?php if (empty($infostest) == false) {
      ?>
      <h5>Suivez les annonces que vous avez posté</h2>
        <?php
        foreach ($infostest as $key => $ligne) { ?>

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
                      <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                        title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                      <?php
                    } else { ?>
                      <a href="AjouterFavoris.php?numannonce=<?php echo $ligne['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                        title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>

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
            <div><br><br></div> <!-- ici-->

          <?php } ?>

        <?php } ?>
  </main>


  <?php require_once("includes/footer.php"); ?>
</body>
<?php require_once("includes/script.php"); ?>

</html>