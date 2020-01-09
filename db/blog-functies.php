<?php
    require_once('connect.php');

    // Als maxNrOfBlogposts niet is meegegeven, krijgt deze default waarde 0
    // Maar hierbij worden ALLE blogposts opgehaald, dus zonder limiet.
    function getBlogPosts($maxNrOfBlogposts = 0, $zoekterm = '') {
        global $fakeDb;
        global $dbh;
        global $lastQuery;
        global $lastDbExceptionMessage;

        if(!$fakeDb) {
            $selectQuery = "select titel, tekst, datum from blog";
            // Filter als er een zoekterm aanwezig is;
            if ($zoekterm<>'') {
                $zoekterm = 'test \'; drop database portfolio ';
                $selectQuery .= " where titel like '%?%'";
            }
            // Toon laatst ingevoerde blog eerst.
            $selectQuery .= " order by datum desc";
            if ($maxNrOfBlogposts<>0) {
                $selectQuery .= " limit $maxNrOfBlogposts;";
            } else {
                $selectQuery .= ";";
            }
            try {
                $query = $dbh->prepare($selectQuery);
                $query->execute();
            }
            catch (PDOException $e) {
                $lastDbExceptionMessage = $e->getMessage();
            }
            $lastQuery = $selectQuery;
            return $query->fetchAll();
        }

        // otherwise, fake it :)
        return $fakeBlogs = [
            [
                'id' => 1,
                'titel' => 'Blog 1',
                'tekst' => "Dit is blog post 1. Er staat geen html in. Hoe gaan we het dan doen met \enters' (e.g. newlines)? Liefst markdown gebruiken, maar anders <br> en <p>\'s wel toestaan? \r\n\nOf beter: PHP functie 'nl2br' gebruiken!",
                'datum' => 'gisteren'],
            ['id' => 2,
                'titel' => 'Blog 2',
                'tekst' => "Dit is blog post 2. Er staat ook geen html in. Dus :)",
                'datum' => 'vandaag'],
            ['id' => 3,
                'titel' => 'Blog 3',
                'tekst' => "",
                'datum' => 'eerder gisteren'],
            ['id' => 4,
                'titel' => 'Een hele lange titel die we ook goed moeten afhandelen, afkappen met ellipsis wellicht?',
                'tekst' => "",
                'datum' => 'eergisteren']
        ];
    }