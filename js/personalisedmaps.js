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

function initMap() {
	var mapCanvas = document.getElementById('map');
	var mapOptions = {
		zoom: 10,
		center: {lat: -5.8, lng: -35.4}
	};
	var map = new google.maps.Map(mapCanvas, mapOptions);

	setMarkers(map);
}

// Matriz de dados contendo nome, latitude e longitude, id, informações personalizadas

var place = [
['Servidor 1', -5.61712877, -35.28920898, 0, '<div id="ip1"><p>ip: 192.168.1.1<br>MAC: 20:10:e5:A1<br>Clique <a href="index.php">aqui</a> para editar</p></div>', 'servidor', 'on', 'null'],
['Roteador 1', -5.81712877, -35.38920898, 1, '<div id="ip2"><p>ip: 192.168.1.2<br>MAC: 22:50:e5:A2<br>Clique <a href="index.php">aqui</a> para editar</p></div>', 'roteador', 'off', 'null'],
['Servidor 2', -5.51712877, -35.48920898, 2, '<div id="ip3"><p>ip: 192.168.1.3<br>MAC: 30:44:e5:B2<br>Clique <a href="index.php">aqui</a> para editar</p></div>', 'servidor', 'off', 'null'],
['Servidor 3', -5.91712877, -35.58920898, 3, '<div id="ip4"><p>ip: 192.168.1.4<br>MAC: 77:10:F1:A1<br>Clique <a href="index.php">aqui</a> para editar</p></div>', 'servidor', 'on', 'null'],
['Roteador 2', -5.81712877, -35.68920898, 4, '<div id="ip5"><p>ip: 192.168.1.5<br>MAC: 02:30:e1:B3<br>Clique <a href="index.php">aqui</a> para editar</p></div>', 'roteador', 'on', 'null']
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
				htmlCode = '<div><input type=button value="teste" onclick="changeDeviceStatus('+marker.zIndex+');"></input></div>';

				for (i = 0; i < place.length; i++) {
					pl = place[i];
					if(pl[3]==marker.zIndex && pl[7] == 'null'){
						content = content + htmlCode;
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
				place[i][7] = 'statusChanged';
				break;
			}
			else{
				place[i][6] = 'on';
				place[i][7] = 'statusChanged';
				break;
			}
		}
		
	}
	image = selectImage(device, place[i][6]);
	markers[zIndex].setIcon(image);
}