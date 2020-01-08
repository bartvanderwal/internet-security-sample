<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="blogs.php">Blogs</a></li>
        </ul>
    </nav>
    <h1><?= $title ?></h1>
    <?php if ($welkomTekst) { ?>
        <p><?= $welkomTekst ?></p>
    <?php } ?>
</header>
