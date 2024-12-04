<!DOCTYPE html>
<html lang="fr">

<?php
include("includes/connect.php");
$pageTitle = "Page d'accueil";
require_once("includes/head.php");
require("includes/functions.php");


//On regarde les annonces postées en les triant par les plus récentes
$requete = 'SELECT * FROM coquillage ORDER BY DATE_MISE_EN_LIGNE DESC';
$response = $bdd->prepare($requete);
$response->execute();
$tab = $response->fetchAll();

//On regarde si l'utilisateur a fait une recherche par mots clés

@$motcle = $_POST["Recherche"];
@$valider = $_POST["valider"];
@$prixmin = $_POST["prixMin"];
@$prixmax = $_POST["prixMax"];
@$surfacemin = $_POST["surfaceMin"];
@$surfacemax = $_POST["surfaceMax"];
@$nombrepiecemin = $_POST["pieceMin"];
@$nombrepiecemax = $_POST["pieceMax"];
@$nombreetagemin = $_POST["etageMin"];
@$nombreetagemax = $_POST["etageMax"];
@$localisation = $_POST["localisation"];
@$presencetache = $_POST["tache"];
@$presencerayure = $_POST["rayure"];
@$rouge = $_POST["rouge"];
@$orange = $_POST["orange"];
@$jaune = $_POST["jaune"];
@$vert = $_POST["vert"];
@$vert = $_POST["bleu"];
@$violet = $_POST["violet"];
@$creme = $_POST["creme"];
@$marron = $_POST["marron"];
@$noir = $_POST["noir"];
@$blanc = $_POST["blanc"];

$afficher = "non";
$nombreAnnonce = 0;
//Si l'utilisateur a écrit du texte dans la barre de recherche
if (isset($valider) && !empty(trim($motcle))) {
  $mots = explode(" ", trim($motcle));
  $annonce;
  for ($i = 0; $i < count($mots); $i++) {
    $requeteutilisateur[$i] = 'SELECT * FROM coquillage WHERE TITRE LIKE :mot';
    $reponseutilisateur[$i] = $bdd->prepare($requeteutilisateur[$i]);
    $reponseutilisateur[$i]->execute(array('mot' => "%" . "$mots[$i]" . "%"));
    $annonces[$i] = $reponseutilisateur[$i]->fetchAll();
    //On écarte les doublons
    foreach ($annonces[$i] as $key => $result) {
      $conforme = "oui";
      $doublon = "non";
      //On regarde si l'annonce est conforme aux filtres
      if (!empty($prixmax)) //On regarde si le prix est inférieur aux prix max
      {
        if ($result["PRIX"] > $prixmax) {
          $conforme = "non";
        }
      }
      if (!empty($prixmin)) //On regarde si le prix est supérieur au prix min
      {
        if ($result["PRIX"] < $prixmin) {
          $conforme = "non";
        }
      }
      if (!empty($surfacemax)) {
        if ($result["ESPACE_HABITABLE"] > $surfacemax) {
          $conforme = "non";
        }
      }
      if (!empty($surfacemin)) {
        if ($result["ESPACE_HABITABLE"] < $surfacemin) {
          $conforme = "non";
        }
      }
      if (!empty($nombrepiecemax)) //On regarde si le nombre de piece est inférieur aux nb max
      {
        if ($result["NB_PIECE"] > $nombrepiecemax) {
          $conforme = "non";
        }
      }
      if (!empty($nombrepiecemin)) //On regarde si le nombre de piece est supérieur aux nb min
      {
        if ($result["NB_PIECE"] < $nombrepiecemin) {
          $conforme = "non";
        }
      }
      if (!empty($nombreetagemax)) //On regarde si le nombre d'étage est inférieur aux nb max
      {
        if ($result["NB_ETAGE"] > $nombreetagemax) {
          $conforme = "non";
        }
      }
      if (!empty($nombreetagemin)) //On regarde si le nombre d'étage est supérieur aux nb min
      {
        if ($result["NB_ETAGE"] < $nombreetagemin) {
          $conforme = "non";
        }
      }
      if (!empty($localisation)) //On regarde si la localisation correspond 
      {
        if ($result["LOCALISATION"] != $localisation) {
          $conforme = "non";
        }
      }
      if (!empty($presencerayure)) //On regarde si le choix des rayures correspond 
      {
        if ($result["RAYURE"] != $presencerayure) {
          $conforme = "non";
        }
      }
      if (!empty($presencetache)) //On regarde si le choix des tâches correspond
      {
        if ($result["LOCALISATION"] != $presencetache) {
          $conforme = "non";
        }
      }
      if (!empty($rouge) || !empty($orange) || !empty($jaune) || !empty($vert) || !empty($bleu) || !empty($violet) || !empty($blanc) || !empty($creme) || !empty($marron) || !empty($noir)) {
        $couleurconforme = "non";
      } else {
        $couleurconforme = "oui";
      }

      if (!empty($rouge)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $rouge || $result["COULEUR2"] == $rouge || $result["COULEUR3"] == $rouge) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($orange)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $orange || $result["COULEUR2"] == $orange || $result["COULEUR3"] == $orange) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($jaune)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $jaune || $result["COULEUR2"] == $jaune || $result["COULEUR3"] == $jaune) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($vert)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $vert || $result["COULEUR2"] == $vert || $result["COULEUR3"] == $vert) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($bleu)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $bleu || $result["COULEUR2"] == $bleu || $result["COULEUR3"] == $bleu) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($violet)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $violet || $result["COULEUR2"] == $violet || $result["COULEUR3"] == $violet) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($creme)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $creme || $result["COULEUR2"] == $creme || $result["COULEUR3"] == $creme) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($blanc)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $blanc || $result["COULEUR2"] == $blanc || $result["COULEUR3"] == $blanc) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($marron)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $marron || $result["COULEUR2"] == $marron || $result["COULEUR3"] == $marron) {
          $couleurconforme = "oui";
        }
      }
      if (!empty($noir)) //On regarde si le choix des tâches correspond
      {
        if ($result["COULEUR1"] == $noir || $result["COULEUR2"] == $noir || $result["COULEUR3"] == $noir) {
          $couleurconforme = "oui";
        }
      }

      //on regarde les doublons
      for ($i = 0; $i < count($annonces) - 1; $i++) {
        for ($j = 0; $j < count($annonces[$i]); $j++) { //On regarde les doublons
          if ($result["NUM_ANNONCE"] == $annonces[$i][$j]["NUM_ANNONCE"]) {
            $doublon = "oui";
          }
        }
      }
      if ($doublon == "non" && $conforme == "oui" && $couleurconforme == "oui") {
        $annonce[$nombreAnnonce] = $result;
        $nombreAnnonce = $nombreAnnonce + 1;
      }
    }
  }
  $afficher = "oui";
}

