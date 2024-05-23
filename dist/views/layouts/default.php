<!-- Default page layout with header / footer / nav -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require '_head.php'; ?>
    </head>

    <body>

        <header id="main-header">
            <?php require '_header.php'; ?>

            <nav id="main-nav">
                <?php require '_nav.php'; ?>
            </nav>
        </header>


        <main>
            <?php require VIEWS . $view; ?>
        </main>


        <footer id="main-footer">
            <?php require '_footer.php'; ?>
        </footer>

    </body>

</html>

