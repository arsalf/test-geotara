<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">

  <style>
    html,
    body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      margin: 0;
    }

    #container {
      width: 100%;
      height: 100%;
    }

    #desc-container {
      max-width: 500px;
      max-height: 500px;
      min-width: 200px;
      min-height: 250px;
      background: #fff;
      color: #000;
      border-radius: 3px;
      overflow: auto;
      -webkit-overflow-scrolling: touch;
    }

    #desc-container>iframe {
      border: none;
      width: 100%;
    }

    .title {
      font-size: 1.5em;
      text-align: center;
      padding: 5px;
    }

    .text {
      padding: 0 20px 20px 20px;
    }
  </style>
</head>

<body>
  <script src="three.min.js"></script>
  <script src="panolens.min.js"></script>
  <div id="desc-container" style="display:none">
    <iframe src="https://www.youtube.com/embed/D7icsuamx5E"></iframe>
    <div class="title">China's Forgotten War</div>
    <div class="text">WWII came to the small town of Tai’erzhuang in central China – and it was never the same again. The town was strategically placed, on the north-south transport railway corridor and the ancient Grand Canal, and so was a focus of the Japanese Imperial army as it advanced. Li Jing Shan was only a child when his family fled the fighting. They returned to find their home, and most of the town, in ruins.</div>
  </div>
  <div id="container"></div>


  <script>
    var panorama, viewer, container, infospot, infospot2;

    container = document.querySelector('#container');

    panorama = new PANOLENS.ImagePanorama('gedungh.jpg');


    infospot = new PANOLENS.Infospot();
    infospot.position.set(1000, 100, -2000);
    infospot.addHoverText('Ingfonya Mazeeh');

    infospot2 = new PANOLENS.Infospot();
    infospot2.position.set(1000, 100, 2000);
    infospot2.addHoverElement(document.getElementById('desc-container'), 200);

    myInfospot = new PANOLENS.Infospot();
    myInfospot.position.set(0, 100, -2000);
    myInfospot.addHoverText('Apaan tuch');

    panorama.add(infospot, infospot2, myInfospot);

    viewer = new PANOLENS.Viewer({
      container: container
    });
    viewer.add(panorama);

    // on click, change the panorama
    infospot.addEventListener('click', function() {
      // clear infospot panoram
      panorama.dispose();
      // remove the current panorama
      viewer.remove(panorama);
      // panorama from internet
      panorama = new PANOLENS.ImagePanorama('gedungh1.jpg');
      viewer.add(panorama);
      viewer.setPanorama(panorama);

    });

    myInfospot.addEventListener('click', function(e) {
      this.hide();
      var tweenScale = new TWEEN.Tween(this.parent.scale)
        .to({
          x: 0,
          y: 4,
          z: 4
        }, 500)
        .easing(TWEEN.Easing.Exponential.Out)
        .onUpdate(function(nVal) {
          this.parent.scale.set(nVal.x, nVal.y, nVal.z);
        }.bind(this))
        .onComplete(function(e) {
          // clear infospot panoram
          panorama.dispose();
          // remove the current panorama
          viewer.remove(panorama);
          // panorama from internet
          targetPanorama = new PANOLENS.ImagePanorama('gedungh2.jpg');
          viewer.add(targetPanorama);
          viewer.setPanorama(targetPanorama);
        })
        .start();
    }.bind(myInfospot));

    panorama.addEventListener('leave-complete', function(e) {
      this.scale.set(-1, 1, 1);
    }.bind(imagePanorama));
  </script>


</body>

</html>