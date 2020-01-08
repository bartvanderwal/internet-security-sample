<?php
    require_once('db/connect.php');

    // We gebruiken post-redirect-get.
    // We redirecten naar formulier in index.php met de headers() functie.
    if (!isset($_POST['titel'])) {
        die("Naar deze pagina kun je alleen posten!");
    }
    $titel = $_POST['titel'];
    $tekst = $_POST['tekst'];

    // $nieuwBlog = ['titel' => $titel, 'tekst' => $tekst ];
    // TODO: Opslaan in database.
    $insertQuery = $dbh->prepare("insert into blog(tekst, titel) values (:tekst, :titel)");
    $insertQuery->execute([':titel' => $titel, ':tekst' => $tekst ]);

    // TODO: Opslaan huidige gegevens in sessie bij validatiefout.
    session_start();
    $_SESSION['titel'] = $titel;
    $_SESSION['tekst'] = $tekst;

    // Redirect.
    header('location: index.php');
?>
<a href="index.php">Handmatig terug naar formulier.</a>