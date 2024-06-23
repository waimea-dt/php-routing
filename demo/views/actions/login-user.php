<!-- Handle the login data from the form, e.g. check against database -->

<?php

    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    /*************************************************************
     * In reality, you would query the database to check the 
     * username and password against the user table.
     * 
     * $db = connectToDB();
     * 
     * // Try to find a user account with the given username
     * $query = 'SELECT * FROM users WHERE username = ?';
     * $stmt = $db->prepare($query);
     * $stmt->execute([$user]);
     * $userData = $stmt->fetch();
     * 
     * // Did we actually get a user account?
     * if ($userData) {
     *     // Yes, we have an account, so check password
     *     if (password_verify($pass, $userData['hash'])) {
     *         // We got here, so user and password both ok
     *         $_SESSION['user']['loggedIn'] = true;
     *         // Save user info for later use
     *         $_SESSION['user']['forename'] = $userData['forename'];
     *         $_SESSION['user']['surname']  = $userData['surname'];
     *         // Head over to the home page
     *         header('HX-Redirect: ' . SITE_BASE . '/dashboard');
     *     }
     * }
     * 
     * if (!$_SESSION['user']['loggedIn']) {
     *     
     * }
     * 
     * echo '<h2>Account or password not recognised</h2>';
     * 
     ************************************************************/

    if ($user == 'jimmy' && $pass == 'jimmy') {
        $_SESSION['user']['name'] = 'Jimmy User';
        $_SESSION['user']['loggedIn'] = true;

        header('HX-Redirect: ' . SITE_BASE . '/dashboard');
    }
    else {
        echo '<h2>Account or password not recognised</h2>';
    }

?>
