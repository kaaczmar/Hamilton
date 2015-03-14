<!DOCTYPE HTML> 
<html lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Metody Optymalizacji</title>
	<meta name="description" content="Metody Optymalizacji" />
    <meta name="keywords" content="wmetody, optymalizacji, kaczmarek, marcinkowski" />
	<meta name="Author" content="Kaczmar"/>
	<meta name="copyright" content="Copyright (c) Kaczmarek & Marcinkowski"/>

	
	<link rel="stylesheet" type="text/css" href="css/style_css.css">
	
	  
</head> 

<body>
<header>
		<nav>
			<div class="container">
				<div class="wrapper">
					<h1><a href="index.html"><strong>METODY OPTYMALIZACJI</strong></a></h1>
					<ul>
						<li><a href="index.html" class="current">START</a></li>
						<li><a href="index-1.html">METODA HAMILTONA - OPIS</a></li>
						<li><a href="index-2.html">METODA HAMILTONA - IMPLEMENTACJA</a></li>

					</ul>
				</div>
			</div>
		</nav>
		
	</header>
	<div id="kontener">
	
		

	<div id="kontener-start">
		<div id="start-tresc">
		<center>
		PROBLEM PRZYDZIAŁU MIEJSC W PARLEMENCIE METODA HAMILTONA<br><br>
				<?php


						echo"<form action='index-2.php' method='post'>";
						echo"<fieldset>";
						echo"<legend><strong>Podaj ilość stanów biorących udział w losowaniu oraz rozmiar parlamentu</strong></legend>";
						echo "<br>";
						echo" <label for='LICZBA STANÓW'>LICZBA STANÓW:</label><br>";
						echo"<input type='number' id='liczba_stanow' name='liczba_stanow' alt='podaj liczbę stanów'/><br><br>"; 
						echo" <label for='ROZMIAR PARLAMENTU'>ROZMIAR PARLAMENTU:</label><br>";
						echo"<input type='number' id='rozmiar_p' name='rozmiar_p' alt='podaj rozmiar parlamentu'/><br><br>";    		
						echo"<input type='submit' value='Wyślij' id='send1' name='send1' />";
						echo"<br><br>";
						echo"</fieldset>";
						echo"</form>";

				?>
				
				
		</center>
		</div>
	</div>
		
		
		
		<div id="stopka">		
		<div id="stopkaL"><p>Metody Optymalizacji &copy; 2015</p></div>
		<div id="stopkaR"><p><strong>created by Patryk Kaczmarek & Szymon Marcinkowski</strong></div>		
		</div>
	
	
	</div>

</body>
</html>