<?php
require_once ('FONCTION/fonction.php');

if(!isset($arrayMot)){
    $arrayMot = file("mots.txt");
    $mottotal = count($arrayMot,) -1;
}
if(isset($_GET["lemot"])){

    if(!isset($arrayMot)){
    $msg = "le jeu doit contenir un mot";
    header("refresh:5; url=admin.php");
}else{
    $key = strip_tags(htmlspecialchars($_GET["leMot"]));
    unset($arrayMot[$key]);
    file_put_contents("mot.txt", $arrayMot);
    header("location: admin.php");
}
}
if (isset ($_POST ["nouveaumot"])){
    $Nouveau=strip_tags(htmlspecialchars($_POST["nouveaumot"]));
    $nouveaumot= $Nouveau;
    if(strlen($_POST["nouveaumot"])>=20){
        $msg = "le mot doit comporter moi de 20 lettres";
    }
    foreach (chooseWord($arrayMot) as $key=>$mot){
        if($mot == $nouveaumot){
            $msg = " mot non disponible";
        }
    }
    if (!isset($msg)){
        $fichierMot = fopen('mot.txt','a+');
        fputs ($fichierMot, $nouveaumot ."/n");
        $goodmsg = "mot rentrer dans le jeu";
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
                        <label for="nouveaumot">Met ton nouveau mot ici ^^ -></label>
                        <input type="text" id="nouveaumot" name="nouveaumot">
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

