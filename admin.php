<?php
require_once ('FONCTION/fonction.php');

if(!isset($listmot)){
    $listmot = file("mots.txt");
    $mottotal = count($listmot,) -1;
}
if(isset($_GET["lemot"])){
    $key = $_GET["lemot"];
    unset($arrayMot[$key]);
    file_put_contents("mot.txt", $arrayMot);
    header("location: admin.php");
}
if (isset ($_POST ["nouveaumot"])){
    $msg=false;
    $Nouveau= $POST ["nouveau-mot"];
    $nouveaumot = deleteSpecialChar(strtolower($Nouveau));

    foreach ($arrayMot as $key=>$mot){
        if($nouveaumot === $mot){
            $msg = " mot non disponible";
        }
    }
    if (!$msg){
        $fichierMot = fopen('mot.txt','a+');
        fputs ($fichierMot, $nouveaumot . "/n");
        $msg = "mot rentrer dans le jeu";
    }
    header("location: admin.php");
}
?>

<!DOCTYPE html>
<html lang=fr>
    <head>
    <meta charset="UTF-8">
    <title>pendu</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <head>

        </head>
        <main>
            <section class="container">
                <article>
                    <h1>Entre un nouveau mot !</h1>
                    <form action="" method="POST">
                        <label for="newMot">Voulez vous ajouter un nouveau mot ? (<i>caractère spéciaux et les nombres sont interdit</i>)</label>
                        <input type="text" id="newMot" name="newMot">
                        <input class="btn btn-primary" type="submit" name="enoyer" value="envoyer">
                    </form>
                    <a class="btn btn-primary" href="index.php">Retourner jouer !</a>
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
                            <li>Numéro : <?= $key . " " . $mot ?></li>
                            <a class="btn btn-danger" href="./admin.php?leMot=<?= $key ?>">supprimer</a>
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

