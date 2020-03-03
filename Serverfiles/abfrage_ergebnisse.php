<!DOCTYPE html>
<html lang="de">
<head>
  <title>Datensätze abgefragt!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
<!---------------------------------------Bootstrap&Kram--------------------------------------->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.13.0/css/mdb.min.css" rel="stylesheet">

  <!-- JQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.13.0/js/mdb.min.js"></script>

</head>
<body>

<!---------------------------------------NAVBAR--------------------------------------->

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark primary-color">
    <a class="navbar-brand" href="">Musikverwaltung</a>
	
	
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
		
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Abfragen
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="abfragen.php?attribut=album">Alben abfragen</a>
          <a class="dropdown-item" href="abfragen.php?attribut=genre">Genres abfragen</a>
          <a class="dropdown-item" href="abfragen.php?attribut=kuenstler">Künstler abfragen</a>
		  <a class="dropdown-item" href="abfragen.php?attribut=track">Tracks abfragen</a>
        </div>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Anlegen<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="anlegen.php?attribut=album">Album anlegen</a>
          <a class="dropdown-item" href="anlegen.php?attribut=genre">Genre anlegen</a>
          <a class="dropdown-item" href="anlegen.php?attribut=kuenstler">Künstler anlegen</a>
		  <a class="dropdown-item" href="anlegen.php?attribut=track">Track anlegen</a>
        </div>
      </li>
	  
    
      </ul>
    </div>
  </nav>

 
<!---------------------------------------PHP_START--------------------------------------->

