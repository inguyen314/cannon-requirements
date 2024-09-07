<?php
require_once('../private/initialize.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');

date_default_timezone_set('America/Chicago');
if (date_default_timezone_get()) {
    //echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
}
if (ini_get('date.timezone')) {
    //echo 'date.timezone: ' . ini_get('date.timezone');
}
$date_mdY =  date('m/d/Y');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('America/Chicago');
    // Collect form data
    $formData = [
        'swpa_scheduled_generation' => htmlspecialchars($_POST['swpa_scheduled_generation']),
        'usace_maximum'            => htmlspecialchars($_POST['usace_maximum']),
        'usace_minimum'            => htmlspecialchars($_POST['usace_minimum']),
        'usace_target'             => htmlspecialchars($_POST['usace_target']),
        'ismodified'               => htmlspecialchars($_POST['ismodified']),
        'datetime'                 => date('Y-m-d H:i:s'), // Add current date and time
    ];

    $date_mdY =  date('m/d/Y');

    // Read existing data from the JSON file
    $jsonFile = 'json/form_data_cannon_requirements_test.json';
    //$jsonFile = 'json/form_data_cannon_requirements_test.json';
    
    $existingData = file_get_contents($jsonFile);

    // Check if the JSON decoding was successful
    $existingArray = json_decode($existingData, true);
    if ($existingArray === null) {
        $existingArray = [];
    }

    // Append new form data to the existing array
    $existingArray[] = $formData;

    // Sort the array based on the 'datetime' field in descending order
    usort($existingArray, function ($a, $b) {
        return strtotime($a['datetime']) - strtotime($b['datetime']);
    });

    // Extract the last entry
    $lastEntry = end($existingArray);

    // Convert the combined data to JSON format
    $jsonData = json_encode($existingArray, JSON_PRETTY_PRINT);

    // Save the updated data to the JSON file
    file_put_contents($jsonFile, $jsonData);

    // Send email with last entry data
    $to = "ivan.h.nguyen@usace.army.mil";
    // $to = "ivan.h.nguyen@usace.army.mil,allen.phillips@usace.army.mil,DLL-CEMVS-WATER-MANAGERS@usace.army.mil,dll-cemvk-blakely-senior-controllers@usace.army.mil,resources@swpa.gov,larry.j.hurt@usace.army.mil,michael.d.tate@usace.army.mil";

    if ($lastEntry['ismodified'] == "off") {
        $subject = "Cannon Requirements" . " " . $date_mdY;
        //$subject = "[Testing] Cannon Requirements" . " " . $date_mdY;
    } else {
        $subject = "Cannon Requirements" . " " . $date_mdY . " [Updated]";
        //$subject = "[Testing] Cannon Requirements" . " " . $date_mdY . " [Updated]";
    }
    // Start output buffering
    ob_start();
    echo "SWPA Scheduled Generation: " . $lastEntry['swpa_scheduled_generation'] . "\n\n";
    echo "USACE Maximum: " . $lastEntry['usace_maximum'] . "\n\n";
    echo "USACE Minimum: " . $lastEntry['usace_minimum'] . "\n\n";
    echo "USACE Target: " . $lastEntry['usace_target'];
    // Get the buffered output and clean the buffer
    $tableHTML = ob_get_clean();

    $message = $tableHTML;

    // Additional headers
    $headers = "From: noreply@mvs.usace.army.mil";

    // Send the email and check if it was sent successfully
    $emailSent = mail($to, $subject, $message, $headers);

    // Output success or failure message
    if ($emailSent) {
        echo 'Form data has been appended to ' . $jsonFile;
        echo "<p>" . "<a href='" . $jsonFile . "' target='_blank'>" . "View Cannon Requirements JSON" . "</a>" . "</p>";
        // Echo out the last entry data
        echo "<h2>Last Entry:</h2>";
        echo "<pre>";
        //print_r($lastEntry);
        echo "<table border='0'>";
        foreach ($lastEntry as $key => $value) {
            echo "<tr>";
            echo "<td>$key: $value</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</pre>";
        echo "Email sent successfully!";
        echo "<pre>" . $to . "</pre>";
    } else {
        echo "Error: Email could not be sent.";
    }
}
?>
<?php db_disconnect($db); ?>