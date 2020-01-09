<?php
    require_once('db/connect.php');
    require_once('db/blog-functies.php');
    $zoekterm = '';
    if (isset($_GET['zoekterm'])) {
        $zoekterm = $_GET['zoekterm'];
    }
    $blogs = getBlogPosts(10, $zoekterm);
    $aantalBlogs = count($blogs);
    global $lastQuery;
?>

<!doctype html>
<html lang="nl">
<?php
    $title = 'Blogs';
    include('_includes/head.php');
?>
    <body>
        <?php
            $welkomTekst = '';
            include('_includes/header.php');
        ?>
        <main>
            <section>
                <h2>Blogposts (<?= $aantalBlogs ?>)</h2>
                <form action="" method="get">
                    <label for="zoekterm"></label>
                    <input type="text" id="zoekterm" name="zoekterm">
                    <input type="submit" value="Zoeken">
                </form>
                <div class="blogposts">
                    <?php foreach($blogs as $blog) { ?>
                        <article>
                            <h3><?= $blog['titel']?></h3>
                            <?php
                                $tekst = nl2br(htmlentities($blog['tekst']));
                                if ($tekst <> '') { ?>
                                    <p><?= $tekst ?></p>
                                <?php } else { ?>
                                    <p>Nog geen tekst...</p>
                                <?php } ?>
                        </article>
                    <?php } ?>
                </div>
            </section>
            <section>
                <h2>Debug</h2>
                <p>$lastQuery: <?= $lastQuery ?></p>
            </section>
        </main>
        <?php include('_includes/footer.php'); ?>
    </body>
</html>