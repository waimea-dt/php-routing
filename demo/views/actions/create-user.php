<h2>POST Request Received!</h2>

<h4>Actions Required...</h4>

<ol>
    <li>User data is in <strong>$_POST</strong></li>
    <li>Use data in <strong>MySQL INSERT</strong> query</li>
    <li>Let user know it was successful</li>
</ol>

<h4>Example...</h4>

<ol>
    <li>
        <p>Data in <strong>$_POST</strong>:</p>

        <pre><code><?php print_r($_POST); ?></code></pre>
    </li>

    <li>
        <p>Run MySQL query:</p>

        <pre><code>INSERT INTO USERS (name, desc) 
VALUES (?, ?)</code></pre>
    </li>

    <li>
        <p>Feedback:</p>

        <article>
            <p>User record for <?= $_POST['name'] ?> created successfully!</p>
        </article>
    </li>
</ol>



