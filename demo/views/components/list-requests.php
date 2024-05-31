<table>

    <tr>
        <td>
            <button hx-get="/request/post" hx-target="#request-result">
                <strong>C</strong>reate
            </button>
        </td>
        <td>
            Data records are created using <strong>POST</strong> requests, usually through submitting forms.
        </td>
    </tr>

    <tr>
        <td>
            <button hx-get="/request/get" hx-target="#request-result">
                <strong>R</strong>ead
            </button>
        </td>
        <td>
            Data records can be read using <strong>GET</strong> requests, triggered by buttons, links, page loads, etc.
        </td>
    </tr>

    <tr>
        <td>
            <button hx-get="/request/put" hx-target="#request-result">
                <strong>U</strong>pdate
            </button>
        </td>
        <td>
            Existing data records are updated using <strong>PUT</strong> requests, usually through submitting forms.
        </td>
    </tr>

    <tr>
        <td>
            <button hx-get="/request/delete" hx-target="#request-result">
                <strong>D</strong>elete
            </button>
        </td>
        <td>
            Data records can be deleted using <strong>DELETE</strong> requests, triggered by buttons, links, etc.
        </td>
    </tr>
    
</table>
