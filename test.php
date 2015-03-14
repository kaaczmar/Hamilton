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
				$plik_tmp = $_FILES['plik']['tmp_name']; 
								
					$dane=file($plik_tmp);
				
					$as=1;
					for ($i=0;$i<count($dane);$i++){
					
						if( $i == 0) 
						{
							$l_stan=explode(" ",$dane[$i]);
							echo "liczba stanow = ".$l_stan[0]."";
							echo "<br>";
						}
						if( $i == 1) 
						{
							$r_par=explode(" ",$dane[$i]);
							echo "rozmiar parlamentu = ".$r_par[0]."";
							echo "<br>";
						}
						if( $i > 1)
						{

						   $temp=explode(",",$dane[$i]);
						   for($k=0;$k<count($temp);$k++)
						   {
						   echo "populacja ".$as." = ".$temp[$k]."";
						   echo "<br>";
						   $as++;
						   }
					    }
					   
					   }
					

				?>
				<br>
				<br>
				<form action="" enctype="multipart/form-data" method="post">
				<fieldset>
				<legend><strong>Wczytaj program z pliku</strong></legend>
				<br>
					<div>
						<input type="file" name="plik" id="plik" accept=".txt" />
					</div>
					<br>
				<input type='submit' value='Wyślij' id='send1' name='send1' />
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