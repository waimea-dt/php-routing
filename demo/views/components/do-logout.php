<!-- Perform the logout, e.g. session_destroy(); -->

<?php
    session_destroy();
    header('HX-Redirect: ' . SITE_BASE);
?>

