<?php 
    // Fake data
    $id = 13;
?>

<h2>View User Record via GET</h2>

<p>This button will submit a GET request...</p>

<p>
    <button
        hx-get="/user/<?= $id ?>"
        hx-target="#request-result"
    >
        View User Details
    
    </button>
</p>

<p><em>Note: The user ID (<?= $id ?>) is sent as a URL parameter...</em></p>

<pre><code>hx-get='/user/<?= $id ?>'</code></pre>

