<?php 
    // Fake data
    $id = 13;
    $name='Karen Smith'; 
    $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
?>

<h2>Update User Details via PUT</h2>

<article id="example">
        
    <p>This form will submit the data as a PUT request...</p>

    <article>
        <form
            hx-put="/user/<?= $id ?>"
            hx-trigger="submit"
            hx-target="#example"
        >
            <h2>Update User</h2>

            <label>Name</label>
            <input name="name" type="text" required value="<?= $name ?>">

            <label>Description</label>
            <textarea name="description" required><?= $description ?></textarea>

            <input type="submit" value="Update User">

        </form>
    </article>

    <p><em>Note: The user ID (<?= $id ?>) is sent as a URL parameter...</em></p>

    <pre><code>hx-put='/user/<?= $id ?>'</code></pre>

    <h4>To Create the Form:</h4>

    <ol>
        <li>Using the current user's ID...</li>
        <li>Use a <strong>MySQL SELECT</strong> query to get current data</li>
        <li>Populate the form with the data</li>
        <li>The form PUT request will incldue the ID</li>
    </ol>

</article>
