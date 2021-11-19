<?php
session_start();
$bdd = new PDO('mysql:host=localhost; dbname=moduleconnexion', 'root', '');
if(isset($_POST['connexion']))
{
    $erreur = "";
    $loginconnect = htmlspecialchars($_POST['loginconnect']);
    $passwordconnect = htmlspecialchars($_POST['passwordconnect']);
    $hashage = password_hash($passwordconnect, PASSWORD_BCRYPT);

    if(!empty($loginconnect) AND !empty($passwordconnect)){
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password ?");
    $requser->execute(array($loginconnect, $passwordconnect));
    $userexist = $requser->rowCount();
            if($userexist == 1){
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['login'] = $userinfo['login'];
                header("Location: profil.php?id=". $_SESSION['id']);
            }
            else {
                $erreur = "Mauvais login ou password";
            }


    }
    else{
        $erreur = "Tout les champs doivent etre remplis !";
    }
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
        <title>connexion</title>
</head>
<body>
<form method="POST" action="connexion.php">
    <h2>Connexion</h2>
<table>
                <tr>
                    <td align="right">
                        <label for="login">Login:</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Login" id="login" name="loginconnect">
                    </td> 
                </tr>
                <tr>
                    <td align="right">
                        <label for="login">Password:</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre password" id="password" name="passwordconnect">
                    </td> 
                    <td>
                        <input type="submit" id="connexion" name="connexion" value="Se connecter">
                    </td>
                </tr>
</table>
</form>
<?php
    if (isset($erreur)){
        echo $erreur;
    }
    ?>
</body>
</html>

