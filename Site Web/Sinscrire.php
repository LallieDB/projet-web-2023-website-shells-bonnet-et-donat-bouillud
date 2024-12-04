<?php
// session_start();
require_once "includes/functions.php";
include("includes/connect.php");
$verifieIdentifiant = "oui";
$verifieMdP = "oui";
@$mdp = $_POST["MdP"];
@$email = $_POST["email"];
@$confirmemdp = $_POST["confirmeMdP"];
@$identifiant = $_POST["identifiant"];
$messageerreurmdp = "";
$messageerreurid = "";

if (!empty($identifiant) && !empty($email) == true && !empty($mdp) == true && !empty($confirmemdp) == true) {
  ////////////////////////////////////////////////////////
  $requete = "SELECT IDENTIFIANT_UTILISATEUR FROM utilisateur WHERE IDENTIFIANT_UTILISATEUR = :unutilisateur";
  $resultat = $bdd->prepare($requete);
  $resultat->execute(array('unutilisateur' => $identifiant));
  $tab = $resultat->fetch();

  //on verifie si l'identifiant n'est pas déjà utilisé par un autre utilisateur
  if ($tab != null) {
    $verifieIdentifiant = "non";
  }
  //on verifie que le MdP et la confirmation du MdP sont bien identique
  if ($mdp != $confirmemdp) {
    $verifieMdP = "non";
  }
  ///////////////////////////////////////////////////////////////////////////////////////////

  $sql = "INSERT INTO utilisateur(IDENTIFIANT_UTILISATEUR,MDP,EMAIL,ANCIENNETE) VALUES(?,?,?,NOW())";
  $req = $bdd->prepare($sql);
  // On exécute la requête en lui fournissant les variables à utiliser dans l’ordre

  if ($verifieIdentifiant != "non" and $verifieMdP != "non") //si il n'y a pas de problème, on inscrit le nouvel utilisateur dans la base de données
  {
    $req->execute(array($identifiant, $mdp, $email));
    $_SESSION["identifiant"] = $identifiant;
    redirect("PageAccueil.php");
  } else if ($verifieIdentifiant == "non")
    $messageerreurid = "Veuillez choisir un autre identifiant, celui-ci n'est pas disponible";
  else {
    $messageerreurmdp = "Veuillez saisir les mêmes mots de passe. ";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php
$pageTitle = "S'inscrire";
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
            <h1>S'inscrire</h1> <br>

            <form action="" method="POST">
              <label for="identifiant">Identifiant</label> <br>
              <input type="text" name="identifiant" id="identifiant" required />
              <h6 style="color: orangered;">
                <?= $messageerreurid; ?>
              </h6>
              <label for="email">Email</label> <br>
              <input type="email" name="email" id="email" required /> <br><br>
              <label for="MdP">Mot de passe</label><br>
              <input type="password" name="MdP" id="MdP" required /> <br><br>
              <label for="confirmeMdP">Confirmation du mot de passe</label><br>
              <input type="password" name="confirmeMdP" id="confirmeMdP" required /> <br>


              <h6 style="color: orangered;">
                <?= $messageerreurmdp; ?>
              </h6>

              <br>
              <input type="submit" class="boutonFond" name="btn_Sinscrire" id="btn_Sinscrire" value="S'inscrire" />
            </form>
            <br><br>
            <h6 style="color: gray;">Vous avez déjà un compte ? <a href="SeConnecter.php" style="color: orangered;">
                Me
                connecter</a></h6>
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