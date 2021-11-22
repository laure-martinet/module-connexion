<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');
if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();

    if(isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $infoutilisateur['login'])
    {
        $login= $_POST['newlogin']; 
        $requetelogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); // SAVOIR SI LE MEME LOGIN EST PRIS
        $requetelogin->execute(array($login));
        $loginexist = $requetelogin->rowCount(); // rowCount = Si une ligne existe = PAS BON

        if($loginexist !== 0) 
        {
            $msg = "Le login existe déjà !";
        }
        else 
        {
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin->execute(array($newlogin, $_SESSION['id']));
        $_SESSION['login']=$newlogin;
        header('Location: profil.php');
        }
    }

    
    if(isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $infoutilisateur['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('Location: profil.php');
    }


    if(isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $infoutilisateur['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('Location: profil.php');
    }

    if(isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2']))
    {
    
       $mdp1 = $_POST['newmdp'];
       $mdp2 = $_POST['newmdp2'];
        
        if($mdp1 == $mdp2)
        {
            $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
            $insertmdp = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $insertmdp->execute(array($hachage, $_SESSION['id']));
            header('Location: profil.php');
        }
        else
        {
            $msg = "Vos mots de passes ne correspondent pas !";
        }
    
    }

    if(isset($_POST['newlogin']) && $_POST['newlogin'] == $infoutilisateur['login'])
    {
        header('Location: profil.php');
    }
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style.css">
        <title>Edition Profil</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div align="center">
            <h2>Edition de mon profil</h2>
            <br />
            <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">    
                    <label for="login">Login :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newlogin" placeholder="Login" value="<?php echo $infoutilisateur['login']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="prenom">Prenom :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newnom" placeholder="Nom" value="<?php echo $infoutilisateur['nom']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="nom">Nom :</label><br /><br />
                    </td>
                    <td>
                    <input type="text" name="newprenom" placeholder="Prenom" value="<?php echo $infoutilisateur ['prenom']; ?>"> <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="newmdp">Password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp" placeholder="Mot de passe" > <br /><br />
                    </td>
                    </tr>
                    <td align="right">    
                    <label for="newmdp2">Confirmation du password :</label><br /><br />
                    </td>
                    <td>
                    <input type="password" name="newmdp2" placeholder="Confirmation mot de passe" > <br /><br />
                    </td>
                </tr>
            </table>
            <?php 
        if(isset($msg))
        {
        echo '<font color="red">'.$msg.'</font><br /><br />'; 
        }
        ?>
        
            <a href="espacemembre.php">
            <input type="submit" name="confirmation" value="Confirmé !">
            </a>
            <br><br>
            <form method="POST" action="espacemembre.php">
            <input type="submit" name="Retour" value="Retour" >
            </form>
        </div>
</html>
<?php
}
else 
{
header("Location: connexion.php");
}

?>