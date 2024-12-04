<?php
session_start();


// Connect to the database. Returns a PDO object
// function getDb() {
//     // Local deployment
//     /* $server = "localhost";
//     $username = "mymovies_user";
//     $password = "secret";
//     $db = "mymovies"; */

//     // Deployment on Heroku with ClearDB for MySQL
//     $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//     $server = $url["host"];
//     $username = $url["user"];
//     $password = $url["pass"];
//     $db = substr($url["path"], 1);

//     return new PDO("mysql:host=$server;dbname=$db;charset=utf8", "$username", "$password",
//     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
// }

// Check if a user is connected
function isUserConnected()
{
    return isset($_SESSION['login']);
}

// Redirect to a URL
function redirect($url)
{
    header("Location: $url");
}
function estEnFavoris($numAnnonce)
{
    include("./includes/connect.php");
    $requete = "SELECT * FROM favoris WHERE NUM_UTILISATEUR = :unutilisateur AND NUM_COQUILLAGE=:uncoquillage ";
    $resultat = $bdd->prepare($requete);
    $resultat->execute(array('unutilisateur' => $_SESSION["identifiant"], 'uncoquillage' => $numAnnonce));
    $annonceFavorite = $resultat->fetch();
    if ($annonceFavorite == null) {
        $fav = "non";
        return $fav;
    } else {
        $fav = "oui";
        return $fav;
    }
}
function square($num)
{
    return $num * $num;
}

// Escape a value to prevent XSS attacks
function escape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

?>