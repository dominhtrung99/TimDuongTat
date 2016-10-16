<?php
/*Template Name: Sai Gon road Page*/
get_header();?>
    <style type="text/css">
        #map-holder {
            height: 500px;
        }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK95EfA-8pms8q8x_3jPOzkDsW1eOdHis&libraries=drawing,geometry"></script>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div id="map-holder"></div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div id="panel">
                <div id="panel-content">
                    <textarea style="width:100%;height:500px" id="geojson-input" placeholder="Drag and drop GeoJSON onto the map or paste it here to begin editing."></textarea>
                </div>
            </div>
        </div>
    </div>

    <script>
        // The Google Map.
        var map;
        var geoJsonInput;

        function init() {
            // Initialise the map.
            map = new google.maps.Map(document.getElementById('map-holder'), {
                center: {
                    lat: 10.7729742,
                    lng: 106.536086
                },
                zoom: 10
            });
            map.data.setControls(['LineString']);
            map.data.setStyle({
                editable: true,
                draggable: true,
                strokeColor: 'red'
            });
            bindDataLayerListeners(map.data);

            var mapContainer = document.getElementById('map-holder');
            geoJsonInput = document.getElementById('geojson-input');

            // Set up events for changing the geoJson input.
            google.maps.event.addDomListener(
                geoJsonInput,
                'input');
        }
        // Refresh different components from other components.
        function refreshGeoJsonFromData() {
            map.data.toGeoJson(function (geoJson) {
                console.log(JSON.stringify(geoJson, null, 2));
                geoJsonInput.value = JSON.stringify(geoJson, null, 2);

            });
        }

        function bindDataLayerListeners(dataLayer) {
            dataLayer.addListener('addfeature', refreshGeoJsonFromData);
            dataLayer.addListener('removefeature', refreshGeoJsonFromData);
            dataLayer.addListener('setgeometry', refreshGeoJsonFromData);
        }

        google.maps.event.addDomListener(window, 'load', init);
    </script>
    <?php get_footer(); ?>