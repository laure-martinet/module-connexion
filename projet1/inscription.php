<?php
    $bdd = new PDO('mysql:host=localhost; dbname=moduleconnexion', 'root', '');
        if (isset($_POST['inscription'])){
            $erreur = "";
            $login = htmlspecialchars($_POST['login']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $password = htmlspecialchars($_POST["password"]);
            $confirmation = htmlspecialchars ($_POST['confirmation']);

        if (!empty($_POST['login']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['password']) AND !empty($_POST['confirmation'])){
            $loginlenght = strlen($login);
            $requete=$bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? ");
            $requete->execute(array($login));
            $loginexist= $requete->rowCount();


            if ($loginlenght > 255)
            $erreur= "Votre pseudo ne doit pas depasser 255 caractères !";        
            elseif($password !== $confirmation)
                    $erreur="Les mots de passes sont differents !";
            if($loginexist !== 0)
            $erreur = "Login deja pris !";
            if($erreur == ""){
                $hashage = password_hash($password, PASSWORD_BCRYPT);
                $insertmbr= $bdd->prepare("INSERT INTO utilisateurs(login, prenom, nom, password) VALUES(?, ?, ?, ?)");
                $insertmbr->execute(array($login, $prenom, $nom, $hashage));
                $erreur = "Votre compte à bien été crée ! <a href=\"connexion.php\"> Me connecter </a>";
            }
        }
            else{
                $erreur="Tout les champs doivent etre remplis !";
            }
}
        
?>
<!doctype html>
<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    </style>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <title>inscription</title>
<body>
    <div class="wesh">
    <form method="POST" action="">
        <h2>Inscription</h2>
            <table>
                <tr>
                    <td align="right">
                        <label for="login">Login:</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Login" id="login" name="login">
                    </td> 
                </tr>
                <tr>
                    <td align="right">
                        <label for="prenom">Prenom:</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre prenom" id="prenom" name="prenom">
                    </td> 
                </tr>
                <tr>
                    <td align="right">
                        <label for="nom">Nom:</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre nom" id="nom" name="nom">
                    </td> 
                </tr>
                <tr>
                    <td align="right">
                        <label for="login">Password:</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre password" id="password" name="password">
                    </td> 
                </tr>
                <tr>
                    <td align="right">
                        <label for="login">Confirmation password:</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmation password" id="confirmation" name="confirmation">
                    </td> 
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <br>
                    <input type="submit" value="Je m'inscris" name="inscription">
                </td>
                </tr>
            </table>
            
    </form>
    <?php
    if (isset($erreur)){
        echo $erreur;
    }
    ?>
</div>

</body>
</html>