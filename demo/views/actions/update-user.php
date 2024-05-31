<h2>PUT Request Received!</h2>

<h4>Actions Required...</h4>

<ol>
    <li>User ID is from URL</li>
    <li>User data is in <strong>$_PUT</strong></li>
    <li>Use ID and data in a <strong>MySQL UPDATE</strong> query</li>
    <li>Let user know it was successful</li>
</ol>

<h4>Example...</h4>

<ol>
    <li>
        <p>User ID from URL:</p>

        <pre><code><?= $id ?></code></pre>
    </li>

    <li>
        <p>Data in <strong>$_PUT</strong>:</p>

        <pre><code><?php print_r($_PUT); ?></code></pre>
    </li>

    <li>
        <p>Run MySQL query:</p>

        <pre><code>UPDATE users 
SET name=?, desc=?
WHERE id=?</code></pre>
    </li>

    <li>
        <p>Feedback:</p>

        <article>
            <p>User details for <?= $_PUT['name'] ?> updated successfully!</p>
        </article>
    </li>
</ol>
