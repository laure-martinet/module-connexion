<?php
session_start();
 $bdd = new PDO('mysql:host=localhost;dbname=utilisateurs', 'root', '');
 if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login']) {
    $newlogin = htmlspecialchars($_POST['newlogin']);
    $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
    $insertlogin->execute(array($newlogin, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
}
if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND isset($_POST['newconfirmation']) AND !empty($_POST['newconfirmation'])) {
    $mdp1 = sha1($_POST['newpassword']);
    $mdp2 = sha1($_POST['newconfirmation']);
    if($mdp1 == $mdp2) {
        $insertmdp = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
        $insertmdp->execute(array($password, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
} 
else {
    $msg = "Vos deux mdp ne correspondent pas !";
    }
}
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newpassword" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newconfirmation" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
<?php   
}
else {
   header("Location: connexion.php");
}
?>

