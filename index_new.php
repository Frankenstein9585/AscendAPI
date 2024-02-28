<?php


$url = 'https://litcal.johnromanodorazio.com/api/v3/LitCalEngine.php?year=2024&epiphany=SUNDAY_JAN2_JAN8&ascension=SUNDAY&corpusChristi=SUNDAY&locale=en_NG&returntype=JSON';

function getData()
{
    global $url; // Use global variable $url inside the function
    try {
        $response = file_get_contents($url); // Fetch data from URL
        if ($response === false) {
            throw new Exception('Failed to fetch data from URL');
        }
        return json_decode($response, true); // Parse JSON response
    } catch (Exception $e) {
        error_log('Error fetching data: ' . $e->getMessage()); // Log error
        return false; // Return false in case of error
    }
}

$data = getData(); // Call getData() function to fetch data
//$season = '';
//$date = '';
//$color = '';
//$title = '';
// Insert DOM manipulation here (or any other processing)
if ($data !== false) {
    echo "<pre>";
//    $season = $data['season'];
//    $date = $data['date'];
//    $color = $data['celebrations'][0]['colour'];
//    $title = $data['celebrations'][0]['title'];
    var_dump($data['LitCal']);
    echo "</pre>";
} else {
    echo "Error fetching data";
}

echo "<h1>Hello WordPress</h1>";

