<!DOCTYPE html>
<html lang="fr">

<?php
//Connexion DB
require('connexionDB.php');
//Démarrer session
session_start();

//Verification de l'existence d'une session si non on renvoi sur la page login.php
if (!isset($_SESSION['username'])) {
	header("location:login.php");
}



//Création des fonctions pour chacune des pages des différentes pages

/** 
 *Affiche Menu de la page Index 
 * 
 * 
 * @return void 
 *  
 */

function afficherMenu()
{
	$menu = <<<EOT
	<h3>Veuillez faire un choix</h3>
	<div class="menu" id="menu">
	<a href="index.php?menu=ajoutgroupe">Ajouter un groupe</a>
	<a href="index.php?menu=ajoutetudiant">Ajouter un étudiant</a>
	<a href="index.php?menu=afficherdonnees">Afficher données</a>
	<a href="index.php?menu=compiler">Compiler statistiques</a>
	</div>
EOT;
	echo $menu;
}

/** 
 *Affiche formulaire Ajout Groupe et fait l'ajout du groupe
 * 
 * 
 * @return void 
 *  
 */

function ajoutGroupe()
{
	//Connexion DB
	require('connexionDB.php');
	//Déclaration variable contenant messages
	$mess = "";

	//Déclaration variables REGEX 
	$codePattern = '/^[A-Z]{4}[0-9]{2}[A-Z]{1}$/m';
	$nomPattern = "/[a-zA-Z0-9 \-']{10,}/m";

	//Si utilisateur appuie sur 'ajouter'
	if (isset($_POST['ajouter'])) {

		//Récupération des données soumises
		$code = $_POST['code'];
		$nom = $_POST['nom'];
		$typeGroupe = $_POST['type'];

		//Validation champs remplis
		if (empty($_POST['code']) or empty($_POST['nom'])) {
			$mess = <<<EOT
			<p class="erreur">Veuillez remplir tous les champs</p>
		EOT;
			echo $groupe;
			echo $mess;
		}
		//Validation REGEX 
		elseif (!preg_match($codePattern, $code) or !preg_match($nomPattern, $nom)) {
			$mess = <<<EOT
		<p class="erreur">Il y a des erreurs dans les champs complétés<br>
		Veuillez réessayer
		</p>
	EOT;
			echo $groupe;
			echo $mess;
		}
		//Ajout du groupe dans la base de donnée
		else {
			try {
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO groupe (code, nom, type)
				VALUES ('$code', '$nom', '$typeGroupe')";
				// use exec() because no results are returned
				$conn->exec($sql);
				$mess = <<<EOT
				<p class="valider">Le groupe $nom a bien été ajouté</a></p>
				EOT;
			} catch (PDOException $e) {
				$mess = <<<EOT
				<p class="erreur">Le groupe n'a pu être ajouté, veuillez réessayer</p>
				EOT;
			}
			echo $groupe;
			echo $mess;
		}
	}
	//Déclaration variable contenant le HTML
	$groupe = <<<EOT
	<h3>Ajouter un groupe</h3>
<form method="post" action="index.php?menu=ajoutgroupe" name="ajoutgroupe" id="ajoutgroupe">
	<div class="row champ">
		<label for="code">Code : </label>
		<div> 
			<input type="text" id="code" name="code">
		</div>
	</div> 
	<div class="row champ">
		<label for="nom">Nom : </label>
		<div> 
			<input type="text" id="nom" name="nom">
		</div>
	</div>
	<div class="row champ">
		<label for="type">Choisir un type : </label>
		<div>
			<select id="type" name="type">
				<option value="En ligne">En ligne</option>
				<option value="En classe">En classe</option>
				<option value="Hybride">Hybride</option>
			</select>
		</div>
	</div>
	<div class="champ">
		<button type="submit" name="ajouter" id="ajouter">Ajouter</button>
	</div>
</form>
<p>Revenir vers<a href="index.php">l'accueil</a></p>
EOT;
	echo $groupe;
}


