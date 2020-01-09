<?php
    require_once('connect.php');

    function saveSessionId($dbh, $sessionId) {
        // $query = "select * from sessionId;";
        $insertQuery = "insert into sessionId(sessionId) values('$sessionId');";

        // NB: Wat gaat er in deze code nog mis?
        // Hint: Bij de schilder thuis bladdert de verf vaak van de muur...
        $query = $dbh->prepare($insertQuery);
        $query->execute();
    }
