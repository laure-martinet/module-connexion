<?php
session_start();
$bdd = new PDO('mysql:host=localhost; dbname=moduleconnexion', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0 ){
$getid = intval($_GET['id']);
$requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$requser->execute(array($getid));
$userinfo = $requser->fetch();
}
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
    <h2>Profil de <?php echo $userinfo['login']; ?> </h2><br>
    <p>Login de  <?php echo $userinfo['login']; ?> </p><br>
<?php
if(isset ($_SESSION ['id']) AND $userinfo['id'] == $_SESSION['id'] )
{
?>
<a href="#">Editer mon profil</a>
<a href="deconnexion">Deconnexion</a>
<?php 
}
?>
</body>
</html>

