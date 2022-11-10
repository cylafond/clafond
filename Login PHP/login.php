<!DOCTYPE html>
<html lang="fr">

<?php
//Connexion DB
require('connexionDB.php');

//Connexion Session
SESSION_START();

//Déclaration variable contenant les messages
$mess = "";

//Déclaration variables REGEX 
$usernamepattern = "/[a-zA-Z]{8,}/";
$pswpattern = "/^(?!(soleil|motdepasse|password))(?=.{6,18}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\$\@\#\%\_\-]).*$/m";

//Si l'utilsateur clique sur connection 
if (isset($_POST['connexion'])) {
    //Récupération des données soumises 
    $username = $_POST['username'];
    $psw = $_POST['password'];

    //Validation champs remplis
    if (empty($_POST['username']) or empty($_POST['password'])) {
        $mess = <<<EOT
            <p class="erreur">Veuillez remplir tous les champs ou appuyer sur 'Créer un compte'</p>
        EOT;
    } //Valider si pattern respecté
    elseif (!preg_match($usernamepattern, $username) && !preg_match($pswpattern, $psw)) {
        $mess = <<<EOT
    <p class="erreur">Votre nom d'utilisateur doit contenir minimalement 8 caractères, aucun espace, aucun chiffre <br>
    Votre mot de passe doit contenir entre 6 et 18 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre et un caractère spécial autorisé ! # $ @ % _ - <br>
    Veuillez réessayer
    </p>
EOT;
    } else {

        // requete sql pour verifier si l'utilisateur existe et que le password correspond
        $result = $conn->prepare("SELECT * FROM utilisateur WHERE username= '$username' AND motDePasse= '$psw' ");
        $result->execute();
        //Récupération du résultat de la requête
        $recup = $result->fetch(PDO::FETCH_NUM);
        // si oui on demarre la session
        if ($recup > 0) {

            $_SESSION['username'] = $username;
            
            //Message réussite
            $mess = <<<EOT
            <p class="valider">Crédentiels valides, vous pouvez accéder à <a href="index.php">l'accueil</a></p>
            EOT;
        } else {
            //Message d'erreur

            $mess = <<<EOT
            <p class="erreur">Crédentiels invalides, vérifier vos information ou créez un compte</p>
        EOT;
        }
    }
}
//Si utilisateur appuie sur créer un compte, redirige vers signup.php
if (isset($_POST['compte'])) {
    header("Location: signup.php");
}


?>

<head>

    <title>Login</title>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <h1>Colnet O'sullivan</h1>
    <div><img src="osullivan.jpg"></div>

    <h3>Veuillez vous connecter</h3>

    <form method="post" action="login.php" name="login" id="login">
        <div class="row champ">
            <label for="username">Nom d'utilisateur : </label>
            <div>
                <input type="text" id="username" name="username" require>
            </div>
        </div>
        <div class="row champ">
            <label for="password">Mot de passe : </label>
            <div>
                <input type="password" id="password" name="password" require>
            </div>
        </div>

        <div class="row champ">
            <div>
                <button type="submit" name="connexion" id="connexion">Se connecter</button>
            </div>
            <div>
                <button type="submit" name="compte" id="compte">Créer un compte</button>
            </div>
        </div>

    </form>

    <?php
    echo $mess;
    ?>
    <div class="copyrights">
        <a href="#"><i class="fa-regular fa-copyright"></i></a>
        2022 - Collège O'sullivan de Québec
    </div>

    <?php
    $conn = null
    ?>

</body>

</html>