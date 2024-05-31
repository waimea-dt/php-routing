<!-- Header typically has the site name which links to home page -->

<?php global $userName ?>


<header id="main-header">
    
    <a href="/"><?= SITE_NAME ?></a>

    <p>Kia ora, <?= $userName ?></p>
    
    <?php require '_nav.php'; ?>

</header>

