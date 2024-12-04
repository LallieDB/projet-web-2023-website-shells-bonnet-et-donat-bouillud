<?php
include("includes/connect.php");
include("includes/functions.php");
$value = $_GET["numannonce"];
$page = $_GET["page"];
if (empty($_SESSION["identifiant"]) == false) {
    //On regarde si l'annonce est déjà en favoris
    $sqlexiste = "SELECT * FROM favoris WHERE NUM_COQUILLAGE = :uncoquillage AND NUM_UTILISATEUR= :unutilisateur";
    $requeteexiste = $bdd->prepare($sqlexiste);
    $requeteexiste->execute(array('uncoquillage' => $value, 'unutilisateur' => $_SESSION["identifiant"]));
    $infoexiste = $requeteexiste->fetchAll();

    if ($infoexiste == null) {

        $sql = "INSERT INTO favoris(NUM_COQUILLAGE,NUM_UTILISATEUR) VALUES(?,?)";
        $req = $bdd->prepare($sql);
        // On exécute la requête en lui fournissant les variables à utiliser dans l’ordre
        $req->execute(
            array($value, $_SESSION["identifiant"])
        );
        echo "Annonce ajoutée aux favoris";
    } else {
        $id = $infoexiste[0]["ID"];
        $sql = " DELETE FROM favoris WHERE ID=:id";
        $req = $bdd->prepare($sql);
        // On exécute la requête en lui fournissant les variables à utiliser dans l’ordre
        $req->execute(
            array('id' => $id)
        );
        echo "Annonce supprimée des favoris";
    }
    redirect($page);
} else {
    redirect("SeConnecter.php");
}
