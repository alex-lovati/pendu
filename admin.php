<?php
require_once('FONCTION/fonction.php');

if (!isset($arrayMot)) { // On compte le nombre de mot dans le fichier .txt 
    $arrayMot = file("mots.txt");
    $mottotal = count($arrayMot,) - 1;
}

if (isset($_POST["nouveaumot"])) {
    $Nouveau = strip_tags(htmlspecialchars($_POST["nouveaumot"]));
    $nouveaumot = $Nouveau;
    if (strlen($_POST["nouveaumot"]) >= 15) { // Maximum de 15 lettres par mot
        $msg = "le mot doit comporter moins de 15 lettres";
    }
    foreach (chooseWord($arrayMot) as $key => $mot) { // Si le mot rentré est identique à un mot déjà existant on met une erreur
        if ($mot == $nouveaumot) {
            $msg = " Le mot est déjà dans le jeu";
        }
    }
    if (!isset($msg)) { // Ajout du mot dans le fichier .txt
        $fichierMot = fopen('mots.txt', 'a+');
        fputs($fichierMot, $nouveaumot . "\n");
        $goodMsg = "Le mot à été rentré  dans le jeu";
    }
    header("location: admin.php");
}
?>

<!DOCTYPE html>
<html lang=fr>
<body>
<head>
    <meta charset="UTF-8">
    <title>pendu</title>
    <link rel="stylesheet" href="css/style.css">
</head>



    <header>
        <h1>Jeu du Pendu</h1>
    </header>

    <main>
        <section class="container">
            <article>
                <h1>Entrez un nouveau mot :</h1>
                <form action="" method="POST">
                    <label for="nouveaumot">Rentrez un nouveau mot ici ^^ -></label>
                    <input type="text" id="nouveaumot" name="nouveaumot">
                    <input class="btn btn-primary" type="submit" name="enoyer" value="envoyer">
                </form>
                <a class="btn btn-primary" href="index.php">Retourner au jeu !</a>
                <h2>Listes des mots</h2>
                <ul>
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }
                    ?>
                    <?php
                    foreach ($arrayMot as $key => $mot) {
                    ?>
                        <li>Numéro <?= $key . " - " . $mot ?></li>
                    <?php
                    }
                    ?>
                    <ul>
            </article>
        </section>
    </main>
    <footer>

    </footer>
</body>

</html>