<?php

	$link = mysqli_connect("mysql2fdd.netcup.net:3306", "k95631_musik", "test123123", "k95631_musik");
	mysqli_set_charset($link, "utf8");

	$abfrage_genre = "select * from Genre;";
	$abfrage_album = "select * from Album;";
	$abfrage_kuenstler = "select * from Kuenstler;";
	$abfrage_track = "select * from Track;";
	$abfrage_trackinterpret = "select * from Trackinterpret;";

	$ergebnis_genre = mysqli_query($link, $abfrage_genre);
	$ergebnis_album = mysqli_query($link, $abfrage_album);
	$ergebnis_kuenstler = mysqli_query($link, $abfrage_kuenstler);
	$ergebnis_track = mysqli_query($link, $abfrage_track);
	$ergebnis_trackinterpret = mysqli_query($link, $abfrage_trackinterpret);
	

	$details_genre = mysqli_fetch_all($ergebnis_genre);
	$details_album = mysqli_fetch_all($ergebnis_album);
	$details_kuenstler = mysqli_fetch_all($ergebnis_kuenstler);
	$details_track = mysqli_fetch_all($ergebnis_track);
	$details_trackinterpret = mysqli_fetch_all($ergebnis_trackinterpret);

	$fieldinfo_genre = mysqli_fetch_fields($ergebnis_genre);
	$fieldinfo_album = mysqli_fetch_fields($ergebnis_album);
	$fieldinfo_kuenstler = mysqli_fetch_fields($ergebnis_kuenstler);
	$fieldinfo_track = mysqli_fetch_fields($ergebnis_track);
	$fieldinfo_trackinterpret = mysqli_fetch_fields($ergebnis_trackinterpret);

	//var_dump($details_genre);
	$meinevariable = $_GET["attribut_uebergabe"];
	
	if($meinevariable == "album"){
		$name = $_GET["name"];
		$trackzahl = $_GET["trackzahl"];
		$jahr = $_GET["jahr"];
		$abfrage = "select * from Album where Name like '%".$name."%' and Trackzahl like'%".$trackzahl."%' and veröffentlichungsjahr like '".$jahr."%';";
	} else if($meinevariable == "genre"){
		$name = $_GET["name"];
		$abfrage = "select * from Genre where Name like '%".$name."%';";
		$abfrage_ergebnisse = mysqli_query($link, $abfrage);
	} else if($meinevariable == "kuenstler"){
		$name = $_GET["name"];
		$genre = $_GET["genre"];
		$abfrage = "select * from Kuenstler where Name like '%".$name."%' and Genre like'%".$genre."%';";
		$abfrage_ergebnisse = mysqli_query($link, $abfrage);
	} else if($meinevariable == "track"){
		$name = $_GET["name"];
		$laenge = $_GET["laenge"];
		$jahr = $_GET["jahr"];
		$genre = $_GET["genre"];
		$kuenstler = $_GET["kuenstler"];
		$subquery_kuenstler = "Select TrackID from Trackinterpret where KünstlerID like '%".$kuenstler."%'";
		$subquery_genre = "Select TrackID from Genrezuordnung where GenreID like '%".$genre."%'";
		$abfrage = "select * from Track where Track.Name like '%".$name."%' 
			and Track.laenge like'%".$laenge."%' 
			and Track.veröffentlichungsjahr like'%".$jahr."%' 
			and Track.TrackID IN (".$subquery_kuenstler.")
			and Track.TrackID IN (".$subquery_genre.")
			;";
		$abfrage_ergebnisse = mysqli_query($link, $abfrage);
	}

	
	$abfrage_ergebnisse = mysqli_query($link, $abfrage);
	$details_ergebnisse = mysqli_fetch_all($abfrage_ergebnisse);
	
	
	if($meinevariable == "album"){
		echo "<table class='table'>";
		foreach ($fieldinfo_album as $attribute) {
		  echo "<th scope='col'>";
		  print_r($attribute->name);
		  echo "</th>";
		}
		foreach($details_ergebnisse as $rows){
		  echo "<tr>";
		  for($i=0; $i<4; $i++){
			echo "<td>";
			echo $rows[$i];
			echo "</td>";
		  }
		  echo "</tr>";
		}
		echo "</table>";
		
		
	} else if($meinevariable == "genre"){
		echo "<table class='table'>";
		foreach ($fieldinfo_genre as $attribute) {
		  echo "<th scope='col'>";
		  print_r($attribute->name);
		  echo "</th>";
		}
		foreach($details_ergebnisse as $rows){
		  echo "<tr>";
		  for($i=0; $i<2; $i++){
			echo "<td>";
			echo $rows[$i];
			echo "</td>";
		  }
		  echo "</tr>";
		}
		echo "</table>";
	} else if($meinevariable == "kuenstler"){
		echo "<table class='table'>";
		foreach ($fieldinfo_kuenstler as $attribute) {
		  echo "<th scope='col'>";
		  print_r($attribute->name);
		  echo "</th>";
		}
		foreach($details_ergebnisse as $rows){
		  echo "<tr>";
		  for($i=0; $i<3; $i++){
			echo "<td>";
			echo $rows[$i];
			echo "</td>";
		  }
		  echo "</tr>";
		}
	} else if($meinevariable == "track"){
		
		
		echo "<table class='table'>";
		foreach ($fieldinfo_track as $attribute) {
		  echo "<th scope='col'>";
		  print_r($attribute->name);
		  echo "</th>";
		}
		
		  echo "<th scope='col'>";
		  echo "Künstler";
		  echo "</th>";
		  echo "<th scope='col'>";
		  echo "Genre";
		  echo "</th>";
		
		
		foreach($details_ergebnisse as $rows){
		  echo "<tr>";
		  for($i=0; $i<4; $i++){
			echo "<td>";
			echo $rows[$i];
			echo "</td>";
		  }
			$abfrage_TrackID = "select * from Trackinterpret where TrackID='".$rows[0]."';";
			$abfrage_ergebnisse_details = mysqli_query($link, $abfrage_TrackID);
			$details_TrackID_ergebnisse = mysqli_fetch_all($abfrage_ergebnisse_details);
			echo "<td>";
			
			foreach($details_TrackID_ergebnisse as $test){
				$abfrage_KuenstlerID = "select * from Kuenstler where KünstlerID='".$test[1]."';";
			$abfrage_KuenstlerID_details = mysqli_query($link, $abfrage_KuenstlerID);
			$details_KuenstlerID_ergebnisse = mysqli_fetch_all($abfrage_KuenstlerID_details);
			$test1 = $details_KuenstlerID_ergebnisse[0];
			echo $test1[1]."<br>";
			}
		  
			$abfrage_specificX = "select * from Genrezuordnung where TrackID='".$rows[0]."';";
			$abfrage_ergebnisse_specificX = mysqli_query($link, $abfrage_specificX);
			$details_ergebnisse_specificX = mysqli_fetch_all($abfrage_ergebnisse_specificX);
			echo "<td>";
			
			foreach($details_ergebnisse_specificX as $testX){
			$abfrage_specificY = "select * from Genre where GenreID='".$testX[1]."';";
			$abfrage_ergebnisse_specificY = mysqli_query($link, $abfrage_specificY);
			$details_ergebnisse_specificY = mysqli_fetch_all($abfrage_ergebnisse_specificY);
			$testY = $details_ergebnisse_specificY[0];
			echo $testY[1]."<br>"; 
			}
			
		  
		  
		  echo "</tr>";
		}
		
	}
?>




	
</div>

</body>
</html>
