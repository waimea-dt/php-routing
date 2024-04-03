<form
    id="thing-form"
    hx-post="<?= SITE_BASE ?>/thing/<?= $id ?>"
    hx-swap="outerHTML"
>

    <label>Name</label>
    <input name="name"type="text" value="Thing <?= $id ?>" required>

    <label>Description</label>
    <textarea name="description" rows="10">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Placerat duis ultricies lacus sed turpis tincidunt id aliquet risus. Etiam tempor orci eu lobortis elementum nibh tellus molestie nunc. Et netus et malesuada fames ac turpis egestas. Tellus at urna condimentum mattis pellentesque id nibh tortor.</textarea>

    <label>Image</label>
    <input name="image" type="file" value="thing<?= $id ?>.jpg">

    <input type="submit" value="Update Thing">

</form>