//Si l'utilisateur utilise des filtres sans mettre du texte dans la barre de recherche
else if (isset($valider) && empty(trim($motcle))) {
  $nombreAnnonce = 0;
  foreach ($tab as $key => $result) {
    $conforme = "oui";
    //On regarde si l'annonce est conforme aux filtres
    if (!empty($prixmax)) //On regarde si le prix est inférieur aux prix max
    {
      if ($result["PRIX"] > $prixmax) {
        $conforme = "non";
      }
    }
    if (!empty($prixmin)) //On regarde si le prix est supérieur au prix min
    {
      if ($result["PRIX"] < $prixmin) {
        $conforme = "non";
      }
    }
    if (!empty($surfacemax)) {
      if ($result["ESPACE_HABITABLE"] > $surfacemax) {
        $conforme = "non";
      }
    }
    if (!empty($surfacemin)) {
      if ($result["ESPACE_HABITABLE"] < $surfacemin) {
        $conforme = "non";
      }
    }
    if (!empty($nombrepiecemax)) //On regarde si le nombre de piece est inférieur aux nb max
    {
      if ($result["NB_PIECE"] > $nombrepiecemax) {
        $conforme = "non";
      }
    }
    if (!empty($nombrepiecemin)) //On regarde si le nombre de piece est supérieur aux nb min
    {
      if ($result["NB_PIECE"] < $nombrepiecemin) {
        $conforme = "non";
      }
    }
    if (!empty($nombreetagemax)) //On regarde si le nombre d'étage est inférieur aux nb max
    {
      if ($result["NB_ETAGE"] > $nombreetagemax) {
        $conforme = "non";
      }
    }
    if (!empty($nombreetagemin)) //On regarde si le nombre d'étage est supérieur aux nb min
    {
      if ($result["NB_ETAGE"] < $nombreetagemin) {
        $conforme = "non";
      }
    }
    if (!empty($localisation)) //On regarde si la localisation correspond 
    {
      if ($result["LOCALISATION"] != $localisation) {
        $conforme = "non";
      }
    }
    if (!empty($presencerayure)) //On regarde si le choix des rayures correspond 
    {
      if ($result["RAYURE"] != $presencerayure) {
        $conforme = "non";
      }
    }
    if (!empty($presencetache)) //On regarde si le choix des tâches correspond
    {
      if ($result["LOCALISATION"] != $presencetache) {
        $conforme = "non";
      }
    }
    //On regarde si un filtre de couleur a été utilisé
    if (!empty($rouge) || !empty($orange) || !empty($blanc) || !empty($jaune) || !empty($vert) || !empty($bleu) || !empty($violet) || !empty($creme) || !empty($marron) || !empty($noir)) {
      $couleurconforme = "non";
    } else {
      $couleurconforme = "oui";
    }

    if (!empty($rouge)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $rouge || $result["COULEUR2"] == $rouge || $result["COULEUR3"] == $rouge) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($orange)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $orange || $result["COULEUR2"] == $orange || $result["COULEUR3"] == $orange) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($jaune)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $jaune || $result["COULEUR2"] == $jaune || $result["COULEUR3"] == $jaune) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($vert)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $vert || $result["COULEUR2"] == $vert || $result["COULEUR3"] == $vert) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($bleu)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $bleu || $result["COULEUR2"] == $bleu || $result["COULEUR3"] == $bleu) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($violet)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $violet || $result["COULEUR2"] == $violet || $result["COULEUR3"] == $violet) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($blanc)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $blanc || $result["COULEUR2"] == $blanc || $result["COULEUR3"] == $blanc) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($creme)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $creme || $result["COULEUR2"] == $creme || $result["COULEUR3"] == $creme) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($marron)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $marron || $result["COULEUR2"] == $marron || $result["COULEUR3"] == $marron) {
        $couleurconforme = "oui";
      }
    }
    if (!empty($noir)) //On regarde si le choix des tâches correspond
    {
      if ($result["COULEUR1"] == $noir || $result["COULEUR2"] == $noir || $result["COULEUR3"] == $noir) {
        $couleurconforme = "oui";
      }
    }
    if ($conforme == "oui" && $couleurconforme == "oui") {
      $annonce[$nombreAnnonce] = $result;
      $nombreAnnonce = $nombreAnnonce + 1;
    }
  }
  $afficher = "oui";
}
?>

