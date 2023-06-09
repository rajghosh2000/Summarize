<?php

require '../api/google-search-results-php/google-search-results.php';
require '../api/google-search-results-php/restclient.php';

$query = [
 "engine" => "google_scholar",
 "q" => "10.1109/GLOBECOM48099.2022.10001379",
];

$search = new GoogleSearch('8a5bbef9212e41dbcfb43b49f89214809a1851a38e9cc18d47054ba722f838eb');
$result = $search->get_json($query);
$n_res = $result->organic_results;

$res = json_encode(
    array($n_res)
);

print_r($res);

// ->organic_results[0]->publication_info->authors