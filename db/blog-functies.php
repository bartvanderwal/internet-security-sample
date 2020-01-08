<?php
    require_once('db/connect.php');

    // Als maxNrOfBlogposts niet is meegegeven, krijgt deze default waarde 0
    // Maar hierbij worden ALLE blogposts opgehaald, dus zonder limiet.
    function getBlogPosts($maxNrOfBlogposts = 0) {
        global $fakeDb;
        global $dbh;

        if(!$fakeDb) {
            $selectQuery = "select * from blog";
            if ($maxNrOfBlogposts<>0) {
                $selectQuery .= " limit $maxNrOfBlogposts;";
            } else {
                // Anders geen limiet (maar SQL statements wel netjes afsluiten met punt komma :).
                $selectQuery .= ";";
            }
            $query = $dbh->prepare($selectQuery);
            $query->execute();
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