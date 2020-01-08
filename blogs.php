<?php
    require_once('db/connect.php');
    require_once('db/blog-functies.php');

    $blogs = getBlogPosts();
    $aantalBlogs = count($blogs);

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
        </main>
        <?php include('_includes/footer.php'); ?>
    </body>
</html>