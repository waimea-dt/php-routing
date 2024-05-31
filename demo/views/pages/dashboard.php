<!-- This could be any information from the database -->

<?php global $isLoggedIn; ?>
    

<?php if ($isLoggedIn): ?>

    <h1>Dashboard</h1>

    <section id="dashboard">

        <article
            hx-get="/sales"
            hx-trigger="load, every 300s"
        >
            Loading sales data...
        </article>

        <article
            hx-get="/system"
            hx-trigger="load, every 1s"
        >
            Loading system status...
        </article>

    </section>

<?php else: ?>

    <h1>Forbidden</h1>

    <p>You are not authorised to see this information</p>

<?php endif ?>
