function personalizedIcons(url, size, origin, anchor, scaledSize){
	this.url = url;
	this.size = size;
	this.origin = origin;
	this.anchor = anchor;
	this.scaledSize = scaledSize;

}

function selectImage(type, status){

	var imageRouter = new personalizedIcons('ico/router.ico', markerSize, markerOrigin, markerAnchor, new google.maps.Size(50,50));

	var imageRouterOn = new personalizedIcons('ico/routerOn.png', markerSize, markerOrigin, markerAnchor, new google.maps.Size(35,35));

	var imageServer = new personalizedIcons('ico/server.png', markerSize, markerOrigin, markerAnchor, new google.maps.Size(25,25));

	var imageServerOn = new personalizedIcons('ico/serverOn.png', markerSize, markerOrigin, markerAnchor, new google.maps.Size(25,25));

	if(type=='servidor'){
		if(status == 'on'){
			image = imageServerOn
		}
		else if(status == 'off'){
			image = imageServer
		};
	}
	else if(type=='roteador'){
		if(status == 'on'){
			image = imageRouterOn
		}
		else if(status == 'off'){
			image = imageRouter
		};
	};

	return image;
}

var map;

function initMap(rectangleVisibility) {
	var mapCanvas = document.getElementById('map');
	var mapOptions = {
		zoom: 10,
		center: {lat: -5.8, lng: -35.4}
	};
	var map = new google.maps.Map(mapCanvas, mapOptions);

	setMarkers(map);

	var bounds = {
    north: -5.617,
    south: -5.750,
    east: -35.289,
    west: -35.500
  };

  rectangle = new google.maps.Rectangle({
    bounds: bounds,
    editable: true,
    draggable: true,
    fillColor: '#0000FF',
    strokeColor: '#0000FF',
    strokeOpacity: 0.8,
    fillOpacity: 0.35
  });

  rectangle.setMap(map);

  // Add an event listener on the rectangle.
  rectangle.addListener('click', showNewRect);
  rectangle.addListener('dragend', showNewRect);
}

// Matriz de dados contendo nome, latitude e longitude, id, informações personalizadas

var place = [
['Servidor 1', -5.61712877, -35.28920898, 0, '<h2>Servidor 1</h2><div id="ip1"><p>ip: 192.168.1.1<br>MAC: 20:10:e5:A1<br></div>', 'servidor', 'on', 'null'],
['Roteador 1', -5.81712877, -35.38920898, 1, '<h2>Roteador 1</h2><div id="ip2"><p>ip: 192.168.1.2<br>MAC: 22:50:e5:A2<br></div>', 'roteador', 'off', 'null'],
['Servidor 2', -5.51712877, -35.48920898, 2, '<h2>Servidor 2</h2><div id="ip3"><p>ip: 192.168.1.3<br>MAC: 30:44:e5:B2<br></div>', 'servidor', 'off', 'null'],
['Servidor 3', -5.91712877, -35.58920898, 3, '<h2>Servidor 3</h2><div id="ip4"><p>ip: 192.168.1.4<br>MAC: 77:10:F1:A1<br></div>', 'servidor', 'on', 'null'],
['Roteador 2', -5.81712877, -35.68920898, 4, '<h2>Roteador 2</h2><div id="ip5"><p>ip: 192.168.1.5<br>MAC: 02:30:e1:B3<br></div>', 'roteador', 'on', 'null']
];

var markers = [];
var aux = null;

function setMarkers(map) {

	markerSize = new google.maps.Size(64, 64);
	markerOrigin = new google.maps.Point(0, 0);
	markerAnchor = new google.maps.Point(0, 0);

	var shape = {
		coords: [1, 1, 1, 20, 18, 20, 18, 1],
		type: 'poly'
	};

	var image = null;

	for (var i = 0; i < place.length; i++) {

		var pl = place[i];

		image = selectImage(pl[5], pl[6]);


		var marker = new google.maps.Marker({

			position: {lat: pl[1], lng: pl[2]},
			map: map,
			icon: image,
			shape: shape,
			title: pl[0],
			zIndex: pl[3]
		});



		markers.push(marker);

		var infowindow = new google.maps.InfoWindow()

		content = pl[4];
		google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
			return function() {
				htmlCode = '<div><input type=button value="ligar/desligar dispositivo" onclick="changeDeviceStatus('+marker.zIndex+');"></input></div>';

				for (i = 0; i < place.length; i++) {
					pl = place[i];
					if(pl[3]==marker.zIndex && pl[7] == 'null'){
						content = content + htmlCode;
						place[i][7] = 'clicked';
					}
				}
				infowindow.setContent(content);
				infowindow.open(map,marker);
			};
		})(marker,content,infowindow));

	}
}

function changeDeviceStatus(zIndex, icon){
	var i;
	var device;
	for (i = 0; i < place.length; i++) {
		pl = place[i];
		if(pl[3]==zIndex){
			device = pl[5];
			if(pl[6] == 'on' ){
				place[i][6] = 'off';
				
				break;
			}
			else{
				place[i][6] = 'on';
				break;
			}
		}

	}
	image = selectImage(device, place[i][6]);
	markers[zIndex].setIcon(image);

}

/** @this {google.maps.Rectangle} */
function showNewRect(event) {
  var ne = rectangle.getBounds().getNorthEast();
  var sw = rectangle.getBounds().getSouthWest();

  var contentString = '<b>Rectangle moved.</b><br>' +
      'New north-east corner: ' + ne.lat() + ', ' + ne.lng() + '<br>' +
      'New south-west corner: ' + sw.lat() + ', ' + sw.lng();

      checkInsideDevices(ne.lat(), ne.lng(), sw.lat(), sw.lng());
}


function removeSelector(){
	rectangle.setMap(null);
}

function checkInsideDevices(neLat, neLng, swLat, swLng){
	nameOfdevicesIn = [];
	nameOfdevicesOut = [];

		for (i = 0; i < place.length; i++) {
		pl = place[i];
		if((pl[1]<neLat && pl[1]>swLat) && (pl[2]<neLng && pl[2]>swLng)){
			nameOfdevicesIn.push(pl[0]);
			}
		else{
			nameOfdevicesOut.push(pl[0]);
		}

	}

	if(nameOfdevicesOut.length>=1){
		window.alert("Alerta! Você tem dispositivos fora da área limíte");
	}
	AddTableRow(nameOfdevicesIn, nameOfdevicesOut);

}

(function($) {
  AddTableRow = function(nameOfdevicesIn, nameOfdevicesOut) {

  	$("#tabela tbody").empty();

  	for(i=0; i<nameOfdevicesOut.length; i++){
  	var nameOfdevice = nameOfdevicesOut[i];
  	var newRow = $("<tr>");
    var cols = "";

    cols += '<td>'+nameOfdevice+'</td>';
    cols += '<td>fora da área</td>';
 
    newRow.append('</tr>');
    newRow.append(cols);
    $("#tabela").append(newRow);
	}

	for(i=0; i<nameOfdevicesIn.length; i++){
  	var nameOfdevice = nameOfdevicesIn[i];
  	var newRow = $("<tr>");
    var cols = "";

    cols += '<td>'+nameOfdevice+'</td>';
    cols += '<td>dentro da área</td>';


    newRow.append('</tr>');
    newRow.append(cols);
    $("#tabela").append(newRow);
	}

    

    return false;
  };
})(jQuery);



