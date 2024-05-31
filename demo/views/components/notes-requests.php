<?php 
    // Fake data
    $id = 13;
?>

<h2>Pick an Request Example...</h2>

<p>Pick one of the request types to see how it works.</p>

<p>Note that the requests all use routes that, at first glance, appear to be the same:</p>

<pre><code>hx-post='/user'
hx-get='/user/<?= $id ?>'
hx-put='/user/<?= $id ?>'
hx-delete='/user/<?= $id ?>'</code></pre>

<p>Even though the route URL is the same each time, <code>/user</code>, the routing system differentiates between them using the request method: POST / GET / PUT / DELETE.</p>

