<?php
get_header(); ?>
<div class="card-listing">
<?php                      
$args = array(
'post_type' => 'road',
'post_status' =>  'publish',										
'posts_per_page' => 12,
'order' => 'DESC', 	
'orderby' => 'post_date'
); 
query_posts( $args );
while ( have_posts() ) : the_post(); ?>
    <div class="col-md-4">
        <div class="card-widget card-widget">
            <a data-id="<?php echo $post->ID; ?>" href="#" class="tdt-popup card-image">
                <img class="tdt-popup" data-id="<?php echo $post->ID; ?>" src="https://i2.wp.com/pixelgrade.com/demos/listable/wp-content/uploads/2015/10/L_087467.jpg?fit=450%2C337&ssl=1" />
            </a>
            <div class="card-content">
                <h2 class="card-title">
               <a data-id="<?php echo $post->ID; ?>" class="tdt-popup" href="#"><?php the_title() ; ?><span class="listing-claimed-icon"></span></a>
            </h2>
                <div class="card-tagline"><?php echo substrwords(get_the_content(), 60, '...'); ?></div>
                <footer class="card-footer">
                    <div class="rating  card-rating"> <span class="js-average-rating">4.0</span></div>
                    <div class="address  card-address">
                        <div itemprop="streetAddress"> <span class="address-street">Portobello Road</span> <span class="address-street-no">310</span></div></div>
                </footer>
            </div>
        </div>
    </div>
    <?php   endwhile; ?>
</div>
 <div class="overllay">
        <div class="popup-wrapper map">
            <div class="popup-container">
                <div class="button-close-popup" onclick="closePopup()"></div>
                <div class="status-popup"></div>
                <div class="road-map-wrapper">
                    <div class="row">
                        <div class="col-md-7">
                            <div id="map-holder"></div>
                        </div>
                        <div class="col-md-5">
                            abc
                        </div>
                    </div>
                                    
                </div>
            </div>
     </div>
</div>

<script>
$(document).ready(function () {
    var roadData    =   JSON.parse($('#roadData').text());
    console.log(roadData);
   
    // The Google Map.
    var map;
    var geoData = "";

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
            strokeColor: 'red'
        });
        bindDataLayerListeners(map.data);        
    }
    
    function refreshGeoJsonFromData() {
        map.data.toGeoJson(function (geoJson) {
            geoData = JSON.stringify(geoJson, null, 2);
            console.log(geoData);
            showInfoForm();
        });
    }

    function bindDataLayerListeners(dataLayer) {
        dataLayer.addListener('addfeature', refreshGeoJsonFromData);
        dataLayer.addListener('removefeature', refreshGeoJsonFromData);
        dataLayer.addListener('setgeometry', refreshGeoJsonFromData);
    }
    
    function refreshDataFromGeoJson(geoJsonInput) {
      var newData = new google.maps.Data({
        map: map,
        style: map.data.getStyle(),
        controls: ['LineString']
      });
      try {
        var newFeatures = newData.addGeoJson(geoJsonInput);
      } catch (error) {
        newData.setMap(null);
        if (geoJsonInput.value !== "") {
        } else {          
        }
        return;
      }
      // No error means GeoJSON was valid!
      map.data.setMap(null);
      map.data = newData;
      bindDataLayerListeners(newData);
    }
    
    function getFirstPoint(obj){
        if(obj.features[0].geometry.coordinates[0] !== undefined &&  obj.features[0].geometry.coordinates[0] != "") {
            return obj.features[0].geometry.coordinates[0];
        } else {
            return [10.7729742, 106.536086];
        }        
    }

    function openStatusPopup(text) {
        $(".add-road-wrapper").hide();
        $('.status-popup').html(text);
        $(".status").css("visibility", "visible");
    }
    
     $(".tdt-popup").on( "click", function(e) {
        var id      =   e.target.attributes.getNamedItem('data-id').value;
        history.pushState(null, event.target.textContent, roadData[id].url);
        var geoJson =   roadData[id].geoJson;
        
        refreshDataFromGeoJson(geoJson);
        var coordinate  =   getFirstPoint(geoJson);
        var latLng  = new google.maps.LatLng(coordinate[1], coordinate[0]);
        console.log(latLng);
        map.setCenter(latLng);
        $(".overllay, .popup-wrapper, .road-map-wrapper").css("visibility", "visible");
        return false;
    });

    google.maps.event.addDomListener(window, 'load', init);

});
function closePopup() {
    history.back();
    $(".overllay, .popup-wrapper, .status-popup, .road-map-wrapper").css("visibility", "hidden");
}
</script>
<script id="roadData" type="application/json">
<?php echo json_encode(getAllRoad()); ?>
</script>
<?php get_footer(); ?>