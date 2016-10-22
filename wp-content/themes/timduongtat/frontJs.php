<script>

jQuery(function($) {
	if($(window).width() >= 768){
		$('#map-holder').height($('.overllay').height() - 57);
	}
});
jQuery(function($) {
    var map;
    var geoData		= 	"";
    var marker		=	"";
    var markers     =   [];
	var line	    =	null;
	var lineInterval	=	null;
    var roadData	=	JSON.parse($('#roadData').text());
    google.maps.event.addDomListener(window, 'load', init);
    
    loadAllData();
    
    $(".close-btn, .back-btn").on( "click", function(e) {
		 closePopup();
    });
	
	$("#all__road").on( "click", function(e) {
		 loadAllData();
    });
	
	$("#geoLocation").on( "click", function(e) {
		 geoLocation();
    });
    
    $(".nav-tabs a").on( "click", function(e) {
        $(".nav-tabs a").removeClass("active");
        $(this).addClass("active");
		 $('html,body').animate({
            scrollTop: $($(this).attr("href")).offset().top
        }, 500);
    });
    
    $(document).on( "click", ".tdt-popup", function(e) {
        e.preventDefault(); // now it'll work

		 if($(window).width() >= 768){
			$('body').css('overflow', 'hidden');
		}
		
		resetMap();		
		
        var id      =   e.target.attributes.getNamedItem('data-id').value;
        history.pushState(null, e.target.textContent, roadData[id].url);
        
		setupMapData(id);
        return false;
    });
    
    $('#search-box-form').on( "submit", function(e) {
    var searchValue  =   $('#tdt-search').val();
    
    if(searchValue != "") {
        var results = [];
        var needle = new RegExp("(.*)" + searchValue.toLowerCase() + "(.*)");
        for(key in roadData) {
            if (needle.test(roadData[key].title.toLowerCase())) {
                var id  =   roadData[key].id;
                results[id] =   roadData[key];
            }             
        }
        
        if(results.length != 0) {
           $('.card-listing').html(loadRoad(results)); 
        } else {        
            $('.card-listing').html('<p><h4><a rel="nofollow" href="contact">Gửi yêu cầu</a> để Tìm Đường Tắt tìm đường cho bạn!</h4><p>'); 
        }
        
    } else {
        alert('Vui lòng nhập từ khóa');
    }
    return false; 
    });
	
	function loadRoad(obj) {
		var list	=	"";
		for (key in obj) {
			list	+=	'<div class="col-md-4 col-sm-6 col-xs-12">';
			list	+=	'<div class="card-widget card-widget">';
			list	+=	'<a data-id="'+ obj[key].url +'" href="#" class="tdt-popup card-image">';
			list	+=	'<img class="tdt-popup" data-id="'+ obj[key].id +'" src="'+ obj[key].image +'" />';
			list	+=	'</a>';
			list	+=	'<div class="card-content">';
			list	+=	'<h3 class="card-title">';
			list	+=	'<a data-id="'+ obj[key].id +'" class="tdt-popup" href="#">'+ obj[key].title +'<span class="listing-claimed-icon"></span></a>';
			list	+=	'</h3>';
			list	+=	'<div class="card-tagline">'+ obj[key].note +'</div>';
			list	+=	'</div>';
			list	+=	'</footer>';
			list	+=	'</div>';
			list	+=	'</div>';
			list	+=	'</div>';
		}
		return list;
	}
	
    function init() {
        // Initialise the map.
        map = new google.maps.Map(document.getElementById('map-holder'), {
            zoom: 16
        });
	
        map.data.setStyle({
            strokeColor: '#3CCE84'
        });
		
		<?php
			if(is_single()) { ?>
				var id      =  <?php echo $post->ID; ?> ;
				setupMapData(id);
		<?php } ?>
    }
	
    function refreshDataFromGeoJson(geoJsonInput) {
        console.log(map.data.getStyle());
      var newData = new google.maps.Data({
        map: map,
        style: map.data.getStyle()
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
        console.log(map);
       if(map.hasOwnProperty("data")){
            map.data.setMap(null);
        }
     
      map.data = newData;
    }
    
	function addMarket(position) {
		marker = new google.maps.Marker({
		  map: map,
		  icon: '<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon-maker.png',
		  animation: google.maps.Animation.DROP,
		  position: position
		});
        markers.push(marker);
	}
	
	function setMapCenterByBound(obj) {
		var bound = new google.maps.LatLngBounds();
		for (i = 0; i < obj.length; i++) {
		  bound.extend( new google.maps.LatLng(obj[i][1], obj[i][0]) );
		}
		map.fitBounds(bound);
	}
	
	function createLikeButton(url) {
		var elem = $(document.createElement("div"));
		elem.attr("class", "fb-like");
		elem.attr("data-href", url);
		elem.attr("data-share", true);
		elem.attr("data-show-faces", true);
		$("#road-info .road-like").empty().append(elem);
		FB.XFBML.parse($("#road-info .road-like").get(0));
	}
	function createComment(url) {
		var elem = $(document.createElement("div"));
		elem.attr("class", "fb-comments");
		elem.attr("data-href", url);
		elem.attr("data-width", 350);
		elem.attr("mobile", true);
		elem.attr("data-numposts", 15);
		$("#road-info .road-comment").empty().append(elem);
		FB.XFBML.parse($("#road-info .road-comment").get(0));
	} 
	function closePopup() {
		$('body').css('overflow', '');
		$('.road-like, .road-comment').hide();
		//history.back();
		history.pushState(null, event.target.textContent, '<?php echo get_site_option('siteurl'); ?>');	
		$(".overllay, .popup-wrapper, .road-map-wrapper").css("visibility", "hidden");
	}
	
	function createTwoArray(obj) {
		var obj1	=	[];
		var obj2	=	[];
		for(var i = 0; i < obj.length; i++) {
			var tmp = {lat: obj[i][1], lng: obj[i][0]};
			if(i < (obj.length - 1)) obj1.push(tmp);
			if(i != 0) obj2.push(tmp);
		}
		
		//console.log(obj2);
		//console.log(obj1);
		
		cal(obj1, obj2);
	}
	
	function createCoordinates(obj){
		var myObj	=	[];
		for(var i = 0; i < obj.length; i++) {
			var tmp = {lat: obj[i][1], lng: obj[i][0]};
			myObj.push(tmp);
		}
		return myObj;
	}
	
	function cal(origins, destinations){
		var service = new google.maps.DistanceMatrixService();
		service.getDistanceMatrix(
		  {
			origins: origins,
			destinations: destinations,
			travelMode: 'DRIVING',
		  }, callback);
	}
	
	function callback(response, status) {
		if(status != 'OVER_QUERY_LIMIT'){
			var destinationAddresses	=	response.destinationAddresses;
			var originAddresses			=	response.originAddresses;
			var rows					=	response.rows;
			
			var routeText	=	"";
			var distance	=	0;
			var duration	=	0;
			var address		=	"";
			
			if(originAddresses.length > 0) {
				var elements	= rows[0].elements;				
				for(var i=0; i< originAddresses.length; i++) {
					routeText	+=	optimizeAdress(originAddresses[i])  + ' &#8594; ';
					if(i == originAddresses.length - 1) {
						routeText	+=	optimizeAdress(destinationAddresses[i]);
					}				
					distance	+=	elements[i].distance.value;
					duration	+=	Math.round(elements[i].duration.value);
				}
			}
			
			$('#road-info .distance').html(distance/1000 + ' km');
			
			var duration	=	Math.floor(duration / 60);
			var hours = Math.floor( duration / 60);      
			var minutes = duration % 60;
			if(hours > 0) duration = hours + ' giờ ' + minutes + ' phút';
			else duration = minutes + ' phút';
			$('#road-info .road-time').html(duration);
			//console.log(routeText);
			$('#road-info .route').html(routeText);
		} else {
			alert('Bạn thao tác quá nhanh!');
		}
	}
	
	function loadAllData(){
		$('.card-listing').html(loadRoad(roadData));    
	}
	
	function geoLocation(){
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
				  lat: position.coords.latitude,
				  lng: position.coords.longitude
				};
				map.panTo(pos);
			});
		} else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}
	
	function resetMap() {
        //reset markers
        if(markers.length > 0) {
            for(var i = 0;i<markers.length; i++) {
               markers[i].setMap(null); 
            }
		}
		//reset line
		if(line !== null) {
            line.setMap(null);
			 clearInterval(lineInterval); 
			 line.set('icons', null);
		}
	}
	
	// Use the DOM setInterval() function to change the offset of the symbol
      // at fixed intervals.
	function animateCircle(line) {
		var count = 0;
		lineInterval	=	window.setInterval(function() {
			count = (count + 1) % 300;

			var icons = line.get('icons');
			icons[0].offset = (count / 2) + '%';
			line.set('icons', icons);
		}, 40);
	}
	
	function setupMapData(id) {
        if(roadData[id] !== undefined && roadData[id].geoJson !==  undefined) {
            var geoJson =   roadData[id].geoJson;
            //setup map
            refreshDataFromGeoJson(geoJson);
            if(geoJson !== null && geoJson.features !== undefined) {
                setMapCenterByBound(geoJson.features[0].geometry.coordinates);
                var coordinates	=	geoJson.features[0].geometry.coordinates;
                createTwoArray(coordinates);

                //create start market and end marker 

                var start		=	{lat: coordinates[0][1], lng: coordinates[0][0]};
                var end			=	{lat: coordinates[coordinates.length - 1][1], lng: coordinates[coordinates.length - 1][0]};
                addMarket(start);
                addMarket(end);
            }

             //setup info
            //$('#road-info .road-time').html(roadData[id].time + " phút");
            if(roadData[id].title !== undefined) $('#road-title').html(roadData[id].title);
            if(roadData[id].note !== undefined)  $('#road-note').html(roadData[id].note);       
            if(roadData[id].warming !== undefined) $('.road-warming').html(roadData[id].warming);
            if(roadData[id].author !== undefined) $('#road-info .road-author').html("Tay lái " + roadData[id].author + ' đóng góp');
            //createLikeButton(roadData[id].url);
            //createComment(roadData[id].url);
            //$('.road-like, .road-comment').show();


             // Define the symbol, using one of the predefined paths ('CIRCLE')
            // supplied by the Google Maps JavaScript API.
            var lineSymbol = {
              path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
              scale: 4,
              strokeColor: '#ED3A3A',
              zIndex: 999
            };

            var myCoordinates 	=	createCoordinates(coordinates);

            line = new google.maps.Polyline({
              path: myCoordinates,
              icons: [{
                icon: lineSymbol,
                offset: '100%'
              }],
              map: map
            });

            animateCircle(line);
            //end CIRCLE

            $(".overllay, .popup-wrapper, .road-map-wrapper").css("visibility", "visible");
        }
	}
});

function optimizeAdress(address){
	var tmp		=	address.split(",");
	address		=	tmp[0];
	return address;
}

</script>