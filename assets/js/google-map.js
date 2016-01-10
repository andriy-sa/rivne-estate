var map;

/* get hidden coor */

var coor = JSON.parse($('input[name=coor]').val());

var mapCoordinates = new google.maps.LatLng(coor[0], coor[1]);
var mapCenter = new google.maps.LatLng(coor[0], coor[1]);
var markers = [];
var image = new google.maps.MarkerImage( '9lessons.png', // иконка
    new google.maps.Size(84,56), // размеры иконок
    new google.maps.Point(0,0),
    new google.maps.Point(42,56)
);

    var mapOptions = {
        backgroundColor: "#ffffff", // цвет фона
        zoom: 16, // масштаб
        disableDefaultUI: true,
        draggable: true,
        scrollwheel: true,
        center: mapCenter,
        mapTypeId: google.maps.MapTypeId.ROADMAP,

    };
    map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
//google.maps.event.addDomListener(window, 'load', initialize);
var marker = new google.maps.Marker({
    position: mapCoordinates,
    raiseOnDrag: false,
    map: map,
    draggable: false
});
    markers.push(marker);

map.addListener('click', function(event) {

    position_x = event.latLng.lat();
    position_y = event.latLng.lng();
    marker.setPosition(event.latLng);
    $('input[name=coor]').val('['+position_x+','+position_y+']');
});

