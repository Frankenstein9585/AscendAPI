<?php
function dateToUnixTime() {
    $date = new DateTime(); // Create a DateTime object representing the current date and time
    $date->setTime(0, 0, 0); // Set the time components to midnight (0 hours, 0 minutes, 0 seconds)
    // Get the Unix timestamp

    return $date->getTimestamp(); // Add 3600 seconds (1 hour) to the Unix timestamp
}

function getCurrentYear($timestamp) {
    $date = new DateTime("@$timestamp"); // Create a DateTime object from the Unix timestamp
    // Extract the year component

    return $date->format('Y');
}




function getData()
{
    $timestamp = dateToUnixTime(); // Get the modified Unix timestamp
    // Get the current year
    $currentYear = getCurrentYear($timestamp);
    try {
        // Fetch data from URL
        $response = file_get_contents(sprintf('https://litcal.johnromanodorazio.com/api/v3/LitCalEngine.php?year=%s&epiphany=SUNDAY_JAN2_JAN8&ascension=SUNDAY&corpusChristi=SUNDAY&locale=en_NG&returntype=JSON', $currentYear));
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
$todaysLiturgy = [];
$timestamp = dateToUnixTime(); // Get the modified Unix timestamp
echo $timestamp;
if ($data !== false) {
    $data = $data['LitCal'];
    foreach ($data as $liturgyDay) {
        if ($liturgyDay['date'] == $timestamp) {
            array_push($todaysLiturgy, $liturgyDay);
        }
    }
} else {
    echo "Error fetching data";
}
echo "<pre>";
var_dump($todaysLiturgy);
echo "</pre>";
$color = $todaysLiturgy[0]['color'][0];
$title = $todaysLiturgy[0]['name'];
$date = new DateTime("@$timestamp");
$date = $date->format('Y-m-d');


// echo "<h2>$title</h2>";
// echo "<div style='background: $color'>Vestment Color: $color</div>";