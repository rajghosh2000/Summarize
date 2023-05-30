<?php

require '../api/google-search-results-php/google-search-results.php';
require '../api/google-search-results-php/restclient.php';

$query = [
 "engine" => "google_scholar",
 "q" => "Assessment of the suitability of fog computing in the context of internet of things",
];

$search = new GoogleSearch('8a5bbef9212e41dbcfb43b49f89214809a1851a38e9cc18d47054ba722f838eb');
$result = $search->get_json($query);
$n_res = $result->organic_results;

$res = json_encode(
    array($n_res[0])
);

print_r($res);

