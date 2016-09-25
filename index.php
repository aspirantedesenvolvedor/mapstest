
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
<script type="text/javascript">

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: {lat: -5.8, lng: -35.4}
});

  setMarkers(map);
}

// Matriz de dados contendo nome, latitude e longitude, id, informações personalizadas
var place = [
['Servidor 1', -5.61712877, -35.28920898, 1, '<div id="ip1"><p>ip: 192.168.1.1<br>MAC: 20:10:e5:A1<br>Clique <a href="index.php">aqui</a> para editar</p><button type="button">Teste</button></div>', 'servidor', 'on'],
['Roteador 1', -5.81712877, -35.38920898, 2, '<div id="ip2"><p>ip: 192.168.1.2<br>MAC: 22:50:e5:A2<br>Clique <a href="index.php">aqui</a> para editar</p><button type="button">Teste</button></div>', 'roteador', 'off'],
['Servidor 2', -5.51712877, -35.48920898, 3, '<div id="ip3"><p>ip: 192.168.1.3<br>MAC: 30:44:e5:B2<br>Clique <a href="index.php">aqui</a> para editar</p><button type="button">Teste</button></div>', 'servidor', 'off'],
['Servidor 3', -5.91712877, -35.58920898, 4, '<div id="ip4"><p>ip: 192.168.1.4<br>MAC: 77:10:F1:A1<br>Clique <a href="index.php">aqui</a> para editar</p><button type="button">Teste</button></div>', 'servidor', 'on'],
['Roteador 2', -5.81712877, -35.68920898, 5, '<div id="ip5"><p>ip: 192.168.1.5<br>MAC: 02:30:e1:B3<br>Clique <a href="index.php">aqui</a> para editar</p><button type="button">Teste</button></div>', 'roteador', 'on']
];

function setMarkers(map) {

  var imageRouter = {
    url: 'ico/router.ico',
    size: new google.maps.Size(64, 64),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 0),
    scaledSize: new google.maps.Size(50, 50)
};

var imageRouterOn = {
    url: 'ico/routerOn.png',
    size: new google.maps.Size(64, 64),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 0),
    scaledSize: new google.maps.Size(35, 35)
};

var imageServer = {
    url: 'ico/server.png',
    size: new google.maps.Size(64, 64),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 0),

    scaledSize: new google.maps.Size(25, 25)
};

var imageServerOn = {
    url: 'ico/serverOn.png',
    size: new google.maps.Size(64, 64),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 0),

    scaledSize: new google.maps.Size(25, 25)
};

var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
};

var image = null;

for (var i = 0; i < place.length; i++) {

    var pl = place[i];

    if(pl[5]=='servidor'){
        if(pl[6] == 'on'){
            image = imageServerOn
        }
        else if(pl[6] == 'off'){
            image = imageServer
        };
    }
    else if(pl[5]=='roteador'){
        if(pl[6] == 'on'){
            image = imageRouterOn
        }
        else if(pl[6] == 'off'){
            image = imageRouter
        };
    };

    var marker = new google.maps.Marker({

      position: {lat: pl[1], lng: pl[2]},
      map: map,
      icon: image,
      shape: shape,
      title: pl[0],
      zIndex: pl[3]
  });

    content = pl[4];

    var infowindow = new google.maps.InfoWindow()

    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
        return function() {
            infowindow.setContent(content);
            infowindow.open(map,marker);
        };
    })(marker,content,infowindow));

}
}

</script>
<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDywNcHjaIu4fA_IiR4LNpT7SBYEKqmciA&callback=initMap"></script>

<!-- Initialization of Plugins -->
<script type="text/javascript" src="js/template.js"></script>

</body>

</html>