<!-- Header typically has the site name which links to home page -->

<h1>
    <a href="<?= SITE_BASE ?>">
        <?= SITE_NAME ?>
    </a>
</h1>

<?php if ($isLoggedIn): ?>

<p>
    Welcome, <?= $userName ?>
</p>

<?php endif ?>

