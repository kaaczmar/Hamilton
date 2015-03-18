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
	<link rel="stylesheet" type="text/css" href="css/form.css">
	
	<script type="text/javascript" language="JavaScript">
function PokazAkapit()
	{
	       var 	akapit = document.getElementById('more');
		 //  var  odnosnik = document.getElementById('link');
		   
		   alert(akapit.innerHTML);
		   /*var	view = akapit.style.display;
		   
		   if (view=="none") {
                akapit.style.display="block";
				odnosnik.innerHTML = " UKRYJ -- INFORMACJA: FORMAT PLIKU -- UKRYJ";}
			else {	akapit.style.display="none";
					odnosnik.innerHTML = "INFORMACJA: FORMAT PLIKU";} */
	}
	

</script>
	
	  
</head> 

<body>
<header>
		<nav>
			<div class="container">
				<div class="wrapper">
					<h1><strong>METODY OPTYMALIZACJI</strong></h1>
					<ul>
						<li><a href="index.php"  class="current">Wprowadzenie instancji problemu</a></li>
						<li><bb>Uzupełnianie formularza</bb></li>
						<li><bb>Wyniki działania algorytmu</bb></li>

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
		Wprowadź dane ręcznie za pomocą formularzy lub wczytaj je z pliku <br><br>
				<?php


						echo"<form action='index-2.php' method='post' id='contactform'>";
						echo"<fieldset>";
						echo"<legend><strong>Podaj ilość stanów biorących udział w losowaniu oraz rozmiar parlamentu</strong></legend>";
						echo "<br>";
						echo" <label>LICZBA STANÓW:</label><br>";
						echo"<input type='number' id='liczba_stanow' name='liczba_stanow' placeholder='liczba stanów' required='required' min='1' autocomplete='off'/><br><br>"; 
						echo" <label>ROZMIAR PARLAMENTU:</label><br>";
						echo"<input type='number' id='rozmiar_p' name='rozmiar_p' placeholder='rozmiar parlamentu' required='required' min='1' autocomplete='off'/><br><br>";    		
						echo"<input type='submit' value='Dalej' id='send1' name='send1' />";
						echo"<br><br>";
						echo"</fieldset>";
						echo"</form>";

				?>
				<br>
				<br>
				
				<form enctype='multipart/form-data' action='index-3.php'  method='post' id='contactform'>
				<fieldset>
				<legend><strong>Wczytaj program z pliku</strong></legend>
				<br>
				
				<?php
				
				echo "<p><a href=\"#\" id=\"link\" onclick=\"PokazAkapit();\">INFORMACJA: FORMAT PLIKU</a></p><br>"; //ukrywanie działania algorytmu
				echo "<div id='more' style='display:none;'>";//początek bloku do schowania
				echo "W pierwszej linii dwie liczby: n oraz h rozdzielone spacją bądź tabulatorem. ";
				echo "Liczba n oznacza liczbę stanów, a h rozmiar parlamentu. ";
				echo "W drugiej linii n liczb rozdzielonych spacjami bądź tabulatorami, oznaczających populacje kolejnych stanów. ";
				echo " Wszystkie liczby całkowite i mieszczące się w 32-bitowym typie bez znaku, zapisane w systemie dziesiętnym.";
					//Separator linii dowolny z trzech sensownych.";
				//echo "<br><br>";
				echo "</div>"; //koniec bloku do schowania
				
				?>
					
				<input type="file" name="plik" id="plik" required='required' accept=".txt" />
				<br><br>
				<input type='hidden' name="recznie" value="2" />
				<input type='submit' value='Wczytaj plik' id='send' name='send' />
				<br>
				<br>
				</fieldset>
				</form>
								
				
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