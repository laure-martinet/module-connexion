<?php
session_start();
$bdd = new PDO('mysql:host=localhost; dbname=laure-martinet_moduleconnexion', 'lauremartinet', 'couscous123');
if(isset($_GET['id']) AND $_GET['id'] > 0 ){
    $getid = intval($_SESSION['id']); // Convertie ma valeur en int ( ID = un numéro )
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?'); // créer une requete qui va récuperer tout de mon utilisateur de mon id actuel
    $requtilisateur->execute(array($getid)); // return le tableau de mon utilisateur
    $infoutilisateur = $requtilisateur->fetch(); // récupere les informations que j'appelle
}
?>

<!doctype html> 
<html lang="fr">
<head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <title>profil</title>
</head>
<body>
    <div id="profil">
<?php
if(isset ($_SESSION ['login']) AND $_SESSION['login'] == $_SESSION['login'] )
{
?>
<a href="editerprofil.php"><input type="button" value="Editez votre profil"></a><br>
<a href="deconnexion"><input type="button" value="Déconnexion"></a>

    <h2>Profil de <?php echo $_SESSION['login']; ?> </h2><br>
    <p>Login de  <?php echo $_SESSION['prenom']; ?> </p>
    <p>Login de  <?php echo $_SESSION['nom']; ?> </p>


<?php }


// echo $infoutilisateur;?>
</div>
<footer>
      <div id="github">
         <a href="https://github.com/laure-martinet/module-connexion">
            <img src="imggit.png" width="300" height="200">
         </a>
      </div>
   </footer>
</body>
</html>