/** 
 *Affiche formulaire Ajout Étudiant
 * 
 * 
 * @return void 
 *  
 */

function ajoutEtudiant()
{

	//Connexion DB
	require('connexionDB.php');
	//Déclaration variable contenant messages
	$mess = "";

	//Déclaration variables REGEX 
	$codePermPattern = '/^[A-Z]{4}[0-9]{6}$/m';
	$fullNamePattern = '/^[A-Z]|[\ \-\']|[aA-zZ]{1,}/m';
	$adressePattern = '/^[A-Z]|[\ \-\']|[aA-zZ]{1,}/m';
	$telPattern = '/[\-\d]{11}/m';
	$moyennePattern = '/^[0-9]?/m';

	//Si utilisateur appuie sur 'ajouter'
	if (isset($_POST['ajouter'])) {

		//Récupération des données soumises
		$codePerm = $_POST['codePermanent'];
		$fullname = $_POST['nomComplet'];
		$adresse = $_POST['adresse'];
		$tel = $_POST['telephone'];
		$moyenne = $_POST['moyenne'];
		$codeGroupe = $_POST['codeGroupe'];

		//Validation champs remplis
		if (empty($_POST['codePermanent']) or empty($_POST['nomComplet']) or empty($_POST['adresse']) or empty($_POST['telephone']) or empty($_POST['moyenne'])) {
			$mess = <<<EOT
				<p class="erreur">Veuillez remplir tous les champs</p>
			EOT;
			echo $groupe;
			echo $mess;
		}
		//Validation REGEX 
		elseif (!preg_match($codePermPattern, $codePerm) or !preg_match($fullNamePattern, $fullname) or !preg_match($adressePattern, $adresse) or !preg_match($telPattern, $tel) or !preg_match($moyennePattern, $moyenne)) {
			$mess = <<<EOT
			<p class="erreur">Il y a des erreurs dans les champs complétés<br>
			Veuillez réessayer
			</p>
		EOT;
			echo $etudiant;
			echo $mess;
		}
		//Ajout de l'étudiant dans la base de donnée
		else {
			try {
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO etudiant (codePermanent, nomComplet, adresse, telephone, moyenne, codeGroupe)
				VALUES ('$codePerm', '$fullname', '$adresse', '$tel', '$moyenne', '$codeGroupe')";
				// use exec() because no results are returned
				$conn->exec($sql);
				$mess = <<<EOT
				<p class="valider">L'étudiant $fullname a bien été ajouté</a></p>
				EOT;
			} catch (PDOException $e) {
				$mess = <<<EOT
				<p class="erreur">L'étudiant n'a pu être ajouté, veuillez réessayer</p>
				EOT;
			}
			echo $etudiant;
			echo $mess;
		}
	}

	$etudiant = <<<EOT
	<h3>Ajouter un étudiant</h3>
<form method="post" action="index.php?menu=ajoutetudiant" name="ajoutetudiant" id="ajoutetudiant">
        <div class="row champ">
            <label for="codePermanent">Code permanent : </label>
            <div> 
                <input type="text" id="codePermanent" name="codePermanent">
            </div>
        </div> 
        <div class="row champ">
            <label for="nomComplet">Nom Complet : </label>
            <div> 
                <input type="text" id="nomComplet" name="nomComplet">
            </div>
        </div>
        <div class="row champ">
            <label for="adresse">Adresse : </label>
            <div> 
                <input type="text" id="adresse" name="adresse">
            </div>
        </div>
        <div class="row champ">
            <label for="telephone">Téléphone: </label>
            <div> 
                <input type="tel" id="telephone" name="telephone">
            </div>
        </div>
        <div class="row champ">
            <label for="moyenne">Moyenne: </label>
            <div> 
                <input type="number" id="moyenne" name="moyenne">
            </div>
        </div>
        <div class="row champ">
            <label for="codeGroupe">Choisir un groupe : </label>
            <div> 
                <select id="codeGroupe" name="codeGroupe">
                    <option value="WEBA21C">WEBA21C</option>
                    <option value="WEBA21H">WEBA21H</option>
                    <option value="WEBA21L">WEBA21L</option>
                    <option value="WEBA21C">WEBH21C</option>
                </select>
            </div>
        </div>


        <div class="champ">
            <button type="submit" id="ajouter" name="ajouter">Ajouter</button>
        </div>
</form>
<p>Revenir vers <a href="index.php">l'accueil</a></p>
EOT;
	echo $etudiant;
	//Je devais ajouter une requête pour pouvoir sélectionner les groupes existants dans la BD mais je n'y suis pas arrivé :(
}

