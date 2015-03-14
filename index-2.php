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
				
					if ( !empty($_POST['liczba_stanow']) || !empty($_POST['rozmiar_p']) ) 
						{
															
						$sprawdz= htmlspecialchars(trim($_POST['liczba_stanow']));
						$rozmiar= htmlspecialchars(trim($_POST['rozmiar_p']));
						
						

						echo "<form action='index-3.php' method='post' id='contactform'>";
						echo    "<fieldset>";
						echo    "<legend>Informacje o stanach biorących udział w głosowaniu</legend>";
						echo"<br>";
						echo "<table><tr><td>Lp.</td><td>Nazwa stanu</td><td>Populacja stanu</td></tr>";
						
								 for ($zz=0; $zz<$sprawdz; $zz++)
									{	
										echo"<tr><td><center>".($zz+1).".</center></td>";									
										echo"<td><input type='text' id='nazwa_stanu$zz' name='nazwa_stanu$zz' placeholder='nazwa stanu ".($zz+1)."' required='required' autocomplete='off'/></td>";		 
										echo"<td><input type='number' id='populacja$zz' name='populacja$zz' placeholder='populacja stanu ".($zz+1)."' required='required' autocomplete='off'/></td></tr>";
									}
						echo "</table>";
						echo"<br>";
									
						echo"<input type='hidden' name='lstan' value='$sprawdz' />";
						echo"<input type='hidden' name='rozm' value='$rozmiar' />"; 
						echo"<input type='hidden' name='recznie' value='1' />";
						echo"<input type='submit' value='DALEJ' id='send' name='send' />";
						echo"<br><br>";
						echo"</fieldset>";
						echo"</form>";
						
						}
						else
						{
							echo " <br><br> brak danych do wyświetlenia <br><br> ";
						}
					
					

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