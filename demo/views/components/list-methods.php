<!-- Generate a list of things, e.g. from a database -->

<article>
    <h3>GET requests (e.g. from HTMX)</h3>

    <p>GET requests can be matched to both static and dynamic routes:

    <ul class="routes">
        <li><strong>GET</strong> /<em>product</em>/<strong>$id</strong></li>
        <li><strong>GET</strong> /<em>user</em>/<strong>$id</strong></li>
    </ul> 

    <p>Any variables extracted from the route URL will be available to use, e.g. <code>$id</code>.   
</article>

<article>
    <h3>POST requests (e.g. from forms)</h3>

    <p>POST requests can be matched to both static and dynamic routes:

    <ul class="routes">
        <li><strong>POST</strong> /<em>message</em></li>
        <li><strong>POST</strong> /<em>product</em>/<em>type</em>/<strong>$type</strong></li>
    </ul> 

    <p>Any variables extracted from the route URL will be available to use, e.g. <code>$type</code>.   
    <p>Any data values sent in the POST request will be available via the <code>$_POST</code> global array, e.g. <code>$_POST['name']</code>.   
</article>

<article>
    <h3>PUT requests (e.g. from forms)</h3>

    <p>PUT requests can be matched to both static and dynamic routes:

    <ul class="routes">
        <li><strong>PUT</strong> /<em>product</em>/<strong>$id</strong></li>
        <li><strong>PUT</strong> /<em>user</em>/<strong>$id</strong></li>
    </ul> 

    <p>Any variables extracted from the route URL will be available to use, e.g. <code>$id</code>.   
    <p>Any data values sent in the PUT request will be available via the <code>$_PUT</code> global array, e.g. <code>$_PUT['name']</code>.   
</article>

<article>
    <h3>DELETE requests (e.g. from buttons)</h3>

    <p>DELETE requests can be matched to both static and dynamic routes:

    <ul class="routes">
        <li><strong>DELETE</strong> /<em>product</em>/<strong>$id</strong></li>
        <li><strong>DELETE</strong> /<em>user</em>/<strong>$id</strong></li>
    </ul> 

    <p>Any variables extracted from the route URL will be available to use, e.g. <code>$id</code>.   
</article>