<h2>Create User Record via POST</h2>

<p>This form will submit the data as a POST request...</p>

<article>
    <form
        hx-post="/user"
        hx-trigger="submit"
        hx-target="#request-result"
    >
        <h2>New User</h2>

        <label>Name</label>
        <input name="name" type="text" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <input type="submit" value="Create User">

    </form>
</article>

<p><em>Note: The form submission URL</em>:</p>

<pre><code>hx-post='/user'</code></pre>
