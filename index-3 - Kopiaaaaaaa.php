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
					<h1><a href="index.html"><strong>METODY OPTYMALIZACJI</strong></a></h1>
					<ul>
						<li><a href="index.php" class="current">START</a></li>
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
		</center>
				<?php
				
				$error = "brak";
				
				
				if ( isset($_POST["send"]) ) 
					{		
															
						//ustawienie flagi wczytywania z formularza czy zczytywania z pliku
						$test_plik= htmlspecialchars(trim($_POST['recznie']));
							
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////
						// jeśli "1" wczytywanie z formularza					
						if($test_plik == 1)
							{
							
								//pobranie liczby stanów biorących udział w przydziale
								$ILE= htmlspecialchars(trim($_POST['lstan']));

								//pobranie rozmiaru parlamentu
								$rozmiar_parlamentu= htmlspecialchars(trim($_POST['rozmiar_p']));					

								$populacja_kraju=0; //populacja stanu

								//wczytanie zmiennych ( nazwa stanu, liczba populacji) z formularza
								for($zz=0; $zz<$ILE; $zz++)
									{
										$tablica_nazwa[$zz] = htmlspecialchars(trim($_POST["nazwa_stanu$zz"]));     //nazwy stanów
										$tablica_populacja[$zz] = htmlspecialchars(trim($_POST["populacja$zz"]));   //liczba populacji
										$tablica_stan[$zz] = 0;														//zerowanie tablicy przydziału miejsc
										$tablica_SQ[$zz] = 0;														//tablica kwot standardowych
										$tablica_stan_flaga[$zz] = 0;                                               //ustawienie flag przydziału pozostałych miejsc
										$populacja_kraju = $populacja_kraju + $tablica_populacja[$zz];              //wyliczenie populacji kraju (suma populacji stanów)
										if( $tablica_populacja[$zz] < 1)
											{
												$error = "tak";
												 echo "<p style=\"color:red\">POPULACJA STANU ".($zz+1)." nie może być mniejsza od 1!</p><br>";
											}
									}
									if ($error == "tak") 
									   {
										//echo "<br><p><a href=\"index-2.php\"><input type='button' value='Wstecz' id='powrot' name='powrot'></a></p>";
										
										echo "<form action='index-2.php' method='post' id='contactform'>";
										
																			
												 for ($za=0; $za<$ILE; $za++)
													{	
																						
														echo"<input type='hidden' name='nazwa_stanu$za' value='$tablica_nazwa[$za]'/></td>";		 
														echo"<input type='hidden' name='populacja$za' value='$tablica_populacja[$za]'/></td></tr>";
													}
										
										echo"<br>";
													
										echo"<input type='hidden' name='liczba_stanow' value='$ILE' />";
										echo"<input type='hidden' name='rozmiar_p' value='$rozmiar_parlamentu' />"; 
										echo"<input type='submit' value='Wstecz' id='send' name='send' />";
										echo"</form>";
										
										
										
										
										
										
									   }
								
							
							} //koniec if test plik == 1
							
						//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						//jeśli "0" wczytywanie programu z pliku
						if($test_plik == 2)
							{
							
								$populacja_kraju=0;
								
								$rozmiar_parlamentu= htmlspecialchars(trim($_POST['rozmiar_p']));
								if($rozmiar_parlamentu < 1)
										{
											$error = "tak";
											 echo "<p style=\"color:red\">ROZMIAR PARLAMENTU nie może być mniejszy od 1!</p><br>";
										}
								
								$plik_tmp = $_FILES['plik']['tmp_name'];
								
								$dane=file($plik_tmp);
									
								//echo "dane = $plik_tmp<br>";
								
									$as=0;
									for ($ii=0;$ii<count($dane);$ii++)
										{
											if( $ii == 0) 
												{
													$l_stan=explode(" ",$dane[$ii]);
													$ILE = $l_stan[0];
													
													if($ILE < 1)
													{
														$error = "tak";
														 echo "<p style=\"color:red\">LICZBA STANÓW nie może być mniejsza od 1!</p><br>";
													}
													
												}
											
																							
											if( $ii > 0)
												{

												   $temp=explode(",",$dane[$ii]);
												   for($k=0;$k<count($temp);$k++)
													   {
													   
														$tablica_nazwa[$as] = "STAN ".($as+1)."";  //nazwy stanów
														$tablica_populacja[$as] = $temp[$k];      //liczba populacji
														$tablica_stan[$as] = 0;                  //zerowanie tablicy przydziału miejsc
														$tablica_stan_flaga[$as] = 0;           //ustawienie flag przydziału pozostałych miejsc
														$tablica_SQ[$as] = 0;				   //tablica kwot standardowych
														$populacja_kraju = $populacja_kraju + $tablica_populacja[$as]; //wyliczenie populacji kraju (suma populacji stanów)
														if( $tablica_populacja[$as] < 1)
															{
																$error = "tak";
																 echo "<p style=\"color:red\">POPULACJA STANU ".($as+1)." nie może być mniejsza od 1!</p><br>";
															}
											
													   $as++;
													   }
												}
									   
									   }
									   if ($error == "tak") 
									   {
										echo "<br><p><a href=\"index.php\"><input type='button' value='Wstecz' id='powrot' name='powrot'></a></p>";
									   }
								  
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
					
					$SD = round( ($populacja_kraju/$rozmiar_parlamentu),2);
					echo "SD = $populacja_kraju / $rozmiar_parlamentu<br>";
					echo "<p style=\"color:red\"> <font size=\"5\"> SD = $SD</font></p><br>";
					//////////////////////////////////////////////////////////////////////////////////////////////////
					echo "<font size=\"5\">KROK DRUGI:</font><br>";
					echo "Oblicz kwoty standardowe dla każdego stanu: SQi = populacja stanu i / SD<br><br>";
					
					echo "<table><tr><td>Lp.</td><td>Nazwa stanu</td><td>Kwota Standardowa SQ</td></tr>";
					for($i=0; $i<$ILE; $i++)
						{
							$tablica_SQ[$i] = round(($tablica_populacja[$i]/$SD),2,PHP_ROUND_HALF_UP);
							
							echo"<tr><td><center>".($i+1).".</center></td>";
							echo"<td>$tablica_nazwa[$i]</td>";		 
							echo"<td style=\"color:red\"><font size=\"5\">$tablica_SQ[$i]</font></td></tr>";
								
					

						}
					echo "</table><br>";
					
					//////////////////////////////////////////////////////////////////////////////////////////////////
					echo "<font size=\"5\">KROK TRZECI:</font><br>";
					echo "Początkowo przydziel stanowi jego dolną kwotę [SQi floor]<br><br>";
					
					echo "<table><tr><td>Lp.</td><td>Nazwa stanu</td><td>Kwota Standardowa SQ</td><td>SQ floor</td></tr>";
					$tablica_SQfloor[0]=0;
					for($i=0; $i<$ILE; $i++)
						{
							$tablica_stan[$i] = floor(($tablica_populacja[$i]/$SD));
							$tablica_SQfloor[$i] = $tablica_stan[$i];
							
							echo"<tr><td><center>".($i+1).".</center></td>";
							echo"<td>$tablica_nazwa[$i]</td>";		 
							echo"<td>$tablica_SQ[$i]</td>";
							echo"<td style=\"color:red\"><font size=\"5\">$tablica_stan[$i]</font></td></tr>";				
					

						}
					echo "</table><br>";
					
					//////////////////////////////////////////////////////////////////////////////////////////////////
					echo "<font size=\"5\">KROK CZWARTY:</font><br>";
					echo "Jeśli pozostały nieprzydzielone miejsca to przydziel je kolejno stanom o największej części ułamkowej SQ<br><br>";
					
					//////////////////////////////////////////////////////////////////////////
					// OBLICZENIE ILE MIEJSC PRZYDZIELONO
					$suma = 0; // suma potrzebna do obliczenia ile miejsc przydzielono
					for($i=0; $i<$ILE; $i++)
						{
							$suma= $suma + $tablica_stan[$i];
						}
					echo "<font size=\"4\">Rozmiar parlamentu  : </font><font size=\"5\" color=\"red\">$rozmiar_parlamentu</font><br>";	
					echo "<font size=\"4\">Przydzielolno miejsc: </font><font size=\"5\" color=\"red\">$suma</font><br>";
					$brakuje = $rozmiar_parlamentu - $suma;
					echo "<font size=\"4\">BRAKUJE             : </font><font size=\"5\" color=\"red\">$brakuje</font><br><br>";
					
					
				
				////////////////////////////////////////////////////////////////////////
				/////WYSZUKIWANIE STANU O NAJWIĘKSZEJ CZĘŚCI UŁAMKOWEJ, PRZYDZIELENIE MU MIEJSCA I OZNACZENIE FLAGĄ PRZYDZIELONE
					$max=0; //zmienna pomocnicza
					$stan_ID=0; //zmienna pomocnicza
					//////////////////////////////////////////////////////
					for($i=0; $i<$ILE; $i++)
							{
								$wynik_reszta[$i] =  round( ($tablica_SQ[$i] - $tablica_SQfloor[$i]),2);
							}
					

					for($a=0; $a<$brakuje; $a++)
						{

							for($b=0; $b<$ILE; $b++)
							{
								if ($tablica_stan_flaga[$b] == 0) //jeśli stan nie ma przypisanego juz miejsca to bierzemy go pod uwagę
								{
									
									if( ($a == 0) && ($b == 0)) {$max=$wynik_reszta[$b]; $stan_ID=$b;} //pierwszy stan jako największa reszta
									else
									{
										if ($max < $wynik_reszta[$b]) {$max=$wynik_reszta[$b]; $stan_ID=$b;} //porównywanie reszt kolejnych stanów
									}
									

								}
							}
							$tablica_stan_flaga[$stan_ID]=1; // oznaczamy stan flagą i nie jest już brany pod uwagę w kolejnej iteracji
							$tablica_stan[$stan_ID]=$tablica_stan[$stan_ID]+1; // przypisanie stanowi dodatkowego miejsca
							$max=0;
							
						}
					//wyświetlenie ostatniego kroku algorytmu
					echo "<table><tr><td>Lp.</td><td>Nazwa stanu</td><td>Kwota Standardowa SQ</td><td>SQ floor</td><td>część ułamkowa SQ</td><td>Przydzielone miejsca</td></tr>";
					
						for($i=0; $i<$ILE; $i++)
							{
								$wynik_reszta[$i] = round( ($tablica_SQ[$i] - $tablica_SQfloor[$i]),2);
								
								echo"<tr><td><center>".($i+1).".</center></td>";
								echo"<td>$tablica_nazwa[$i]</td>";		 
								echo"<td>$tablica_SQ[$i]</td>";
								echo"<td>$tablica_SQfloor[$i]</td>";
								echo"<td style=\"color:red\"><font size=\"5\">$wynik_reszta[$i]</font></td>";	
								$przydzielonoM = $tablica_stan[$i] - $tablica_SQfloor[$i];
								echo"<td style=\"color:red\"><font size=\"5\">$przydzielonoM</font></td></tr>";				
						

							}
					echo "</table><br><br>";
					echo "<p><a href=\"#\" id=\"link2\" onclick=\"SchowajAkapit();\">SCHOWAJ SZCZEGÓŁY ALGORYTMU</a></p><br><br>"; //ukrywanie działania algorytmu
				
						
					echo "</div>"; //koniec bloku do schowania
										
///////////////////////////////////////////////////////////////////////
					
					
					////////////////////////////////////////////////
					
					
					echo "<font size=\"5\">Rozmiar parlamentu: $rozmiar_parlamentu</font>";
					echo "<table><tr><td>Lp.</td><td>Nazwa stanu</td><td>Populacja stanu</td><td>Przydzielone miejsca</td></tr>";
					
							 for ($z=0; $z<$ILE; $z++)
								{	
									echo"<tr><td><center><font size=\"5\">".($z+1).".</font></center></td>";
									echo"<td><font size=\"5\">$tablica_nazwa[$z]</font></td>";
									echo"<td style=\"text-align:right\"><font size=\"5\">$tablica_populacja[$z]</font></td>";									
									echo"<td style=\"color:red\"><center><font size=\"5\">$tablica_stan[$z]</font></center></td></tr>";
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
						  for($xx=0; $xx<$ILE; $xx++)
							{
								$sciezka_data=$sciezka_data."['".$tablica_nazwa[$xx]."',".$tablica_stan[$xx]."],";
								
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