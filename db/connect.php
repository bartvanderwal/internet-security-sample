<?php
    $hostname = 'localhost';
    $dbname = 'portfolio';
    $username = 'root';
    $pw = '';
    try {
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname;ConnectionPooling=0", "$username", "$pw");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Fout met de database: {$e->getMessage()} " );
    }
