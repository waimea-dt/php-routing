<h1>Examples of HTTP Requests for CRUD Actions</h1>

<section>

    <article>

        <!-- This could be a generated list of things, e.g. from a database -->

        <table hx-boost="true">

            <tr>
                <td>
                    <a href="/request/post"><button>
                        <strong>C</strong>reate
                    </button></a>
                </td>
                <td>
                    Data records are created using <strong>POST</strong> requests, usually through submitting forms.
                </td>
            </tr>

            <tr>
                <td>
                    <a href="/request/get"><button>
                        <strong>R</strong>ead
                    </button></a>
                </td>
                <td>
                    Data records can be read using <strong>GET</strong> requests, triggered by buttons, links, page loads, etc.
                </td>
            </tr>

            <tr>
                <td>
                    <a href="/request/put"><button>
                        <strong>U</strong>pdate
                    </button></a>
                </td>
                <td>
                    Existing data records are updated using <strong>PUT</strong> requests, usually through submitting forms.
                </td>
            </tr>

            <tr>
                <td>
                    <a href="/request/delete"><button>
                        <strong>D</strong>elete
                    </button></a>
                </td>
                <td>
                    Data records can be deleted using <strong>DELETE</strong> requests, triggered by buttons, links, etc.
                </td>
            </tr>
            
        </table>

    </article>


    <article>
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

    </article>

</section>




