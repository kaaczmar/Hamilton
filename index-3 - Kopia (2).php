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
				
				if ( isset($_POST["send2"]) ) 
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
							$rozmiar_parlamentu= htmlspecialchars(trim($_POST['rozm']));

							

							$populacja_kraju=0; //populacja stanu

							//wczytanie zmiennych ( nazwa stanu, liczba populacji) z formularza
							for($zz=0; $zz<$ILE; $zz++)
								{
									$tablica_nazwa[$zz] = htmlspecialchars(trim($_POST["nazwa_stanu$zz"]));     //nazwy stanów
									$tablica_populacja[$zz] = htmlspecialchars(trim($_POST["populacja$zz"]));   //liczba populacji
									$tablica_stan[$zz] = 0;                                                     //zerowanie tablicy przydziału miejsc
									$tablica_stan_flaga[$zz] = 0;                                               //ustawienie flag przydziału pozostałych miejsc
									$populacja_kraju = $populacja_kraju + $tablica_populacja[$zz];              //wyliczenie populacji kraju (suma populacji stanów)
								}
								
						
						}
					//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//jeśli "0" wczytywanie programu z pliku
					if($test_plik == 2)
						{
						
						$populacja_kraju=0;
						$plik_tmp = $_FILES['plik']['tmp_name'];
						
						
							$dane=file($plik_tmp);
							
							//echo "dane = $plik_tmp<br>";
						
							$as=0;
							for ($ii=0;$ii<count($dane);$ii++){
							
								if( $ii == 0) 
								{
									$l_stan=explode(" ",$dane[$ii]);
									$ILE = $l_stan[0];
									
								}
								if( $ii == 1) 
								{
									$r_par=explode(" ",$dane[$ii]);
									$rozmiar_parlamentu = $r_par[0];
								}
								if( $ii > 1)
								{

								   $temp=explode(",",$dane[$ii]);
								   for($k=0;$k<count($temp);$k++)
								   {
								   
									$tablica_nazwa[$as] = $as;     //nazwy stanów
									$tablica_populacja[$as] = $temp[$k];   //liczba populacji
									$tablica_stan[$as] = 0;                                                     //zerowanie tablicy przydziału miejsc
									$tablica_stan_flaga[$as] = 0;                                               //ustawienie flag przydziału pozostałych miejsc
									$populacja_kraju = $populacja_kraju + $tablica_populacja[$as];              //wyliczenie populacji kraju (suma populacji stanów)
						
								   $as++;
								   }
								}
							   
							   }
							  
						}
					
					//KROK PIERWSZY
					//Oblicz dzielnik standardowy
					// SD = populacja kraju / rozmiar parlamentu

					$SD = round( ($populacja_kraju/$rozmiar_parlamentu),2);
					echo "SD = $SD";


					$suma = 0;



					for($i=0; $i<$ILE; $i++)
					{
					$tmp = round(($tablica_populacja[$i]/$SD),2,PHP_ROUND_HALF_UP);

					$tablica_stan[$i] = floor(($tablica_populacja[$i]/$SD));
					$tmp_dol=$tablica_stan[$i];
					$suma= $suma + $tmp_dol;

					$tmp_n = $tablica_nazwa[$i];
					echo "<br>";
					echo " $tmp_n =  $tmp   kwota dolna: $tmp_dol";
					}

					echo "<br>";
					echo "suma = $suma";
					echo "<br>";
					echo "<br>";
					echo "wielkość parlamentu: $rozmiar_parlamentu";
					echo "<br>";
					$brakuje = $rozmiar_parlamentu - $suma;
					echo "brakuje: $brakuje";
					echo "<br>";
					echo "<br>";

					$max=0;
					$stan_ID=0;

					for($a=0; $a<$brakuje; $a++)
					{

					for($b=0; $b<$ILE; $b++)
					{
					if ($tablica_stan_flaga[$b] == 0)
					{
					$tmp = round(($tablica_populacja[$b]/$SD),2,PHP_ROUND_HALF_UP);
					$reszta = $tmp - $tablica_stan[$b];
					 echo "reszta= $reszta <br>";

					if( ($a == 0) && ($b == 0)) {$max=$reszta; $stan_ID=$b;}
					else
					{

					if ($max < $reszta) {$max=$reszta; $stan_ID=$b;}


					}
					echo "max = $max";
					echo "<br>";
					echo "<br>";

					}
					}
					$tablica_stan_flaga[$stan_ID]=1;
					$tablica_stan[$stan_ID]=$tablica_stan[$stan_ID]+1;
					$max=0;
					echo "kolejna iteracja<br>";

					}
					echo "<br>";
					echo "<br>";


					for($z=0; $z<$ILE; $z++)
					{
					echo "STAN: $tablica_nazwa[$z] <br>";
					echo "PRZYDZIAŁ: $tablica_stan[$z]<br><br>";
					}
				///////////////////////////////////////////////////////////////////////////////////////////////
				//rysowanie wykresu przy pomocy GOOGLE CHARTS
				?>
				
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