
<!--
    Este código foi criado a fim de apresentar algumas funcionalidades da API Google Maps com JavaScript.
    Considera-se que será passado uma matriz com dados como: Status, id, ip e MAC adress.
    Existem diversas formas de organizar e utilizar esses códigos.
    Algumas boas práticas de programação foram suprimidas visto a "simplicidade" e a urgência da demostração apresentada.

    by Luíz Almeida
  -->

  <head>

    <meta charset="utf-8">
    <title>Teste | Google Maps</title>


    <!-- Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- iVega core CSS file -->
    <link href="css/style.css" rel="stylesheet">
  </head>



  <body>

   <header class="header text-center">
    <div class="container">
     <div class="row">
      <div class="col-md-12">
       <div class="site-slogan">
        Teste de Funcionalidades do JS Google API Maps
      </div>
    </div>
  </div>
</div>

</header>
<!-- header end -->


<!-- main start -->
<section class="main">

  <!-- page intro start -->
  <div class="page-intro">

   <!-- google maps start -->

   <body>

    <!-- Mapa -->
    <div id="map" style="height: 500px; width: 100%"></div>

  </div>

  <div class="main-content-wrapper">
   <div class="container">
    <div class="row">

     <section class="main-content col-md-6">
      <h1 class="title">Exemplo</h1>
      <p>Demonstrar algumas funcionalidades do Google API Maps com Javascript. Por favor, verificar anotações no cabeçalho do Source Code
        dessa página. <br>
        <br>
        Funcionalidades apresentadas:<br>
        -Adição de Mapa do Google;<br>
        -Adição de multiplos ícones (Markers);
        -Personalização de Marcadores;<br>
        -Adição de caixa de texto (infoWindow) com informações personalizadas, inclusive links;<br>
      </p>
    </section>


  </div>
</div>
</div>


</section>
<!-- main end -->

</div>
<script src="js/personalisedmaps.js"></script>

<script type="text/javascript">

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

</script>
<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDywNcHjaIu4fA_IiR4LNpT7SBYEKqmciA&callback=initMap"></script>

<!-- Initialization of Plugins -->
<script src="js/personalisedmaps.js"></script>

</body>

</html>