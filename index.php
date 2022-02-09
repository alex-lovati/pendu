<?php
session_start();

require_once('FONCTION/fonction.php');

// On reset pour recommencer une nouvelle partie
if (isset($_POST["reset"])) {
    session_destroy();
    header("location: index.php");
}

if (!isset($_SESSION["mot"])) {
    // On ouvre le fichier .txt
    $arrayMot = chooseWord(file("mots.txt"));
    // On compte le nombre de mots - 1 pour commencer à 0
    $countMot =  count($arrayMot,) - 1;
    // On utilise rand() pour en choisir un aléatoirement
    $randMot = rand(0, $countMot);

    // On transforme la variable en $_SESSION
    $_SESSION["mot"] = $arrayMot[$randMot]; 
    // echo $_SESSION['mot'];
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

    </header>

    <main>

        <section>

            <article>
                <form action="" method="POST">
                    <input type="submit" name="reset" value="Nouvelle partie">
                </form>
                <a href="admin.php">Ajouter un mot</a>
            </article>
        </section>
    </main>
    <footer>

    </footer>
</body>

</html>