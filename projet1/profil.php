<?php
session_start();
$bdd = new PDO('mysql:host=localhost; dbname=moduleconnexion', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0 ){
    $getid = intval($_SESSION['id']); // Convertie ma valeur en int ( ID = un numéro )
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?'); // créer une requete qui va récuperer tout de mon utilisateur de mon id actuel
    $requtilisateur->execute(array($getid)); // return le tableau de mon utilisateur
    $infoutilisateur = $requtilisateur->fetch(); // récupere les informations que j'appelle
}

echo  $_SESSION['login'];


?>

<!doctype html>
<style>
    body{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <title>profil</title>
</head>
<body>
<?php
if(isset ($_SESSION ['login']) AND $_SESSION['login'] == $_SESSION['login'] )
{
?>
<a href="editerprofil.php">Editer profil</a>
<a href="deconnexion">Deconnexion</a>

    <h2>Profil de <?php echo $_SESSION['login']; ?> </h2><br>
    <p>Login de  <?php echo $_SESSION['prenom']; ?> </p><br>


<?php }


// echo $infoutilisateur;?>
</body>
</html>

