<!-- Main navigation menu. Can add logic for user type / access -->

<ul hx-boost="true">

    <?php if ($isLoggedIn): ?>

        <li><a href="<?= SITE_BASE ?>/dashboard" class="<?= $route=='dashboard' ? 'active' : '' ?>">Dashboard</a>
        <li><a href="<?= SITE_BASE ?>/things"    class="<?= $route=='things'    ? 'active' : '' ?>">Things</a>

        <li><a href="<?= SITE_BASE ?>/logout"    class="<?= $route=='logout'    ? 'active' : '' ?>">Logout</a>

    <?php else: ?>

        <li><a href="<?= SITE_BASE ?>/things"    class="<?= $route=='things'    ? 'active' : '' ?>">Things</a>
        <li><a href="<?= SITE_BASE ?>/about"     class="<?= $route=='about'     ? 'active' : '' ?>">About</a>
        <li><a href="<?= SITE_BASE ?>/contact"   class="<?= $route=='contact'   ? 'active' : '' ?>">Contact</a>

        <li><a href="/login"     class="<?= $route=='login'   ? 'active' : '' ?>">Login</a>

    <?php endif ?>

</ul>