/** 
 *Affiche donnees
 * 
 * 
 * @return void 
 *  
 */
//NE FONCTIONNE PAS
function afficherDonnees()
{
	//Connexion DB
	require('connexionDB.php');
	$donnees = <<<EOT
<h3>Veuillez appliquez vos filtres</h3>
<form method="post" action="index.php?menu=afficherdonnees" name="" id="">
<div class="row champ">
	<label for="codeGroupe">Choisir un groupe : </label>
	<div> 
		<select id="codeGroupe">
			<option value="WEBA21C">WEBA21C</option>
			<option value="WEBA21H">WEBA21H</option>
			<option value="WEBA21L">WEBA21L</option>
			<option value="WEBA21C">WEBH21C</option>
		</select>
	</div>
</div>
<div class="row champ">
	<label for="trimoy">Tri sur la moyenne : </label>
	<div> 
		<select id="ordre" name="ordre">
			<option value="ASC">Ascendant</option>
			<option value="DESC">Descendant</option>
		</select>
	</div>
</div>


<div class="champ">
	<button type="submit" id="resultats" name="resultats">Afficher Résultats</button>
</div>
</form>
<p>Revenir vers<a href="index.php">l'accueil</a></p>
EOT;

	if (isset($_POST['resultats'])) {
		$codeGroupe = ($_POST['codeGroupe']);
		$ordre = ($_POST['ordre']);
		//Requête SQL
		$result = $conn->prepare("SELECT * FROM etudiant WHERE codeGroupe=$codeGroupe ORDER BY moyenne $ordre");
		$result->execute();
		while ($row= $result->fetch(PDO::FETCH_ASSOC)) {
		echo "<h3>Résultats</h3>
		<table>
			<thead>
				<tr>
					<th>Code permanent</th>
					<th>Nom complet</th>
					<th>Adresse</th>
					<th>Téléphone</th>
					<th>Moyenne</th>
					<th>Groupe</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td>".$row['codePermanent']."</td>
				<td>".$row['nomComplet']."</td>
				<td>".$row['adresse']."</td>
				<td>".$row['telephone']."</td>
				<td>".$row['moyenne']."</td>
				<td>".$row['codeGroupe']."</td>
				</tr>
			</tbody>
		</table>";
	}
	echo $mess = <<<EOT
	<p>Revenir vers<a href="index.php">l'accueil</a></p>
	EOT;
	} else {
		echo $donnees;
	}
}


/** 
 *Affiche tri de la moyenne
 * 
 * 
 * @return void 
 *  
 */

