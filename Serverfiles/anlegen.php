<!DOCTYPE html>
<html lang="de">
<head>
  <title>Datensätze anlegen</title>
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
	$abfrage_typ = "select * from Typ;";
	$ergebnis_typ = mysqli_query($link, $abfrage_typ);
	$details_typ = mysqli_fetch_all($ergebnis_typ);
	$fieldinfo_typ = mysqli_fetch_fields($ergebnis_typ);
	
	$abfrage_genre = "select * from Genre;";
	$ergebnis_genre = mysqli_query($link, $abfrage_genre);
	$details_genre = mysqli_fetch_all($ergebnis_genre);
	$fieldinfo_genre = mysqli_fetch_fields($ergebnis_genre);
	
	$abfrage_kuenstler = "select * from Kuenstler;";
	$ergebnis_kuenstler = mysqli_query($link, $abfrage_kuenstler);
	$details_kuenstler = mysqli_fetch_all($ergebnis_kuenstler);
	$fieldinfo_kuenstler = mysqli_fetch_fields($ergebnis_kuenstler);
	
	$abfrage_album = "select * from Album;";
	$ergebnis_album = mysqli_query($link, $abfrage_album);
	$details_album = mysqli_fetch_all($ergebnis_album);
	$fieldinfo_album = mysqli_fetch_fields($ergebnis_album);
	

  $meinevariable = $_GET["attribut"];
	if($meinevariable == "album"){
		echo "
			<div name='form'>
				  <form action='/anlage_ergebnisse.php'>
					<div class='form-group'>
					  <label for='name' class='col-sm-2 col-form-label'>Name des Albums:</label>
					  <input type='text' class='form-control' id='name' placeholder='Namen angeben' name='name'>
					</div>
					
					<div class='form-group'>
					  <label for='trackzahl' class='col-sm-2 col-form-label'>Anzahl der Tracks im Album:</label>
					  <input type='number' class='form-control' id='number' placeholder='Trackanzahl angeben' name='trackzahl'>
					</div>

					<div class='form-group'>
					  <label for='jahr' class='col-sm-2 col-form-label'>Jahr der Veröffentlichung:</label>
					  <input type='number' class='form-control' id='jahr' placeholder='Jahr angeben' name='jahr'>
					</div>
					
					<input type='hidden' id='attribut_uebergabe' name='attribut_uebergabe' value='album'>
					<button type='submit' class='btn btn-default'>Erstellen</button>
				  </form>
			  </div>


";
	}
	else if($meinevariable == "genre"){
				echo "
			<div name='form'>
				  <form action='/anlage_ergebnisse.php'>
					<div class='form-group'>

					  <label for='name' class='col-sm-2 col-form-label'>Name des Genres:</label>
					  <input type='text' class='form-control' id='name' placeholder='Namen angeben' name='name'>
					</div>

					<input type='hidden' id='attribut_uebergabe' name='attribut_uebergabe' value='genre'>
					<button type='submit' class='btn btn-default'>Erstellen</button>
				  </form>
			  </div>


";
	}else if($meinevariable == "kuenstler"){
				echo "
			<div name='form'>
				  <form action='/anlage_ergebnisse.php'>
					<div class='form-group'>

					  <label for='name' class='col-sm-2 col-form-label'>Name des Künstlers:</label>
					  <input type='text' class='form-control' id='name' placeholder='Namen angeben' name='name'>
					</div>

				<label for='test33' class='col-sm-2 col-form-label'>Typ des Künstlers:</label>
				<select class='browser-default custom-select' name='genre'>";
				foreach($details_typ as $typ_bezeichnung){
				echo "<option value='".$typ_bezeichnung[0]."'>".$typ_bezeichnung[1]."</option>";
}  

				echo "</select>
				<input type='hidden' id='attribut_uebergabe' name='attribut_uebergabe' value='kuenstler'>
<button type='submit' class='btn btn-default'>Erstellen</button>
				  </form>
			  </div>


";
	}else if($meinevariable == "track"){
				echo "
			<div name='form'>
				  <form action='/anlage_ergebnisse.php'>
					<div class='form-group'>

					  <label for='name' class='col-sm-2 col-form-label'>Name des Tracks:</label>
					  <input type='text' class='form-control' id='name' placeholder='Namen angeben' name='name'>
					</div>

				<label for='genre' class='col-sm-2 col-form-label'>Genre des Tracks:</label>
				<select class='browser-default custom-select' name='genre'>";
				foreach($details_genre as $genre_bezeichnung){
				echo "<option value='".$genre_bezeichnung[0]."'>".$genre_bezeichnung[1]."</option>";
}  

				echo "</select>



			<label for='kuenstler' class='col-sm-2 col-form-label'>Künstler des Tracks:</label>
			<select class='browser-default custom-select' name='kuenstler'>";
				foreach($details_kuenstler as $kuenstler_bezeichnung){
				echo "<option value='".$kuenstler_bezeichnung[0]."'>".$kuenstler_bezeichnung[1]."</option>";
}  

				echo "</select>

					<div class='form-group'>
					  <label for='jahr' class='col-sm-2 col-form-label'>Jahr der Veröffentlichung:</label>
					  <input type='number' class='form-control' id='jahr' placeholder='Jahr angeben' name='jahr'>
					</div>

					<div class='form-group'>
					  <label for='laenge' class='col-sm-2 col-form-label'>Länge des Tracks:</label>
					  <input type='text' class='form-control' id='laenge' placeholder='Länge angeben' name='laenge'>
					</div>



<label for='album' class='col-sm-2 col-form-label'>Album auswählen:</label>
			<select class='browser-default custom-select' name='album'> ";
				foreach($details_album as $album_bezeichnung){
				echo "<option value='".$album_bezeichnung[0]."'>".$album_bezeichnung[1]."</option>";
}  

				echo "</select>




<input type='hidden' id='attribut_uebergabe' name='attribut_uebergabe' value='track'>
<button type='submit' class='btn btn-default'>Erstellen</button>
				  </form>
			  </div>


";
	}

	
		
		
?>


	
</div>

</body>
</html>
