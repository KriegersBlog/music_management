<!DOCTYPE html>
<html lang="de">
<head>
  <title>Datensätze angelegt!</title>
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
	

	//var_dump($details_genre);
	$meinevariable = $_GET["attribut_uebergabe"];
	
	if($meinevariable!= "track"){
		
		if($meinevariable == "album"){
			$name = $_GET["name"];
			$trackzahl = $_GET["trackzahl"];
			$jahr = $_GET["jahr"]; 
			$abfrage = "insert into Album(Name, Trackzahl, Veröffentlichungsjahr) values('".$name."',".$trackzahl.",".$jahr.");";
			$ergebnis = mysqli_query($link, $abfrage);
		} else if($meinevariable == "genre"){
			$name = $_GET["name"];
			$abfrage = "insert into Genre (Name) values('".$name."');";
			$ergebnis = mysqli_query($link, $abfrage);
			
		} else if($meinevariable == "kuenstler"){
			$name = $_GET["name"];
			$genre = $_GET["genre"];
			$abfrage = "insert into Kuenstler (Name, Genre) values ('".$name."','".$genre."');";
			
		}
		
		$ergebnis = mysqli_query($link, $abfrage);
		
		if($ergebnis){
			echo "Der Datensatz wurde erfolgreich angelegt.";
		} else {
			echo "Fehler, der Datensatz konnte nicht erfolgreich angelegt werden.";
		}
		
	} else {
		$name = $_GET["name"];
		$laenge = $_GET["laenge"];
		$jahr = $_GET["jahr"];
		$genre = $_GET["genre"];
		$album = $_GET["album"];
		$kuenstler = $_GET["kuenstler"];
		
		$counter = 0;
		
		$abfrage = "insert into Track (Name, laenge, veröffentlichungsjahr) values ('".$name."','".$laenge."','".$jahr."');";
		$ergebnis = mysqli_query($link, $abfrage);
		if($ergebnis) $counter++;
		
		$cached_index=mysqli_insert_id($link);
		if($ergebnis) $counter++;
		
		$abfrage = "insert into Genrezuordnung values (".$cached_index.",".$genre.");";
		$ergebnis = mysqli_query($link, $abfrage);
		if($ergebnis) $counter++;
		
		$abfrage = "insert into Trackinterpret values (".$cached_index.",".$kuenstler.");";
		$ergebnis = mysqli_query($link, $abfrage);
		if($ergebnis) $counter++;
		
		$abfrage = "insert into Albumtracks values (".$cached_index.",".$album.");";
		$ergebnis = mysqli_query($link, $abfrage);
		if($ergebnis) $counter++;
		
		if($counter==5){
			echo "Die entsprechenden Datensätze wurden erfolgreich angelegt.";
		} else {
			echo "Fehler! Die Datensätze wurden nicht korrekt angelegt.";
		}
	}
	
	
?>




	
</div>

</body>
</html>
