<?php
    require_once('db/connect.php');

    $fakeDb = true;
    session_start();

    if (!$fakeDb) {
        // TODO: Blogs echt uit de database halen.
        $selectQuery = "select * from blog";
        $query = $dbh->prepare($selectQuery);
        $statement = $query->execute();
        $blogs = $query->fetchAll();
        $aantalBlogs = $query->rowCount();
    } else {
        $blogs = [
            [
                'id' => 1,
                'titel' => 'Blog 1',
                'tekst' => 'Dit is blog post 1. Er staat geen html in. Hoe gaan we het dan doen met enters? Liefst markdown gebruiken, maar anders <br> en <p>\'s wel toestaan? \r\nOf beter: PHP functie "nl2br" gebruiken!',
                'datum' => 'gisteren'],
            ['id' => 2,
                'titel' => 'Blog 2',
                'tekst' => 'Dit is blog post 2. Er staat ook geen html in. Dus :)',
                'datum' => 'vandaag']
        ];
        $aantalBlogs = count($blogs);
    }
    $nieuweBlog = [ 'titel' => '', 'tekst' => '' ];
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/general.css">
    <title>Welkom</title>
</head>
<body>
    <header>
        <h1>Welkom to teh portfolio!</h1>
        <p>Welkom op mijn website</p>
    </header>
    <main>
        <section>
            <h2>Last blogposts (<?= $aantalBlogs ?>)</h2>
            <div class="last-blogposts">
                <?php foreach($blogs as $blog) { ?>
                    <article>
                        <h3><?= $blog['titel']?></h3>
                        <?php
                            $blogTekst = nl2br(htmlentities($blog['tekst']));
                        ?>
                        <p><?= $blogTekst ?? 'Geen tekst' ?></p>
                    </article>
                <?php } ?>
            </div>
        </section>
        <section>
            <h2>New blog post</h2>
            <form action="new-blog.php" method="post">
                <div>
                    <label for="titel">Titel</label>
                    <input type="text" name="titel" id="titel" value="<?= $nieuweBlog['titel'] ?>">
                </div>
                <div>
                    <label for="tekst">Tekst</label>
                    <textarea name="tekst" id="tekst" rows="5" cols="50"><?= $nieuweBlog['tekst']?></textarea>
                </div>
                <div>
                    <label></label>
                    <input type="submit" value="Voeg toe!">
                </div>
                <div>
                    <label></label>
                    <input style="color: red;" type="reset" value="Reset">
                </div>            </form>
        </section>
    </main>
    <footer>&copy; Bart van der Wal <?= date('Y') ?></footer>
</body>
</html>