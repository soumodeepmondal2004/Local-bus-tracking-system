<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Tracker</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #map {
            width: 100vw;
            height: 100vh;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
</head>
<body>
    <div id="map"></div>
    <script>
        // Initialize the map
        const map = L.map('map').setView([22.9868, 87.855], 13); // Default to West Bengal

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker
        const marker = L.marker([22.9868, 87.855]).addTo(map);
        marker.bindPopup("You are here.").openPopup();

        // Track user's location
        function onLocationFound(e) {
            const radius = e.accuracy / 2;
            
            // Update marker position
            marker.setLatLng(e.latlng).bindPopup(`You are within ${radius} meters of this point.`).openPopup();

            // Add a circle showing accuracy
            L.circle(e.latlng, radius).addTo(map);
            
            // Center the map on the user's location
            map.setView(e.latlng, 13);
        }

        function onLocationError(e) {
            alert(e.message);
        }

        map.on('locationfound', onLocationFound);
        map.on('locationerror', onLocationError);

        // Request user's location
        map.locate({setView: true, maxZoom: 16});
    </script>
</body>
</html>
