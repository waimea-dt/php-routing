<!-- Use the provided ID to build details, e.g. from a database -->

<div id="thing-info">

    <?php if ($isLoggedIn): ?>

        <button
            hx-get="<?= SITE_BASE ?>/thing-edit/<?= $id ?>"
            hx-target="#thing-info"
            hx-swap="outerHTML"
        >
            Edit
        </button>

    <?php endif ?>

    <h2>Thing <?= $id ?></h2>

    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    </p>

    <p>
        Placerat duis ultricies lacus sed turpis tincidunt id aliquet risus. Etiam tempor orci eu lobortis elementum nibh tellus molestie nunc. Et netus et malesuada fames ac turpis egestas. Tellus at urna condimentum mattis pellentesque id nibh tortor.
    </p>

    <img src="<?= SITE_BASE ?>/images/thing<?= $id ?>.jpg">

    <table>
        <tr>
            <th>Option</th>
            <th>Information</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>AC123</td>
            <td>Et netus et malesuada fames ac turpis egestas.</td>
            <td>4000</td>
        </tr>
        <tr>
            <td>MN648</td>
            <td>Etiam tempor orci eu lobortis elementum nibh.</td>
            <td>5500</td>
        </tr>
        <tr>
            <td>PQ451</td>
            <td>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
            <td>2200</td>
        </tr>
    </table>

</div>
