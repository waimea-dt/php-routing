<?php
    switch (strtolower($type)) {
        case 'post':
            require 'form-user-new.php';
            break;

        case 'get':
            require 'button-user-view.php';
            break;

        case 'put':
            require 'form-user-update.php';
            break;

        case 'delete':
            require 'button-user-delete.php';
            break;

        default:
            '<h2>Unknown method!</h2>';
    }
?>

