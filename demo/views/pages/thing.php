<!-- Use the provided ID to build details, e.g. from a database -->

<h1>Thing Information</h1>

<div
    hx-get="<?= SITE_BASE ?>/thing/<?= $id ?>"
    hx-swap="innerHTML"
    hx-trigger="load"
></div>

