<?php
include("includes/connect.php");
require("includes/functions.php");

if (empty($_SESSION["identifiant"]) == true) {
  redirect("Seconnecter.php");
}
?>
<!DOCTYPE html>
<html lang="fr">


<?php
$pageTitle = "Déposer une annonce";
require_once("includes/head.php");
require_once("includes/navFormulaireAnnonce.php");?>

<body>
  <main>
    <br><br><br><br><br><br><br>
    <div><a class="boutonOrange" style="margin-left:2%; margin-bottom:20px"  href="PageAccueil.php">Retour à la page d'accueil</a></div>
    <br>
    <?php
    // connexion à la base de données
    ?>
    <div style="margin-left: 2%;">
      <form method="POST" action="traitementAnnonce.php" enctype="multipart/form-data">

        <!-- Description du logement -->
        <ul id="Description">
          <strong>Présentation de votre logement</strong><br><br>
          <li id="DescriptionTexte">Description<br><br>

            <label for="titreAnnonce" class="form-label">Ecrivez le titre de votre annonce</label>
            <input type="text" class="form-control" id="titreAnnonce" name="titre" value="Mettez le titre logement"><br>

            <label for="descriptionCoquillage" class="form-label">Ajoutez une description</label>
            <textarea class="form-control" id="descriptionCoquillage" rows="3" name="description"
              required></textarea><br>
          </li>

          <li id="DescriptionImage">Images<br><br>
            <div class="mb-3">
              <label for="image1" class="form-label">Ajoutez une image de votre bien</label>
              <input class="form-control" type="file" id="Image1" name="image1" required>
            </div>
            <div class="mb-3">
              <label for="image2" class="form-label">Vous pouvez ajouter une seconde image</label>
              <input class="form-control" type="file" id="Image2" name="image2">
            </div>
            <div class="mb-3">
              <label for="image3" class="form-label">Vous pouvez ajouter une dernière image</label>
              <input class="form-control" type="file" id="Image3" name="image3">
            </div>
          </li>
        </ul>

        <!-- Plus de renseignement -->
        <div id="Renseignement" style="margin-left: 0%; margin-right: 90%;"></div>
          <br><hr><br>
          <strong>Renseignement relatif à votre coquillage</strong>
          <br><br><br>
          <label for="prix">Quel est le prix de votre coquillage ? </label> 
          <input type="number" name="prix" id="prix" required /> (en perle de nacre 🦪) <br><br>
          <label for="espaceH">Quel est l'espace habitable de votre coquillage ? </label> <input type="number"
          name="espaceH" id="prix" required /> (en cm2) <br><br>
          <table>
            <tr>
              <td><label for="nbEtage">Saissisez le nombre d'étage </label></td>
              <td></td>
              <td></td>
              <td><label for="nbPiece">Saissisez le nombre de pièces </label></td>
            </tr>
            <tr>
              <td><input type="number" name="nbEtage" id="prix" name="nbEtage" required /> </td>
              <td></td>
              <td></td>
              <td><input type="number" name="nbPiece" id="prix" name="nbPiece" required /></td>
            </tr>
          </table>
          <br>


        <!--Localisation-->
        <label for="Localisation" class="form-label">Renseignez la localisation de votre coquillage</label>
        <input class="form-control" list="datalistOptions" id="Localisation"
          placeholder="Tapez pour voir nos suggestions" name="localisation" required>
        <datalist id="datalistOptions">
          <option value="Amérique du Nord">
          <option value="Amérique du Sud">
          <option value="Asie">
          <option value="Europe">
          <option value="Océanie">
        </datalist>

        <!-- Esthétique-->
        <div id="Esthetique">
          <br>
          <hr><br><strong>Esthétique</strong><br><br>
          <label for="Couleur1" class="form-label">Saississez la couleur principale de votre logement</label>
          <input type="text" class="form-control" id="Couleur1" name="couleur1" required><br>
          <label for="Couleur2" class="form-label">Saississez la couleur secondaire de votre logement</label>
          <input type="text" class="form-control" id="Couleur2" name="couleur2"><br>
          <label for="Couleur3" class="form-label">Vous pouvez saisir une autre couleur pour votre logement</label>
          <input type="text" class="form-control" id="Couleur3" name="couleur3"><br>

          Votre logement a-t'il des rayures ? <br>
          <input type="radio" name="rayure" id="rayure1" value="0" />
          <label for="oui"> Oui </label> <br />
          <input type="radio" name="rayure" id="rayure2" value="1" checked />
          <label for="non">Non </label> <br /><br>

          Votre logement a-t'il des taches ? <br>
          <input type="radio" name="tache" id="tache1" value="0" /><label for="oui">Oui </label>
          <br /><input type="radio" name="tache" id="tache2" value="1" checked />
          <label for="non">Non </label> <br /><br>

          <div style="display: flex;justify-content: center;margin-bottom:50px">
            <button class="boutonOrange" style="margin-right:4px" type="submit">Validez l'annonce</button>
            <input class="boutonBeige" style="margin-left:4px" type="reset" value="Effacer" />
          </div>
        </div>  
      </form>
    </div>
  </main>

  <footer>
    <!-- rien ?-->
  </footer>
</body>
<?php require_once("includes/script.php"); ?>
</html>