<?php
// Replace with your database credentials
require '../backend/functions.php';
require '../backend/db.php';


// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all locations from the database with name information
$sql = "SELECT latitude, longitude, location_nest, id, number_transplanted, turtle_id, new_location, date_transplanted FROM nesting_data";
$result = $connection->query($sql);

$locations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'latitude' => $row["latitude"],
            'longitude' => $row["longitude"],
            'location_nest' => $row["location_nest"],
            'number_transplanted' => $row['number_transplanted'],
            'turtle_id'=> $row['turtle_id'],
            'new_location' => $row['new_location'],
            'date_transplanted'=> $row['date_transplanted']
        ];
    }
} else {
    // Default location if no data is found
    $locations[] = [
        'latitude' => 37.7749,
        'longitude' => -122.4194,
        'location_nest' => 'Default Place'
    ];
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
</head>
<body>

<div id="map" style="height: 500px;"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    // Use the PHP values for latitude, longitude, and place name
    var locations = <?php echo json_encode($locations); ?>;

    // Initialize Leaflet map
    var map = L.map('map').setView([locations[0].latitude, locations[0].longitude], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Add markers to the map for each location
    locations.forEach(function (location) {
        var marker = L.marker([location.latitude, location.longitude]).addTo(map);

        // Set the popup for the marker with place name
        marker.bindPopup(
            `<strong>Nest Location:</strong> ${location.location_nest}<br>` +
            `<strong>Number of Eggs:</strong> ${location.number_transplanted}<br>` +
            `<strong>Turtle ID:</strong> ${location.turtle_id}<br>`+
            `<strong>New Location:</strong> ${location.new_location}<br>`+
            `<strong>Date Transplanted:</strong> ${location.date_transplanted}`
        );

        // Use Leaflet-Geocoder for reverse geocoding
        var geocoder = L.Control.Geocoder.nominatim();
        geocoder.reverse({ latlng: L.latLng(location.latitude, location.longitude) }, map, function (results) {
            // Get the formatted address
            var formattedAddress = results[0].name;
            // Set the popup for the marker
            marker.bindPopup(formattedAddress).openPopup();
        });
    });
</script>

</body>
</html>