function afficherStats()
{
	//connexion DB
	require('connexionDB.php');
	//Déclaration variables des messages 
	$mess = "";
	//affichage Titre
	$stat = <<<EOT
	<h3>Veuillez consulter les statistiques</h3>
	EOT;
	echo $stat;

	//Requête SQL nb d'etudiants évalués
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant WHERE moyenne IS NOT NULL");
	$result->execute();
	$recup = $result->fetchColumn();
	//affichage du resultat
	echo $mess =
		<<<EOT
<p>$recup étudiants ont été evalués<p>
EOT;

	//Requête SQL nb d'étudiants ayant réussi
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant WHERE moyenne >= 12");
	$result->execute();
	$recup = $result->fetchColumn();
	//affichage résultat
	echo $mess = <<<EOT
<p>$recup étudiants ont réussi<p>
EOT;

	//Requête SQL taux réussite en ligne 
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant INNER JOIN groupe ON etudiant.codeGroupe = groupe.code WHERE groupe.type = 'En ligne'");
	$result->execute();
	$typeGroupe = $result->fetchColumn();
	#Sélectionner nb d'étudiants qui ont une moyenne >= 12 et type en ligne
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant INNER JOIN groupe ON etudiant.codeGroupe = groupe.code WHERE etudiant.moyenne >= 12 AND groupe.type = 'En ligne'");
	$result->execute();
	$moy = $result->fetchColumn();
	$calcul = ($moy / $typeGroupe) * 100;
	$pourcent = $calcul . '%';
	echo $mess = <<<EOT
<p>Le taux de réussite en ligne est $pourcent<p>
EOT;

	//Requête SQL taux réussite en classe
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant INNER JOIN groupe ON etudiant.codeGroupe = groupe.code WHERE groupe.type = 'En classe'");
	$result->execute();
	$typeGroupe = $result->fetchColumn();
	#Sélectionner nb d'étudiants qui ont une moyenne >= 12 et type en classe
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant INNER JOIN groupe ON etudiant.codeGroupe = groupe.code WHERE etudiant.moyenne >= 12 AND groupe.type = 'En classe'");
	$result->execute();
	$moy = $result->fetchColumn();
	$calcul = ($moy / $typeGroupe) * 100;
	$pourcent = $calcul . "%";
	echo $mess = <<<EOT
<p>Le taux de réussite en classe est $pourcent<p>
EOT;

	//Requête SQL taux réussite en classe
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant INNER JOIN groupe ON etudiant.codeGroupe = groupe.code WHERE groupe.type = 'Hybride'");
	$result->execute();
	$typeGroupe = $result->fetchColumn();
	#Sélectionner nb d'étudiants qui ont une moyenne >= 12 et type hybride
	$result = $conn->prepare("SELECT COUNT(*) FROM etudiant INNER JOIN groupe ON etudiant.codeGroupe = groupe.code WHERE etudiant.moyenne >= 12 AND groupe.type = 'Hybride'");
	$result->execute();
	$moy = $result->fetchColumn();
	$calcul = ($moy / $typeGroupe) * 100;
	$pourcent = $calcul . "%";
	echo $mess = <<<EOT
<p>Le taux de reussite en Hybride est $pourcent<p>
EOT;

	//Affichage copyrights
	$copyright = <<<EOT
	<br><br><p>Revenir vers<a href="index.php">l'accueil</a></p><br>
	EOT;
	echo $copyright;
}

//Retour à la page login.php et destruction session si appuie sur bouton déconnexion
if (isset($_POST['deconnexion'])) {
	session_unset();
	session_destroy();
	$conn = null;
	header("location: login.php");
}

?>

<head>

	<title>index</title>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
	<h1>Colnet O'sullivan</h1>
	<div><img src="osullivan.jpg"></div>


	<?php
	//Connexion Session
	SESSION_START();
	//Affichage du menu et des différentes pages 
	if (isset($_GET['menu'])) {

		if ($_GET['menu'] == "ajoutgroupe") {
			ajoutGroupe();
		} elseif ($_GET['menu'] == "ajoutetudiant") {
			ajoutEtudiant();
		} elseif ($_GET['menu'] == "afficherdonnees") {
			#la fonction afficherResultat devra apparaitre en haut de afficher données 
			afficherDonnees();
		} elseif ($_GET['menu'] == "compiler") {
			afficherStats();
		}
	} else {
		afficherMenu();
	}
	$conn = null;
	?>
	<form method="post" action="index.php" name="disconnect" id="disconnect">
		<div class="champ">
			<button type="submit" name="deconnexion" id="de">Se déconnecter</button>
		</div>
	</form>
	<div class="copyrights">
		<a href="#"><i class="fa-regular fa-copyright"></i></a>
		2022 - Collège O'sullivan de Québec
	</div>



</body>

</html>