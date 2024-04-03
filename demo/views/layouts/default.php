<!-- Default page layout with header / footer / nav -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require PARTIALS . 'head.php'; ?>
    </head>

    <body>

        <header id="main-header">
            <?php require PARTIALS . 'header.php'; ?>

            <nav id="main-nav">
                <?php require PARTIALS . 'nav.php'; ?>
            </nav>
        </header>

        <main>
            <?php require PAGES . $view; ?>
        </main>

        <footer id="main-footer">
            <?php require PARTIALS . 'footer.php'; ?>
        </footer>

    </body>

</html>

