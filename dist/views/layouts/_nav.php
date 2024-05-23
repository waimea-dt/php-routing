<!-- Main navigation menu. Can add logic for user type / access -->

<ul hx-boost="true">

    <li><a href="/things"  class="<?= $route=='things'  ? 'active' : '' ?>">Things</a>
    <li><a href="/about"   class="<?= $route=='about'   ? 'active' : '' ?>">About</a>
    <li><a href="/contact" class="<?= $route=='contact' ? 'active' : '' ?>">Contact</a>

</ul>
