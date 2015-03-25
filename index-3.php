<?php
/**
 * PROBLEM PRZYDZIALU MIEJSC W PARLEMENCIE METODA HAMILTONA
 
 * @author      Patryk Kaczmarek & Szymon Marcinkowski
 * @copyright   Metody Optymalizacji 2015
 * @link        http://www.kaaczmar.pl/hamilton
 * @package		HAMILTON
 */
 
 
require ("Parlament.php");
 
 $parlament = new Parlament;

 ?>

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
		   var  odnosnik = document.getElementById('link');
		   
		   //alert(odnosnik.innerHTML);
		   var	view = akapit.style.display;
		   
		   if (view=="none") {
                akapit.style.display="block";
				odnosnik.innerHTML = "SCHOWAJ SZCZEGÓŁY ALGORYTMU";}
			else {	akapit.style.display="none";
					odnosnik.innerHTML = "POKAŻ SZCZEGÓŁY ALGORYTMU";}
	}
	
	function SchowajAkapit()
	{
	       var 	akapit2 = document.getElementById('more');
		   var  odnosnik2 = document.getElementById('link2');
		   
		   //alert(odnosnik.innerHTML);
		   var	view = akapit2.style.display="none";;
		   
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
						<li><a href="index.php">Wprowadzenie instancji problemu</a></li>
						<li><bb>Uzupełnianie formularza</bb></li>
						<li><bb class="current">Wyniki działania algorytmu</bb></li>

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
		</center>
				<?php
				
				
				
				$error = "brak";
				
				if ( isset($_POST["send"]) ) 
					{		
				//ustawienie flagi wczytywania z formularza czy zczytywania z pliku
				$RODZAJ= htmlspecialchars(trim($_POST['recznie']));
						
				if ($RODZAJ == 1) 
				{
					$parlament->wczytywanie($error,$RODZAJ,0);
				}
				
				if ($RODZAJ == 2) 
				{
					$plik_tmp = $_FILES['plik']['tmp_name'];
					$dane=file($plik_tmp);
					$parlament->wczytywanie($error,$RODZAJ,$dane);
				}
				
				
				
					//////////////////////////////////////////////////////////////////////////////
				
					if ($error == "brak" )
					{
					
					echo "<p><a href=\"#\" id=\"link\" onclick=\"PokazAkapit();\">POKAŻ SZCZEGÓŁY ALGORYTMU</a></p><br>"; //ukrywanie działania algorytmu
					
					echo "<div id='more' style='display:none;'>";//początek bloku do schowania
					
					/////////////////////////////////////////////////////////////////////////////////////////
					////ALGORYTM HAMILTON
					/////////////////////////////////////////////////////////////////////////////////////////
					
					//KROK PIERWSZY
					//Oblicz dzielnik standardowy
					// SD = populacja kraju / rozmiar parlamentu				
					
					echo "<font size=\"5\">KROK PIERWSZY:</font><br>";
					
					echo "Oblicz dzielnik standardowy: SD = populacja kraju / rozmiar parlamentu<br>";
					
					
					
					
					$parlament->obliczSD($parlament->populacja_kraju_c,$parlament->rozmiar_parlamentu_c);	



					
					
					echo "SD = $parlament->populacja_kraju_c / $parlament->rozmiar_parlamentu_c<br>";
					echo "<p style=\"color:red\"> <font size=\"5\"> SD = $parlament->SD_c</font></p><br>";
					
					
					//////////////////////////////////////////////////////////////////////////////////////////////////
					
					
					
					echo "<font size=\"5\">KROK DRUGI:</font><br>";
					echo "Oblicz kwoty standardowe dla każdego stanu: SQi = populacja stanu i / SD<br><br>";
					echo "<table><tr><td style=\"color:white\">Lp.</td><td style=\"color:white\">Nazwa stanu</td><td style=\"color:white\">Kwota Standardowa SQ</td></tr>";
						for($i=0; $i< $parlament->liczba_stanow_c ; $i++)
							{
								$parlament->ObliczSQ($parlament->tablica_populacja[$i],$i);
								
								echo"<tr><td style=\"color:white\"><center>".($i+1).".</center></td>";
								echo"<td style=\"color:white\">".$parlament->tablica_nazwa[$i]."</td>";		 
								echo"<td style=\"color:red\"><font size=\"5\">".$parlament->tablica_SQ[$i]."</font></td></tr>";
									
						

							}
					echo "</table><br>";
					
					
					//////////////////////////////////////////////////////////////////////////////////////////////////
					echo "<font size=\"5\">KROK TRZECI:</font><br>";
					echo "Początkowo przydziel stanowi jego dolną kwotę [SQi floor]<br><br>";
					
					echo "<table><tr style=\"color:white\"><td>Lp.</td><td>Nazwa stanu</td><td>Kwota Standardowa SQ</td><td>SQ floor</td></tr>";
					
					$parlament->tablica_SQfloor[0]=0;
					
					for($i=0; $i<$parlament->liczba_stanow_c; $i++)
						{
														
							$parlament->obliczSQ_floor($i);
							
							echo"<tr><td style=\"color:white\"><center>".($i+1).".</center></td>";
							echo"<td style=\"color:white\">".$parlament->tablica_nazwa[$i]."</td>";		 
							echo"<td style=\"color:white\">".$parlament->tablica_SQ[$i]."</td>";
							echo"<td style=\"color:red\"><font size=\"5\">".$parlament->tablica_stan[$i]."</font></td></tr>";				
					

						}
					echo "</table><br>";
					
					//////////////////////////////////////////////////////////////////////////////////////////////////
					echo "<font size=\"5\">KROK CZWARTY:</font><br>";
					echo "Jeśli pozostały nieprzydzielone miejsca to przydziel je kolejno stanom o największej części ułamkowej SQ<br>";
					
					//////////////////////////////////////////////////////////////////////////
					// OBLICZENIE ILE MIEJSC PRZYDZIELONO
					$brakuje = $parlament->brakuje();
					$suma = $parlament->rozmiar_parlamentu_c - $brakuje;
					
					echo "<font size=\"4\">Rozmiar parlamentu  : </font><font size=\"5\" color=\"red\">$parlament->rozmiar_parlamentu_c</font><br>";
					
					echo "<font size=\"4\">Przydzielolno miejsc: </font><font size=\"5\" color=\"red\">$suma</font><br>";
					
					echo "<font size=\"4\">BRAKUJE             : </font><font size=\"5\" color=\"red\">$brakuje</font><br><br>";
					
					
				
				////////////////////////////////////////////////////////////////////////
				/////WYSZUKIWANIE STANU O NAJWIĘKSZEJ CZĘŚCI UŁAMKOWEJ, PRZYDZIELENIE MU MIEJSCA I OZNACZENIE FLAGĄ PRZYDZIELONE
					
					$parlament->przydziel_brakujace_miejsca($brakuje);
					
					
					
					//wyświetlenie ostatniego kroku algorytmu
					echo "<table><tr style=\"color:white\"><td>Lp.</td><td>Nazwa stanu</td><td>Kwota Standardowa SQ</td><td>SQ floor</td><td>część ułamkowa SQ</td><td>Przydzielone miejsca</td></tr>";
					
						for($i=0; $i< $parlament->liczba_stanow_c ; $i++)
							{
								$parlament->wynik_reszta[$i] = round( ($parlament->tablica_SQ[$i] - $parlament->tablica_SQfloor[$i]),2);
								
								echo"<tr><td style=\"color:white\"><center>".($i+1).".</center></td>";
								echo"<td style=\"color:white\">".$parlament->tablica_nazwa[$i]."</td>";		 
								echo"<td style=\"color:white\">".$parlament->tablica_SQ[$i]."</td>";
								echo"<td style=\"color:white\">".$parlament->tablica_SQfloor[$i]."</td>";
								echo"<td style=\"color:red\"><font size=\"5\">".$parlament->wynik_reszta[$i]."</font></td>";	
								$przydzielonoM = $parlament->tablica_stan[$i] - $parlament->tablica_SQfloor[$i];
								echo"<td style=\"color:red\"><font size=\"5\">$przydzielonoM</font></td></tr>";				
						

							}
					echo "</table><br><br>";
					echo "<p><a href=\"#\" id=\"link2\" onclick=\"SchowajAkapit();\">SCHOWAJ SZCZEGÓŁY ALGORYTMU</a></p><br><br>"; //ukrywanie działania algorytmu
				
						
					echo "</div>"; //koniec bloku do schowania
										
///////////////////////////////////////////////////////////////////////
					
					
					////////////////////////////////////////////////
					
					
					echo "<font size=\"5\">Rozmiar parlamentu: ".$parlament->rozmiar_parlamentu_c."</font>";
					echo "<table><tr style=\"color:white\"><td>Lp.</td><td>Nazwa stanu</td><td>Populacja stanu</td><td>Przydzielone miejsca</td></tr>";
					
							 for ($z=0; $z<$parlament->liczba_stanow_c; $z++)
								{	
									echo"<tr style=\"color:white\"><td style=\"color:white\"><center><font size=\"5\">".($z+1).".</font></center></td>";
									echo"<td style=\"color:white\"><font size=\"5\">".$parlament->tablica_nazwa[$z]."</font></td>";
									echo"<td style=\"text-align:right\"><font size=\"5\">".$parlament->tablica_populacja[$z]."</font></td>";									
									echo"<td style=\"color:red\"><center><font size=\"5\">".$parlament->tablica_stan[$z]."</font></center></td></tr>";
								}
					echo "</table><br><br>";
					
					
				///////////////////////////////////////////////////////////////////////////////////////////////
				//rysowanie wykresu przy pomocy GOOGLE CHARTS
				?>
				<center>
				<script type="text/javascript" src="https://www.google.com/jsapi"></script>
				<script type="text/javascript">
				  google.load("visualization", "1", {packages:["corechart"]});
				  google.setOnLoadCallback(drawChart);
				  function drawChart() {
					   <?php
						echo "var data = google.visualization.arrayToDataTable([";
						echo " ['Nazwa Stanu', 'Przydział miejsc'],";
						  $sciezka_data="";
						  for($xx=0; $xx<$parlament->liczba_stanow_c; $xx++)
							{
								$sciezka_data=$sciezka_data."['".$parlament->tablica_nazwa[$xx]."',".$parlament->tablica_stan[$xx]."],";
								
							}
						echo $sciezka_data;
					
					   echo" ]);";
						?>
					var options = {
					title: 'Przydział miejsc w parlamencie',
					is3D: true,
					};

					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
					chart.draw(data, options);
					}
					</script>
	 <fieldset>
	 <legend>Wykres przedstawiający procentowy udział każdego stanu</legend>
	 <br>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
	<br>
	</fieldset>	
	<br>
	<br>
	<p id="pow">
	<powrot>
	<a href="index.php"><input type="button" value="START MENU"/></a>
	</powrot>
	</p>
	

				
		</center>
		
		
		<?php
		}
		}
		
						else
						{
							header("Location: index.php");
						}
		?>
		
	
		</div>
	</div>
		
		
		
		<div id="stopka">		
		<div id="stopkaL"><p>Metody Optymalizacji &copy; 2015</p></div>
		<div id="stopkaR"><p><strong>created by Patryk Kaczmarek & Szymon Marcinkowski</strong></div>		
		</div>
	
	
	</div>

</body>
</html>