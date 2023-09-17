<?php
// Replace 'YOUR_PAPER_TITLE' with the title of the research paper you want to search for
$paper_title = 'Task Offloading Decision-Making Algorithm for Vehicular Edge Computing: A Deep-Reinforcement-Learning-Based Approach';

// Create the CrossRef API URL
$query = urlencode($paper_title);
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
    foreach ($result->author as $author) {
        $authors[] = array(
            "Author_".++$cnt => $author->given.' '.$author->family
        );
    }
    $monthName = '';
    if(isset($result->published->{'date-parts'}[0][1])){
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
    }else{
        $monthName = null;
    }

    $data = array(
        "Publisher" => $result->publisher,
        "DOI" => $result->DOI,
        "Title" => $result->title[0],
        "PublishedIn" => $result->{'container-title'}[0],
        "PaperURL" => $result->URL,
        "Year" => $result->published->{'date-parts'}[0][0],
        "Month" => $monthName,
        "Authors" => $authors
    );

    echo json_encode($data);
       
} else {
    echo "No results found for the given paper title.";
}
?>
