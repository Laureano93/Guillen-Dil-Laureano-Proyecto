<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <title>Escaneo</title>
  <style>

div{

  text-align: center;

}
a{

text-decoration: none;

color: black;

}

button{

  background-color: blanchedalmond;
  width: 200px;
  height: 50px;
}

h1{

text-align: center;

}

  </style>
</head>

<body>

<h1>Leer Codigo QR</h1>

   <div>
   
  <video id="preview"></video>

  </div>

  
  <div>
  <button><a href="./panel.php">Regresar</a></button>

  </div>


  <script>
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview'),
      scanPeriod: 5,
      mirror: false
    });
    scanner.addListener('scan', function(content) {
      window.location.href=content;
    });
    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
        $('[name="options"]').on('change', function() {
          if ($(this).val() == 1) {
            if (cameras[0] != "") {
              scanner.start(cameras[0]);
            } else {
              alert('Camara no funciona!');
            }
          } else if ($(this).val() == 2) {
            if (cameras[1] != "") {
              scanner.start(cameras[1]);
            } else {
              alert('Camara No Funciona!');
            }
          }
        });
      } else {
        console.error('No hay camaras disponibles.');
        alert('No hay camaras disponibles.');
      }
    }).catch(function(e) {
      console.error(e);
      alert(e);
    });
  </script>


</body>


</html>