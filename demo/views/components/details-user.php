<h2>GET Request Received!</h2>

<h4>Actions Required...</h4>

<ol>
    <li>User ID is from URL</li>
    <li>Use ID in a <strong>MySQL SELECT</strong> query</li>
    <li>Show the retrieved user information</li>
</ol>

<h4>Example...</h4>

<ol>
    <li>
        <p>User ID from URL:</p>

        <pre><code><?= $id ?></code></pre>
    </li>

    <li>
        <p>Run MySQL query:</p>

        <pre><code>SELECT name, desc 
FROM users 
WHERE id=?</code></pre>
    </li>

    <li>
        <p>Show user data:</p>

        <article>
            <table>
                <tr>
                    <th>Name</th>
                    <td>Karen Smith</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                </tr>
            </table>
        </article>
    </li>
</ol>

