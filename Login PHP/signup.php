<?php
//connexion DB
require('connexionDB.php');

//Connexion Session
SESSION_START();

//Déclaration de la variable contenant les messages
$mess = "";

//Déclaration variables REGEX 
$fullnamepattern = "/^[A-Z][a-zA-Z ]{12,}/m";
$usernamepattern = "/[a-zA-Z]{8,}/";
$codepostpattern = "/[a-zA-Z][0-9][a-zA-Z][\ \-]?[0-9][a-zA-Z][0-9]/m";
$emailpattern = "/[a-zA-Z0-9\.\-\_]{4,50}\@[a-zA-Z0-9\.\-\_]{4,64}\.[a-zA-Z]{2,4}/m";
$pswpattern = "/^(?!(soleil|motdepasse|password))(?=.{6,18}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\$\@\#\%\_\-]).*$/m";

//Si l'utilsateur clique sur S'enregistrer 
if (isset($_POST['register'])) {

    //Récupération des données soumises
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $postalcode = $_POST['codePostal'];
    $email = $_POST['email'];
    $psw = $_POST['password'];

    //Validation champs remplis
    if (empty($_POST['fullname']) or empty($_POST['username']) or empty($_POST['codePostal']) or empty($_POST['password'])) {
        $mess = <<<EOT
        <p class="erreur">Veuillez remplir tous les champs</p>
    EOT;
    }
    //Validation REGEX 
    elseif (!preg_match($fullnamepattern, $fullname) && !preg_match($usernamepattern, $username) && !preg_match($codepostpattern, $postalcode) && !preg_match($emailpattern, $$email)  && !preg_match($pswpattern, $psw)) {
        $mess = <<<EOT
    <p class="erreur">Il y a des erreurs dans les champs complétés<br>
    Veuillez réessayer
    </p>
EOT;
    }
    //Ajout de l'utilisateur dans la base de donnée
    else {
        try {
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO utilisateur (nomComplet, username, codePostal, email, motDePasse)
            VALUES ('$fullname', '$username', '$postalcode', '$email', '$psw')";
            // use exec() because no results are returned
            $conn->exec($sql);
            $mess = <<<EOT
            <p class="valider">Votre compte a été créé, vous pouvez vous <a href="login.php">connecter</a></p>
            EOT;
          } catch(PDOException $e) {
            $mess = <<<EOT
            <p class="erreur">Votre compte n'a pu être créee, veuillez réessayer</p>
            EOT;
          }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Signup</title>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <h1>Colnet O'sullivan</h1>
    <div><img src="osullivan.jpg"></div>

    <h3>Veuillez créer un compte</h3>

    <form method="post" action="signup.php" name="signup" id="signup">
        <div class="row champ">
            <label for="nomComplet">Nom complet : </label>
            <div>
                <input type="text" id="fullname" name="fullname" require>
            </div>
        </div>
        <div class="row champ">
            <label for="username">Username : </label>
            <div>
                <input type="text" id="username" name="username" require>
            </div>
        </div>
        <div class="row champ">
            <label for="codePostal">Code Postal : </label>
            <div>
                <input type="text" id="codePostal" name="codePostal" require>
            </div>
        </div>
        <div class="row champ">
            <label for="email">Email : </label>
            <div>
                <input type="email" id="email" name="email" require>
            </div>
        </div>
        <div class="row champ">
            <label for="motDePasse">Mot de passe : </label>
            <div>
                <input type="password" id="password" name="password" require>
            </div>
        </div>
        <div class="champ">
            <button type="submit" name="register" id="register">S'enregistrer</button>
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
    $conn = null;
    ?>


</body>

</html>