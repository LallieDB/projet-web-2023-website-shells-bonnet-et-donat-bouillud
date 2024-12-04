<?php
require_once "includes/functions.php";
// session_start();
include("includes/connect.php");
$verifie = true;

if (!empty($_POST["identifiant"]) and !empty($_POST["MdP"])) {
  $identifiant = $_POST["identifiant"];
  $MdP = $_POST["MdP"];
  $stmt = $bdd->prepare('SELECT * FROM utilisateur where IDENTIFIANT_UTILISATEUR=? and MDP=?');
  $stmt->execute(array($identifiant, $MdP));
  if ($stmt->rowCount() == 1) {
    // Authentication successful
    $_SESSION["identifiant"] = $identifiant;
    redirect("PageAccueil.php");
  } else {
    $verifie = false;
    $error = "L'identifiant ou le mot de passe n'est pas valide";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php
$pageTitle = "Se connecter";
require_once("includes/head.php") ?>

<body style="background-color: skyblue;"> <!--mettre une image-->
  <?php require_once("includes/navConnection.php") ?>
  <header>
    <!--rien ?-->
  </header>

  <main>
    <section class="container-fluid">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 connection">
          <a href="./PageAccueil.php" style="color: gray; font-size: 40px; "> ×</a><!--text-align: right;-->
          <center>
            <h1>Se connecter</h1> <br>
            <form action="SeConnecter.php" method="post">
              <label for="identifiant">Identifiant</label> <br>
              <input type="text" name="identifiant" id="identifiant" /> <br><br>
              <label for="MdP">Mot de passe</label><br>
              <input type="password" name="MdP" id="MdP" /> <br><br>
              <?php
              if ($verifie == false) { ?>
                <h6 style="color: orangered;">
                  <?= $error ?>
                </h6>
                <?php
              }
              ?>
              <br>
              <input type="submit" class="boutonFond" name="btn_Seconnecter" id="btn_Seconnecter"
                value="Se connecter" />
            </form>
            <br><br>
            <h6 style="color: gray;">Vous n'avez pas de compte ? <a href="./Sinscrire.php" style="color: orangered;">
                Créer un compte maintenant</a></h6>
          </center>
        </div>
        <div class="col-3"></div>
      </div>
    </section>
  </main>

  <footer>
    <!-- rien ?-->
  </footer>
</body>
<?php require_once("includes/script.php"); ?>
</html>