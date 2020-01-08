<?php
    // Set fakeDb op false om echte database te gebruiken.
    // Anders wordt test gebruikt
    //(n.b. deze voor alle soorten
    // data definieren, en persistente verandering van deze
    // data is dan natuurlijk niet mogelijk).
    global $fakeDb;
    $fakeDb = true;

    $hostname = 'localhost';
    $dbname = 'portfolio';
    $username = 'root';
    $pw = '';

    if(!$fakeDb) {
        try {
            $dbh = new PDO("mysql:host=$hostname;dbname=$dbname;ConnectionPooling=0", "$username", "$pw");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Fout met de database: {$e->getMessage()} ");
        }
    }