<html>

<head>
    <title>Street View split-map-panes</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map,
        #pano {
            float: left;
            height: 100%;
            width: 50%;
        }
    </style>
    <script type="module">
        function initialize() {
            const fenway = {
                lat: 42.345573,
                lng: -71.098326
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                center: fenway,
                zoom: 14,
            });
            const panorama = new google.maps.StreetViewPanorama(
                document.getElementById("pano"), {
                    position: fenway,
                    pov: {
                        heading: 34,
                        pitch: 10,
                    },
                }
            );

            map.setStreetView(panorama);
        }

        window.initialize = initialize;
    </script>
</head>

<body>
    <div id="map"></div>
    <div id="pano"></div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initialize&v=weekly" defer></script>
</body>

</html>