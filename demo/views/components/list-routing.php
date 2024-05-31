<!-- Generate a list of things, e.g. from a database -->

<article>
    <h3>Simple fixed routes</h3>
    
    <p>A route with a single name:

    <ul class="routes">
        <li>/<em>about</em></li>
        <li>/<em>products</em></li>
    </ul>
</article>  

<article>
    <h3>Fixed routes with multiple names</h3>

    <p>A route with a heirarchy of nested names:

    <ul class="routes">
        <li>/<em>products</em>/<em>hats</em></li>
        <li>/<em>users</em>/<em>staff</em>/<em>maths</em></li>
    </ul> 
</article>   

<article>
    <h3>Dynamic routes using URL parameters</h3>

    <p>Identify URL parameters within the route using <code>$...</code>. These can appear anywhere in the URL:

    <ul class="routes">
        <li>/<em>product</em>/<strong>$id</strong></li>
        <li>/<em>products</em>/<em>type</em>/<strong>$type</strong>/<em>colour</em>/<strong>$colour</strong></li>
        <li>/<em>users</em>/<em>type</em>/<strong>$type</strong></li>
        <li>/<em>users</em>/<em>year</em>/<strong>$year</strong>/<em>gender</em>/<strong>$gender</strong></li>
    </ul> 

    <p>The parameter values will be available via variables matching the parameter names, e.g. <code>$id</code>, <code>$type</code>.   

    <p>The above routes would match these URLs:

    <ul class="routes">
        <li>/<em>product</em>/<strong>345</strong></li>
        <li>/<em>products</em>/<em>type</em>/<strong>hat</strong>/<em>colour</em>/<strong>black</strong></li>
        <li>/<em>products</em>/<em>type</em>/<strong>skirt</strong>/<em>colour</em>/<strong>red</strong></li>
        <li>/<em>users</em>/<em>type</em>/<strong>staff</strong></li>
        <li>/<em>users</em>/<em>type</em>/<strong>student</strong></li>
        <li>/<em>users</em>/<em>year</em>/<strong>13</strong>/<em>gender</em>/<strong>female</strong></li>
    </ul> 
</article>
    
<article>
    <h3>Dynamic routes using URL query strings</h3>

    <p>URL query strings can be used with both static and dynamic routes:

    <ul class="routes">
        <li>/<em>product</em>?<strong>search=cats</strong></li>
        <li>/<em>products</em>/<em>hat</em>?<strong>size=12</strong></li>
        <li>/<em>users</em>?<strong>name=gary</strong></li>
        <li>/<em>users</em>?<strong>name=sally</strong>&<strong>age=19</strong></li>
        <li>/<em>users</em>/<em>year</em>/<strong>$year</strong>?<strong>name=dave</strong></li>
    </ul> 

    <p>The query string values will be available via the <code>$_GET</code> global array, e.g. <code>$_GET['search']</code>.   
    <p>Any variables extracted from the route URL will be available to use, e.g. <code>$id</code>.   
</article>

