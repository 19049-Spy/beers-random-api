<?php

// Retrieve data from API
$url = 'https://random-data-api.com/api/v2/beers?size=10';
$data = json_decode(file_get_contents($url), true);

// Sort beers by alcohol percentage in descending order
usort($data, function($a, $b) {
    return $b['abv'] <=> $a['abv'];
});

// Generate HTML table with CSS styling
$table = '<style>
            table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 1em;
            }
            th, td {
                text-align: left;
                padding: 0.5em;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
        </style>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Alcohol Percentage</th>
                </tr>
            </thead>
            <tbody>';

// Generate HTML table
$table = '<table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Alcohol Percentage</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($data as $beer) {
                $table .= '<tr>
                    <td>' . $beer['name'] . '</td>
                    <td>' . $beer['abv'] . '% ABV</td>
                    </tr>';
}

$table .= '</tbody>
        </table>';

// Output HTML table to separate file
$filename = 'beer_table.html';
file_put_contents($filename, $table);

// Display success message
echo 'Beer table generated!';

?>