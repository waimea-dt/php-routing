<!-- This could be any information from the database -->

<h1>Dashboard</h1>

<section id="dashboard">

    <div
        hx-get="<?= SITE_BASE ?>/sales"
        hx-trigger="load, every 300s"
        hx-swap="innerHTML"
    ></div>

    <div
        hx-get="<?= SITE_BASE ?>/system"
        hx-trigger="load, every 3s"
        hx-swap="innerHTML"
    ></div>

</section>

