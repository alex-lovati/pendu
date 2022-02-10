<?php
session_start();

include_once('FONCTION/fonction.php');

// On reset pour recommencer une nouvelle partie
if (isset($_POST["reset"])) {
    session_destroy();
    header("location: index.php");
}

// Création des variables de session
$lettres = "abcdefghijklmnopqrstuvwxyz";
$_SESSION['motActuel'] = "";
$_SESSION['motAffiché'] = ""; // Affiche les lettres que l'utilisateur aura choisi et qui sont dans le mot à trouver
$_SESSION['tiret'] = "-";
$_SESSION['lettreBonne'] = "";
$i = 0;
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = 0;
}


if (!isset($_SESSION['mot'])) {
    // On ouvre le fichier .txt
    $arrayMot = chooseWord(file('mots.txt'));
    // On compte le nombre de mots - 1 pour commencer à 0
    $countMot =  count($arrayMot,) - 1;
    // On utilise rand() pour en choisir un aléatoirement
    $randMot = rand(0, $countMot);

    // On transforme la variable en $_SESSION
    $_SESSION['mot'] = $arrayMot[$randMot];
}

// On mesure la longueur du mot choisi et on affiche le nbre de tiret nécessaire
$nbrLettre = strlen($_SESSION['mot']);
for ($i = 0; $i < $nbrLettre; $i++) {
    $_SESSION['motAffiché'][$i] = $_SESSION['tiret'];
}

// Création de la variable $char 
if (isset($_GET['a']) && strlen($_GET['a']) == 1 && strpos($lettres, $_GET['a']) !== false && $_SESSION['error'] <= 9) {
    $char = '';
    $char = $_GET['a'];

    if (!isset($_SESSION['lettre']) && empty($_SESSION['lettre'])) {

        $_SESSION['lettre']  = $char;
    } else {
        $_SESSION['lettre'] .= $char;
    }

    $found = false; // Pour le moment si le mot n'est pas trouvé

    for ($j = 0; $j < strlen($_SESSION['lettre']); $j++) {


        for ($i = 0; $i < strlen($_SESSION['mot']); $i++) {

            if ($_SESSION['mot'][$i] == $_SESSION['lettre'][$j] && $_SESSION['mot'] !== $_SESSION['motAffiché']) {

                $_SESSION['motAffiché'][$i] = $_SESSION['lettre'][$j];

                if ($_SESSION["mot"][$i] == $char) {

                    $found = true; // Si le mot est trouvé

                    if ($_SESSION['motAffiché'] != $_SESSION['mot'])
                        $msg = "'$char' est dans le mot";

                    else {
                        $msg = "Vous avez gagné !";
                    }
                }
            }
        }
    }

    //Si on tombe sur une mauvaise lettre 
    if (!$found && isset($_SESSION["error"])) {

        ++$_SESSION["error"];

        $msg = "'$char' n'est pas dans le mot";
    }
    // if(!$found && isset($_SESSION["error"]) > 5) {
    //                 $msg = "C'est perdu :(";
    //             }
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Pendu</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <header>
        <h1>Jeu du Pendu</h1>
    </header>

    <main>

        <section>

            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?> <div id="error_msg">
                <?php
                echo $_SESSION['motAffiché']; // Affiche les lettres trouvées ou des tirets à la place
                ?>


            </div>
            <img src="MEDIA/pendu<?= $_SESSION['error'] ?>.png">

            <section>
                <?php
                // Si il y'a moins de 6 erreurs et si le mot est égal au mot affiché on affiche les éléments du jeu
                if ($_SESSION['error'] <= 6 && $_SESSION['mot'] !== $_SESSION['motAffiché']) {
                    // On affiche toutes les lettres
                    for ($i = 0; $i < strlen($lettres); $i++) {
                        if (isset($_SESSION['lettre']) && strpos($_SESSION['lettre'], $lettres[$i]) === false) {
                            echo "<a href='index.php?a=$lettres[$i]'>$lettres[$i]</a> ";
                        } else if (!isset($_SESSION["lettre"])) {
                            echo "<a href='index.php?a=$lettres[$i]'>$lettres[$i]</a> ";
                        }
                    }
                }
                ?>
            </section>
            <article>
                <form action="" method="POST">
                    <input type="submit" name="reset" value="Nouvelle partie">
                </form>
                <a href="admin.php">Ajouter un mot</a>
            </article>
        </section>
    </main>
</body>

</html>