<body>
  <!-- la barre nav est différente en fonction de l'état de la session (si connecté ou non)-->
  <?php
  if (empty($_SESSION["identifiant"]) == true) {
    require_once("includes/navVisiteur.php");
  } else {
    require_once("includes/navConnecte.php");
  }
  ?>

  <header>
    <br>
    <?php if ($afficher != "oui") { ?>
      <br><br>
      <h1 style="text-align: center;">Les habitants de la plage</h1> <!-- h1 si $afficher != "oui" -->
      <div class="container-fluid" style="text-align: center">
        <img src="Images/lecoquillcoin.fr.jpg" style="width: 70%" alt="logo du site lecoquillcoin.fr">
      </div>
      <?php
    } ?>

    <form name="barreRecherche" method="post" action="">
      <section>
        <!-- Section pour choisir les caractéristiques de sa recherche -->
        <div class="container-fluid container_acceuil">

          <div> <!-- recherche-->
            <h2 style="text-align: center; ">Recherche de Logement </h2> <br>

            <input class="caseRecherche" type="search" style="width:70%;height:35px;" id="site-search" name="Recherche">
            <input class="boutonFond" type="submit" name="valider" value="Rechercher" />
          </div>
          <br>

          <div class="row">
            <div class="col-sm-6">
              <!-- Pour la destination -->
              <h4> Où ?</h4>
              <span class="nav-link" style="text-align: center; width: 30%;" role="button" data-bs-toggle="dropdown"
                aria-expanded="true">
                <input class="form-control" list="datalistOptions" id="Localisation"
                  placeholder="Choisir une destination" name="localisation">
                <datalist id=" datalistOptions">
                  <option value="Amérique du Nord">
                  <option value="Amérique du Sud">
                  <option value="Asie">
                  <option value="Europe">
                  <option value="Océanie">
                </datalist>
              </span>
              <!-- <ul class="dropdown-menu">
                <li>
                  <h4>Où ?</h4>
                </li> -->
              <!-- <span class="couleurSelection"> -->
              <!-- <li><a class="dropdown-item" href="#" value="Afrique">Afrique</a></li>
                  <li><a class="dropdown-item" href="#" value="Amérique du Nord">Amérique du Nord</a></li>
                  <li><a class="dropdown-item" href="#" value="Amérique du Sud">Amérique du Sud</a></li>
                  <li><a class="dropdown-item" href="#" value="Asie">Asie</a></li>
                  <li><a class="dropdown-item" href="#" value="Europe">Europe</a></li>
                  <li><a class="dropdown-item" href="#" value="Océanie">Océanie</a></li> -->
              </span>
              </ul>
            </div>
            <div class="col-sm-6">
              <!-- Pour le prix -->
              <h4>Prix</h4>
              <span class="nav-link dropdown-toggle" style="text-align: center;" role="button" data-bs-toggle="dropdown"
                aria-expanded="true">
                Choisir </span>
              <ul class="dropdown-menu">
                <table style="text-align: center;">
                  <tr>
                    <h4>Prix</h4>
                  </tr>
                  <tr>
                    <td>Minimum</td>
                    <td>Maximum</td>
                  </tr>
                  <tr>
                    <td>
                      <p>
                        <label for="prixMin"></label>
                        <input type="number" name="prixMin" id="prixMin" />
                      </p>
                    </td>
                    <td>
                      <p>
                        <label for="prixMax"></label>
                        <input type="number" name="prixMax" id="prixMax" />
                      </p>
                    </td>
                  </tr>
                </table>
              </ul>
            </div>

          </div> <!--fin du row-->

          <!-- Choix de filtres supplémentaires -->
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne">
                  Plus de filtres
                </button>
              </h2>

              <!-- Choix supplémentaires -->
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <!-- Première ligne -->
                  <div class="row">

                    <!-- Choix surface habitable -->
                    <div class="col-md-4">
                      <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        Surface habitable
                      </span>
                      <ul class="dropdown-menu">
                        <table style="text-align: center;">
                          <tr>
                            <h4>Surface habitable</h4>
                          </tr>
                          <tr>
                            <td>Minimum</td>
                            <td>Maximum</td>
                          </tr>
                          <tr>
                            <td>
                              <p>
                                <label for="surfaceMin"></label>
                                <input type="number" name="surfaceMin" id="surfaceMin" />
                              </p>
                            </td>
                            <td>
                              <p>
                                <label for="surfaceMax"></label>
                                <input type="number" name="surfaceMax" id="surfaceMax" />
                              </p>
                            </td>
                          </tr>
                        </table>
                      </ul>
                    </div>

                    <!-- Choix Nb de pièce -->
                    <div class="col-md-4">
                      <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        Nombre de pièce
                      </span>
                      <ul class="dropdown-menu">
                        <table style="text-align: center;">
                          <tr>
                            <h4>Nombre de pièce</h4>
                          </tr>
                          <tr>
                            <td>Minimum</td>
                            <td>Maximum</td>
                          </tr>
                          <tr>
                            <td>
                              <p>
                                <label for="pieceMin"></label>
                                <input type="number" name="pieceMin" id="pieceMin" />
                              </p>
                            </td>
                            <td>
                              <p>
                                <label for="pieceMax"></label>
                                <input type="number" name="pieceMax" id="pieceMax" />
                              </p>
                            </td>
                          </tr>
                        </table>
                      </ul>
                    </div>

                    <!-- Choix Nb d'étage -->
                    <div class="col-md-4">
                      <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        Nombre d'étages
                      </span>
                      <ul class="dropdown-menu">
                        <table style="text-align: center">
                          <tr>
                            <h4>Nombre d'étages</h4>
                          </tr>
                          <tr>
                            <td>Minimum</td>
                            <td>Maximum</td>
                          </tr>
                          <tr>
                            <td>
                              <p>
                                <label for="etageMin"></label>
                                <input type="number" name="etageMin" id="etageMin" />
                              </p>
                            </td>
                            <td>
                              <p>
                                <label for="etageMax"></label>
                                <input type="number" name="etageMax" id="etageMax" />
                              </p>
                            </td>
                          </tr>
                        </table>
                      </ul>
                    </div>
                  </div>
                  <br>
                  <div class="row">

                    <!-- Choix des couleurs -->
                    <div class="col-md-4">
                      <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        Couleurs
                      </span>
                      <ul class="dropdown-menu">
                        <li>
                          <h4>Couleurs</h4>
                        </li>
                        <span class="couleurSelection">
                          <li>
                            <input type="checkbox" name="rouge" id="rouge" value="Rouge" />
                            <label for="rouge">Rouge</label> <span
                              class="container rondCouleurs rondRouge"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="orange" id="orange" value="Orange" />
                            <label for="orange">Orange</label> <span
                              class="container rondCouleurs rondOrange"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="jaune" id="jaune" value="Jaune" />
                            <label for="orange">Jaune</label> <span
                              class="container rondCouleurs rondJaune"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="vert" id="vert" value="Vert" />
                            <label for="vert">Vert</label> <span class="container rondCouleurs rondVert"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="bleu" id="bleu" value="Bleu" />
                            <label for="bleu">Bleu</label> <span class="container rondCouleurs rondBleu"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="violet" id="violet" value="Violet" />
                            <label for="violet">Violet</label> <span
                              class="container rondCouleurs rondViolet"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="blanc" id="blanc" value="Blanc" />
                            <label for="blanc">Blanc</label> <span
                              class="container rondCouleurs rondBlanc"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="creme" id="creme" value="Crème" />
                            <label for="creme">Crème</label> <span
                              class="container rondCouleurs rondCreme"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="marron" id="marron" value="Marron" />
                            <label for="marron">Marron</label> <span
                              class="container rondCouleurs rondMarron"></span><br />
                          </li>
                          <li>
                            <input type="checkbox" name="noir" id="noir" value="Noir" />
                            <label for="noir">Noir</label> <span class="container rondCouleurs rondNoir"></span><br />
                          </li>
                        </span>
                      </ul>
                    </div>

                    <!-- Choix présence de taches -->
                    <div class="col-md-4">
                      <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        Présence de taches
                      </span>
                      <ul class="dropdown-menu">
                        <li>
                          <h4>Présence de taches</h4>
                        </li>
                        <span class="couleurSelection">
                          <li>
                            <input type="radio" name="tache" id="tacheOui" value="0" />
                            <label for="tacheOui">Oui </label> <br />
                          </li>
                          <li>
                            <input type="radio" name="tache" id="tacheNon" value="1" />
                            <label for="tacheNon">Non</label> <br />
                          </li>
                        </span>
                      </ul>
                    </div>

                    <!-- Choix présence de rayures -->
                    <div class="col-md-4">
                      <span class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        Présence de rayures
                      </span>
                      <ul class="dropdown-menu">
                        <li>
                          <h4>Présence de rayures</h4>
                        </li>
                        <span class="couleurSelection">
                          <li>
                            <input type="radio" name="rayure" id="rayureOui" value="0" />
                            <label for="rayureOui">Oui </label> <br />
                          </li>
                          <li>
                            <input type="radio" name="rayure" id="rayureNon" value="1" />
                            <label for="rayureNon">Non</label> <br />
                          </li>
                        </span>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="text-align:center; font-size: x-large;height:50px;display: flex;justify-content: space-around;">
            <a class="boutonFond" href="LesAnnonces.php">Consulter toutes les annonces</a>
          </div>
        </div>
      </section>
    </form>

  </header>

  <main>


    <?php if ($afficher == "oui") { ?>
      <!-- si $afficher =oui, alors on affiche le résultat de la recherche de l'utilisateur-->
      <h1 style="text-align:center">Votre recherche</h1> <!--h1 si $afficher=="oui"-->
      <h2 style="text-align:center">Il y a
        <?= $nombreAnnonce ?>
        <?php if ($nombreAnnonce > 1) {
          echo "résultats";
        } else {
          echo "résultat";
        } ?> qui correspondent à votre recherche
      </h2>
      <hr>
      <?php if ($nombreAnnonce > 0) {
        for ($i = 0; $i < count($annonce); $i++) { ?>
          <div class="row" style="">
            <div class="row cadre">
              <div class="col-sm-3 ">
                <div>
                  <img src="./Images/Annonces/<?php echo $annonce[$i]['PHOTO']; ?>" style="width:100%;border-radius:5%;"
                    alt="Image de l'annnonce" />
                </div>
                <br>
                <div style="display: flex;justify-content: space-between;">
                  <div>
                    <a href="PageProduit1.php?annonce=<?php echo $annonce[$i]['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                      class="boutonFond">Consulter</a>
                  </div>
                  <div>
                    <?php
                    if (empty($_SESSION["identifiant"]) || estEnFavoris($annonce[$i]['NUM_ANNONCE']) == "non") { ?>
                      <a href="AjouterFavoris.php?numannonce=<?php echo $annonce[$i]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                        title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                      <?php
                    } else { ?>
                      <a href="AjouterFavoris.php?numannonce=<?php echo $annonce[$i]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
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
                      <?= $annonce[$i]['TITRE'] ?><br>
                    </strong></h5><br><br>
                  <p class="card-text">
                    <?php echo $annonce[$i]['DESCRIPTION'] ?><br>
                  </p>
                  <p class="card-text">
                    <small class="text-body-secondary">
                      <?php echo $annonce[$i]['DATE_MISE_EN_LIGNE'] ?>
                    </small>
                  </p>
                </div>
              </div>
            </div> <!--fin row-->
            <div><br><br></div>


          <?php } //affichage des publicités
        require_once("includes/publicites.php");
      }
    } else { ?> <!-- sinon, on propose à l'utilisateur les annonces mises en lignes récemment-->
        <section>
          <h2 style="text-align: center; margin-bottom: 20px;">Mis en ligne récement</h2>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="card" style="width: 18rem;">
                <img src="./Images/Annonces/<?php echo $tab[0]['PHOTO']; ?>" class="card-img-top"
                  alt="Photo de l'annonce 1">
                <div class="card-body">
                  <h4>
                    <?= $tab[0]["TITRE"] ?>
                  </h4>
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
                      <a href="PageProduit1.php?annonce=<?php echo $tab[0]['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                        class="boutonFond">Consulter</a>
                    </div>
                    <div>
                      <?php
                      if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[0]['NUM_ANNONCE']) == "non") { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[0]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                        <?php
                      } else { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[0]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="./Images/Annonces/<?php echo $tab[1]['PHOTO']; ?>" class="card-img-top"
                  alt="Photo de l'annonce 2">
                <div class="card-body">
                  <h4>
                    <?= $tab[1]["TITRE"] ?><br>
                  </h4>
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
                      <a href="PageProduit1.php?annonce=<?php echo $tab[1]['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                        class="boutonFond">Consulter</a>
                    </div>
                    <div>
                      <?php
                      if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[1]['NUM_ANNONCE']) == "non") { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[1]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                        <?php
                      } else { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[1]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="./Images/Annonces/<?php echo $tab[2]['PHOTO']; ?>" class="card-img-top"
                  alt="Photo de l'annonce 3">
                <div class="card-body">
                  <h4>
                    <?= $tab[2]["TITRE"] ?>
                  </h4>
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
                      <a href="PageProduit1.php?annonce=<?php echo $tab[2]['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                        class="boutonFond">Consulter</a>
                    </div>
                    <div>
                      <?php
                      if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[2]['NUM_ANNONCE']) == "non") { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[2]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                        <?php
                      } else { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[2]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="./Images/Annonces/<?php echo $tab[3]['PHOTO']; ?>" class="card-img-top"
                  alt="Photo de l'annonce 4">
                <div class="card-body">
                  <h4>
                    <?= $tab[3]["TITRE"] ?>
                  </h4>
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
                      <a href="PageProduit1.php?annonce=<?php echo $tab[3]['NUM_ANNONCE']; ?>" title="Consulter l'annonce"
                        class="boutonFond">Consulter</a>
                    </div>
                    <div>
                      <?php
                      if (empty($_SESSION["identifiant"]) || estEnFavoris($tab[3]['NUM_ANNONCE']) == "non") { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[3]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">🤍</a>
                        <?php
                      } else { ?>
                        <a href="AjouterFavoris.php?numannonce=<?php echo $tab[3]['NUM_ANNONCE']; ?>&page=PageAccueil.php"
                          title="Consulter l'annonce" class="boutonRond " style="margin-left: 120px;">❤️</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div> <!-- fin du div card-->


      </div>
      <div class="col-lg-2"></div>
      </div>
      </div>
      </section>
      <?php
    } ?>
    <br>



  </main>

  <?php require_once("includes/footer.php"); ?>
</body>
<?php require_once("includes/script.php"); ?>

</html>
