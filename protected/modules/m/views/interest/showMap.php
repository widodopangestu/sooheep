<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Show Map</title>
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                height: 100%;
            }
            #latlng {
                width: 225px;
            }
        </style>
    </head>
    <body>
        <div id="map"></div>
        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: {lat: -0.8837554, lng: 117.7178024}
                });
                var infowindow = new google.maps.InfoWindow;
                geocodeLatLng(<?php echo $lat; ?>, <?php echo $lng; ?>, map, infowindow);
            }

            function geocodeLatLng(lat, lng, map, infowindow) {
                var geocoder = new google.maps.Geocoder;
                var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
                geocoder.geocode({'location': latlng}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        console.log(results[1].address_components[0].long_name);
                        if (results[1]) {
                            map.setZoom(11);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            infowindow.setContent('<div><strong>' + results[1].address_components[0].long_name + '</strong><br>' + results[1].formatted_address);
                            infowindow.open(map, marker);
                            map.setCenter(latlng);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvuOVVOP0Yzf7h-8v8P5WzkOu1-COX3Fs&callback=initMap">
        </script>
    </body>
</html>