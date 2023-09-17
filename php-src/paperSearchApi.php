<?php

function paperSearchByName($paper_name)
{
    // Create the CrossRef API URL
    $query = urlencode($paper_name);
    $url = "https://api.crossref.org/works?query.title=$query";

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        exit();
    }
    // Close the cURL session
    curl_close($ch);

    $data = json_decode($response);

    // Check if results were found
    if (isset($data->message->items) && count($data->message->items) > 0) {
        // Extract the first result
        $result = ($data->message->items[0]);

        $authors = array();
        $cnt = 0;
        if(isset($result->author)){
            foreach ($result->author as $author) {
                $authors[] = array(
                    "Author_" . ++$cnt => $author->given . ' ' . $author->family
                );
            }
        }else{
            $authors = null;
        }
        $monthName = '';
        if (isset($result->published->{'date-parts'}[0][1])) {
            switch ((int)$result->published->{'date-parts'}[0][1]) {
                case 1:
                    $monthName = 'January';
                    break;
                case 2:
                    $monthName = 'February';
                    break;
                case 3:
                    $monthName = 'March';
                    break;
                case 4:
                    $monthName = 'April';
                    break;
                case 5:
                    $monthName = 'May';
                    break;
                case 6:
                    $monthName = 'June';
                    break;
                case 7:
                    $monthName = 'July';
                    break;
                case 8:
                    $monthName = 'August';
                    break;
                case 9:
                    $monthName = 'September';
                    break;
                case 10:
                    $monthName = 'October';
                    break;
                case 11:
                    $monthName = 'November';
                    break;
                case 12:
                    $monthName = 'December';
                    break;
            }
        } else {
            $monthName = null;
        }

        $data = array(
            "Status" => 1,
            "Publisher" => isset($result->publisher) ? $result->publisher : null,
            "DOI" => isset($result->DOI) ? $result->DOI : null,
            "Title" => isset($result->title[0]) ? $result->title[0] : $paper_name,
            "PublishedIn" => isset($result->{'container-title'}[0]) ? $result->{'container-title'}[0] : null,
            "PaperURL" => isset($result->URL) ? $result->URL : null,
            "Year" => isset($result->published->{'date-parts'}[0][0]) ? ($result->published->{'date-parts'}[0][0]) : null,
            "Month" => $monthName,
            "Authors" => $authors
        );

        return json_encode($data);
    } else {
        $data = array(
            "Status" => 0
        );
        return json_encode($data);
    }
}

function paperSearchByDOI($doi)
{
    // Create the CrossRef API URL
    $query = urlencode($doi);
    $url = "https://api.crossref.org/works/$query";

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        exit();
    }
    // Close the cURL session
    curl_close($ch);

    $data = json_decode($response);

    // Check if results were found
    if (isset($data->message->items) && count($data->message->items) > 0) {
        // Extract the first result
        $result = ($data->message->items[0]);

        $authors = array();
        $cnt = 0;
        if(isset($result->author)){
            foreach ($result->author as $author) {
                $authors[] = array(
                    "Author_" . ++$cnt => $author->given . ' ' . $author->family
                );
            }
        }else{
            $authors = null;
        }
        $monthName = '';
        if (isset($result->published->{'date-parts'}[0][1])) {
            switch ((int)$result->published->{'date-parts'}[0][1]) {
                case 1:
                    $monthName = 'January';
                    break;
                case 2:
                    $monthName = 'February';
                    break;
                case 3:
                    $monthName = 'March';
                    break;
                case 4:
                    $monthName = 'April';
                    break;
                case 5:
                    $monthName = 'May';
                    break;
                case 6:
                    $monthName = 'June';
                    break;
                case 7:
                    $monthName = 'July';
                    break;
                case 8:
                    $monthName = 'August';
                    break;
                case 9:
                    $monthName = 'September';
                    break;
                case 10:
                    $monthName = 'October';
                    break;
                case 11:
                    $monthName = 'November';
                    break;
                case 12:
                    $monthName = 'December';
                    break;
            }
        } else {
            $monthName = null;
        }

        $data = array(
            "Status" => 1,
            "Publisher" => isset($result->publisher) ? $result->publisher : null,
            "DOI" => isset($result->DOI) ? $result->DOI : $doi,
            "Title" => $result->title[0],
            "PublishedIn" => isset($result->{'container-title'}[0]) ? $result->{'container-title'}[0] : null,
            "PaperURL" => isset($result->URL) ? $result->URL : null,
            "Year" => isset($result->published->{'date-parts'}[0][0]) ? ($result->published->{'date-parts'}[0][0]) : null,
            "Month" => $monthName,
            "Authors" => $authors
        );

        return json_encode($data);
    } else {
        $data = array(
            "Status" => 0
        );
        return json_encode($data);
    }
}
