<!-- This could be any information from the database -->

<h2>Back-End System Status</h2>

<table>
    <tr>
        <th>Server Load</th>
        <td><?= rand(0,100) ?>%</td>
    </tr>
    <tr>
        <th>Network Throughput</th>
        <td><?= rand(0,2000) ?>Mb/s</td>
    </tr>
    <tr>
        <th>Database Load</th>
        <td><?= rand(0,100) ?>%</td>
    </tr>
    <tr>
        <th>Cache Level</th>
        <td><?= rand(0,100) ?>%</td>
    </tr>
    <tr>
        <th>Coffee Temp.</th>
        <td><?= rand(0,1) ? 'COLD' : 'HOT' ?></td>
    </tr>
</table>

