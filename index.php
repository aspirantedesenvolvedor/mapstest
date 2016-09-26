
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


    <div class="main-content-wrapper">
     <div class="container">
      <div class="row">
        <section class="main-content col-sm-6">
                <h3>Tabela de dispositivos</h3>
                <table id="tabela" class="table" style="width:100%">
                  <thead>
                     <th>Dispositivo</th>
                     <th>Localização</th>
                  </thead>
                  <tbody>

                 </tbody>
                 <tfoot>

                 </tfoot>
               </table>
             </section>
      </div>
      <div class="row">
               <section class="main-content col-md-8">
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
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script src="js/personalisedmaps.js"></script>

<script type="text/javascript">

</script>
<script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDywNcHjaIu4fA_IiR4LNpT7SBYEKqmciA&callback=initMap"></script>

<!-- Initialization of Plugins -->
<script src="js/personalisedmaps.js"></script>

</body>

</html>