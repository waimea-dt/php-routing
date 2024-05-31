<!-- Handle the login data from the form, e.g. check against database -->

<?php

    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user == 'jimmy' && $pass == 'jimmy') {
        $_SESSION['user']['name'] = 'Jimmy User';
        $_SESSION['user']['loggedIn'] = true;

        header('HX-Redirect: ' . SITE_BASE . '/dashboard');
    }
    else {
        echo '<h2>Account or password not recognised</h2>';
    }

?>
