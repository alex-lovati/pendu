<?php
session_start();

require_once('FONCTION/fonction.php');

// On reset pour recommencer une nouvelle partie
if (isset($_POST["reset"])) {
    session_destroy();
    header("location: index.php");
}

if(!isset($_SESSION['word'])){

    // Pour choisir un mot de manière aléatoire
    $strarray = file_get_contents('mots.txt');
    $strarray = array($strarray);

    $nombreDeMot =  count($strarray) - 1;
    $numrand = rand(0, $nombreDeMot);
    $_SESSION["mot"] = $strarray[$numrand];
echo $_SESSION['mot'];

    // $mots = count(array($strarray)) - 1;

    // $motRand = rand(0, $mots);
    // echo $motRand[$strarray];

}

// $Mots = array($strarray);
// echo $Mots[array_rand($Mots)];
// rand(0,$Mots);

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