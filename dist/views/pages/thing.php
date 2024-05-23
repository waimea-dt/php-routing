<!-- Use the provided ID to build details, e.g. from a database -->

<div
    hx-get="/thing/<?= $id ?>"
    nx-target="outerHTML"
    hx-trigger="load"
></div>
