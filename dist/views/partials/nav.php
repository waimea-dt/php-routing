<!-- Main navigation menu. Can add logic for user type / access -->

<ul hx-boost="true">

    <li><a href="<?= SITE_BASE ?>/things"    class="<?= $route=='things'    ? 'active' : '' ?>">Things</a>
    <li><a href="<?= SITE_BASE ?>/about"     class="<?= $route=='about'     ? 'active' : '' ?>">About</a>
    <li><a href="<?= SITE_BASE ?>/contact"   class="<?= $route=='contact'   ? 'active' : '' ?>">Contact</a>

</ul>
