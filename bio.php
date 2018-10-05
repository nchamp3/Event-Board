<!doctype html>

<html>
<head>

  <meta http-equiv="refresh" content="600">

  <?php

  $servername = "";
  $username = "";
  $password = "";
  $dbname = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password,$dbname);

  // Check connection
  if ($conn->connect_error) {
  	die("Connection failed: " . $conn->connect_error);
  }


   ?>

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
  <link rel="stylesheet" href="jquery.tiltShift.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script type="text/javascript"  src="jquery.js"></script>
  <!-- <script src="jquery.tiltShift.js"></script>


  <script>
    jQuery(document).ready(function()
    {
      $('.tiltshift').tiltShift();
    });
  </script> -->

  <!-- <script>
    setInterval(function(){
    		$('#feature div:first-child').fadeOut(2000)
    		 .delay(5000)
    		 .next('div').fadeIn(2000)
    		 .delay(1000)
    		 .end().appendTo('#feature');},
    		 10000);
  </script> -->

  <style = "text/css">

  #picture
  {
    z-index: 1;
    position: fixed;
    overflow: hidden;
    top: 0px;
    left: 0px;
    width:1920px;
    height:1280px;
  }

  .glass
  {
    position: fixed;
    top: 0px;
    width: 40%;
    height:100%;
    z-index: 2;
    overflow: hidden;
  }


  #name
  {
    color: #FFFFFF;
    position: fixed;
    top: 40px;
    max-width: 700px;
    word-wrap: normal;
    font-size: 55px;

  }

  #title
  {
    color: #CCCCCC;
    position: fixed;
    top: 100px;
    max-width: 500px;
    word-wrap: normal;
    font-size: 35px;
  }

  .text
  {
    font-family: 'Roboto', sans-serif;
    z-index: 3;
    position: absolute;
    top: 180px;
    max-width: 600px;
    word-wrap: normal;
    color: #D9D9D9;
    line-height: 25px;
  }

  /*.page
  {
  	margin: auto;
  }
  #feature
  {
  	margin: auto;
  }*/

  </style>
</head>

<body onload="$('#feature div.page:gt(0)').hide();">






  <div id="feature">

    <?php
      $sql = "SELECT * FROM featured WHERE showHide = 'show'";
      $result = $conn->query($sql);

      $pages = $result->num_rows;
      for($i = 1; $i <= $pages; $i++)
      {
        echo "<div class= \"page\">\n";
        // echo "\t\t<div id=\"picture\">";

        $currProf = $result->fetch_assoc();
        $align = "left";

        if($i % 2 == 0)
        {
          echo "<span id=\"picture\"><img style=\"-webkit-transform: scaleX(-1); transform: scaleX(-1);\" src=\"".$currProf["picture"].".jpg\" class=\"tiltshift\" data-position=\"30\" data-blur=\"10\" data-focus=\"25\" data-falloff=\"15\" data-direction=\"x\"></span>";
          // echo "<img src=\"".$currProf["lname"].".jpg\" class=\"tiltshift\" data-position=\"30\" data-blur=\"10\" data-focus=\"25\" data-falloff=\"15\" data-direction=\"x\">";

          $align = "right";
          $opAlign = "left";
        }
        else
        {
          echo "<span id=\"picture\"><img src=\"".$currProf["picture"].".jpg\" class=\"tiltshift\" data-position=\"30\" data-blur=\"10\" data-focus=\"25\" data-falloff=\"15\" data-direction=\"x\"></span>";
          // echo "<img style=\"-webkit-transform: scaleX(-1); transform: scaleX(-1);\" src=\"".$currProf["lname"].".jpg\" class=\"tiltshift\" data-position=\"30\" data-blur=\"10\" data-focus=\"25\" data-falloff=\"15\" data-direction=\"x\">";

          $align = "left";
          $opAlign = "right";
        }
        // echo "</div>\n";

        if($currProf["c1"] == "default")
        {
          $color1 = "rgba(213, 0, 50,0.7)0%";
          $color2 = "rgba(213, 0, 50,0.4)30%";
          $color3 = "rgba(213, 0, 50,0)90%";
        }
        else
        {
          $color1 = "rgba(".$currProf["c1"].",".$currProf["c2"].",".$currProf["c3"].",0.7)0%";
          $color2 = "rgba(".$currProf["c1"].",".$currProf["c2"].",".$currProf["c3"].",0.4)30%";
          $color3 = "rgba(".$currProf["c1"].",".$currProf["c2"].",".$currProf["c3"].",0)90%";

        }


        $glass = "background: -webkit-linear-gradient(".$align.",".$color1.",".$color2.",".$color3."); background: linear-gradient(to ".$opAlign.",".$color1.",".$color2.",".$color3."); ".$align." :0px;";
        if($align == "left")
        {
          echo "\t\t<div class=\"glass\" style=\"".$glass."\"><span class=\"text\" style=\"".$align.":40px\"><span id=\"name\">".$currProf["fname"]." ".$currProf["lname"]."</span><span id=\"title\">".$currProf["title1"]." ".$currProf["title2"]."</span>";
        }
        else
        {
          echo "\t\t<div class=\"glass\" style=\"".$glass."\"><span class=\"text\" style=\"".$align.":50px\"><span id=\"name\">".$currProf["fname"]." ".$currProf["lname"]."</span><span id=\"title\">".$currProf["title1"]." ".$currProf["title2"]."</span>";
        }

        echo $currProf["bio"];
        echo "\n";
        echo "\t\t</span>\n";
        echo "\t</div>\n";
        echo "</div>\n";
      }
    ?>

</div>

</body>
</html>
