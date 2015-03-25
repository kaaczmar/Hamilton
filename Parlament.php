<?php
/**
 * PROBLEM PRZYDZIALU MIEJSC W PARLEMENCIE METODA HAMILTONA
 
 * @author      Patryk Kaczmarek & Szymon Marcinkowski
 * @copyright   Metody Optymalizacji 2015
 * @link        http://www.kaaczmar.pl/hamilton
 * @package		HAMILTON
 */
 
 
 /**
 * Klasa PARLAMENT
 *
 * <p><b>Klasa Parlament zawiera wszystkie metody i zmienne potrzebne do rozwiazania PROBLEMU PRZYDZIALU MIEJSC W PARLAMENCIE METODA HAMILTONA</b></p>.
 */
 class Parlament
 {
				/**
				 * <b>ROZMIAR PARLAMENTU</b>
				 *
				 * <p><b>$rozmiar_parlamentu_c</b> - Zmienna zawierajaca rozmiar parlamentu aktualnie zadanego problemu.</p>
				 * @var number
				 */
	var $rozmiar_parlamentu_c;
	
				/**
				 * <b>LICZBA STANOW</b>
				 *
				 * <p><b>$liczba_stanow_c</b> - Zmienna przechowujaca a liczbe stanow.</p>
				 * @var number
				 */
	public $liczba_stanow_c;
	
				/**
				 * <b>POPULACJA KRAJU</b>
				 *
				 * <p><b>$populacja_kraju_c</b> - zmienna przechowujaca aktualna populacje stanow.</p>
				 * @var number
				 */
	public $populacja_kraju_c;
	
				/**
				 * <b>DZIELNIK STANDARDOWY SD</b>
				 *
				 * <p><b>$SD_c = populacja kraju / rozmiar parlamentu</b> - zmienna wyliczana przez funkcje wyliczajaca Dzielnik Standardowy</p>
				 * @var number
				 */
	public $SD_c;
	
				/**
				 * <b>NAZWY STANOW</b>
				 *
				 * <p><b>$tablica_nazwa[]</b> - zmienna przechowuje nazwe stanu o okreslonym indeksie</p>
				 * @var number
				 */
	public $tablica_nazwa;
	
				/**
				 * <b>POPULACJA STANOW</b>
				 *
				 * <p><b>$tablica_populacja[]</b> - zmienna przechowuje populacje stanu o okreslonym indeksie</p>
				 * @var number
				 */
	public $tablica_populacja;
	
				/**
				 * <b>STAN PRZYDZIALU MIEJSC</b>
				 *
				 * <p><b>$tablica_stan[]</b> - zmienna przechowuje liczbe miejsc przydzielonych stanowi o okreslonym indeksie</p>
				 * @var number
				 */
	public $tablica_stan;
	
				/**
				 * <b>FLAGA CZY PRZYDZIELIC DODATKOWE MIEJSCA</b>
				 *
				 * <p><b>$tablica_stan_flaga[]</b> - zmienna flagowa - przechowuje wartosci "0" lub "1". Potrzebna w funkcji wybierania najwiekszych reszt do przydzialu miejsc METODA HAMILTONA.</p>
				 * @var number
				 */
	public $tablica_stan_flaga;
	
				/**
				 * <b>KWOTY STANDARDOW SQ</b>
				 *
				 * <p><b>$tablica_SQ[]</b> - zmienna przechowuje kwoty standardowe SQ poszczegolnych stanow.</p>
				 * @var number
				 */
	public $tablica_SQ;
	
				/**
				 * <b>KWOTY STANDARDOWE SQ zaokragona w dol - FLLOR()</b>
				 *
				 * <p><b>$tablica_SQfloor[]</b> - zmienna przechowuje zaokraglone kwoty standardowe SQ poszczegolnych stanow.</p>
				 * @var number
				 */
	public $tablica_SQfloor;
	
				/**
				 * <b>RESZTY KWOT STANDARDOWYCH SQ</b>
				 *
				 * <p><b>$tablica_SQfloor[] = $tablica_SQ[] - $tablica_SQfloor[]</b> - zmienna przechowuje reszty kwot SQ poszczegolnych stanow.
				 Tablica przechowuje roznice pomiedzy Kwota standardowa a Kwota standardowa zaokraglona przez funkcje.</p>
				 * @var number
				 */
	public $wynik_reszta;
	
	
	
	
				 /**
				 * <b>OBLICZ DZIELNIK STANDARDOWY<b>
				 *
				 * <p>Obliczanie dzielnika standardowego: <b>SD = populacja kraju / rozmiar parlamentu</b></p>
				 *
				 * @param number $populacja_kraju - suma populacji wszystkich stanow (liczona automatycznie przez program)
				 *
				 * @param number $rozmiar_parlamentu - rozmiar parlamentu liczba wczytywana z pliku lub z formularza
				 */
	function obliczSD($populacja_kraju,$rozmiar_parlamentu)
	{
		$this->SD_c = round( ($populacja_kraju/$rozmiar_parlamentu),2);		
	}
	


				/**					
				 * <b>Funkcja sluzaca do wczytywania instancji problemu</b>:
				 
				 * @param  string $error - zmienna zawierajaca komunikat o błedzie				 
				 * @param  number $test_plik - zmienna decydujaca o tym czy instancja problemu wczytywana jest z pliku czy z formularza				 

				 
				 */	
	function wczytywanie($error,$test_plik,$dane)
 {
																
						
						
						$this->populacja_kraju_c = 0;
							
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////
						// jeśli "1" wczytywanie z formularza					
						if($test_plik == 1)
							{
							
								//pobranie liczby stanów biorących udział w przydziale
								$this->liczba_stanow_c = htmlspecialchars(trim($_POST['lstan']));
								
								
								//pobranie rozmiaru parlamentu
								$this->rozmiar_parlamentu_c = htmlspecialchars(trim($_POST['rozmiar_p']));		

																

								//wczytanie zmiennych ( nazwa stanu, liczba populacji) z formularza
								for($zz=0; $zz < $this->liczba_stanow_c; $zz++)
									{
										$this->tablica_nazwa[$zz] = trim($_POST["nazwa_stanu$zz"]);     //nazwy stanów
										
										$this->tablica_populacja[$zz] = htmlspecialchars(trim($_POST["populacja$zz"]));   //liczba populacji
										$this->tablica_stan[$zz] = 0;														//zerowanie tablicy przydziału miejsc
										$this->tablica_SQ[$zz] = 0;														//tablica kwot standardowych
										$this->tablica_stan_flaga[$zz] = 0;                                               //ustawienie flag przydziału pozostałych miejsc
										$this->populacja_kraju_c = $this->populacja_kraju_c + $this->tablica_populacja[$zz]; //wyliczenie populacji kraju (suma populacji stanów)
										
									}
									
								
							
							} //koniec if test plik == 1
							
						//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						//jeśli "0" wczytywanie programu z pliku
						if($test_plik == 2)
							{
							
								
								
								
								
								
									
								//echo "dane = $plik_tmp<br>";
								
									$as=0;
									for ($ii=0;$ii<count($dane);$ii++)
										{
											if( $ii == 0) 
												{
													//$l_stan=explode(" ",$dane[$ii]);
													$temp = preg_split('/\s+/',$dane[$ii]); //liczba stanów rozmiar parlamentu
													
													$this->rozmiar_parlamentu_c = trim($temp[1]);
													 
													$this->liczba_stanow_c = trim($temp[0]);
													
																										
													if( $this->rozmiar_parlamentu_c < 1) { $error = "tak"; echo "<p style=\"color:red\">ROZMIAR PARLAMENTU nie może być mniejszy od 1!</p><br>";}
													if( $this->liczba_stanow_c < 1)      { $error = "tak"; echo "<p style=\"color:red\">LICZBA STANÓW nie może być mniejsza od 1!</p><br>";}
												
												}
											
																							
											if( $ii > 0)
												{


												  // $temp=explode(" ",$dane[$ii]);
												$temp = preg_split('/\s+/',$dane[$ii]); //wczytywanie stanów z pliku ze spacjami i tabulatorami
																								
												   for($k=0;$k<count($temp);$k++)
													   {
													   
														$this->tablica_nazwa[$as] = "STAN ".($as+1)."";  //nazwy stanów
														
														
														$this->tablica_populacja[$as] = trim($temp[$k]);      //liczba populacji
														
														
														//usuwanie znaku końca lini
														if($this->tablica_populacja[$as] == "")
															{
																$this->tablica_populacja[$as] = "NEW";
																$as--;
																
															}
															else
															{
																$this->tablica_stan[$as] = 0;														//zerowanie tablicy przydziału miejsc
																$this->tablica_SQ[$as] = 0;														//tablica kwot standardowych
																$this->tablica_stan_flaga[$as] = 0;   
																$this->populacja_kraju_c = $this->populacja_kraju_c + $this->tablica_populacja[$as]; //wyliczenie populacji kraju (suma populacji stanów)
															}
															
														if( $this->tablica_populacja[$as] < 1)
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
										echo "<br><p><a href=\"index.php\"><input type='button' value='Wstecz' id='powrot' name='powrot'></a></p></center>";
									   }
								  
							}
	
	
 }
	
				/**
				 * <b>OBLICZ KWOTY STANDARDOWE<b>
				 *
				 * <p>Obliczanie kwot standardowych dla kazdego stanu: <b>SQi = populacja stanu / dzielnik standardowy SD</b></p>
				 *
				 * @param number $populacja - populacja danego stanu)
				 *
				 * @param number $key - klucz/indeks aktualnie wybranego stanu
				 */
	function obliczSQ($populacja,$key)
	{
		$this->tablica_SQ[$key] = round(($populacja/$this->SD_c),2,PHP_ROUND_HALF_UP);
		
	}
	
				/**
				 * <b>OBLICZ ZAOKRAGLENIE KWOTY STANDARDOWEJ -> FLOOR(SQi)<b>
				 *
				 * <p>Zaokraglenie kwot standardowych w dol FLOOR(SQi)</p>
				 *
				 * @param number $key - klucz/indeks aktualnie wybranego stanu
				 */
	function obliczSQ_floor($key)
	{
		$this->tablica_stan[$key] = floor(($this->tablica_populacja[$key]/$this->SD_c));
		$this->tablica_SQfloor[$key] = $this->tablica_stan[$key];
		
	}
	
				/**
				 * <b>PRZYDZIAŁ BRAKUJACYCH MIEJSC<b>
				 *
				 * <p>Zaokraglenie kwot standardowych w dol FLOOR(SQi)</p>
				 *
				 * @param number $brakuje - roznica miejsc miedzy rozmiarem parlamentu
				 */
	function przydziel_brakujace_miejsca($brakuje)
	{
		$max=0; //zmienna pomocnicza
					$stan_ID=0; //zmienna pomocnicza
					//////////////////////////////////////////////////////
					for($i=0; $i< $this->liczba_stanow_c; $i++)
							{
								$this->wynik_reszta[$i] =  round( ($this->tablica_SQ[$i] - $this->tablica_SQfloor[$i]),2);
							}
					

					for($a=0; $a<$brakuje; $a++)
						{

							for($b=0; $b < $this->liczba_stanow_c; $b++)
							{
								if ($this->tablica_stan_flaga[$b] == 0) //jeśli stan nie ma przypisanego juz miejsca to bierzemy go pod uwagę
								{
									
									if( ($a == 0) && ($b == 0)) {$max=$this->wynik_reszta[$b]; $stan_ID=$b;} //pierwszy stan jako największa reszta
									else
									{
										if ($max < $this->wynik_reszta[$b]) {$max=$this->wynik_reszta[$b]; $stan_ID=$b;} //porównywanie reszt kolejnych stanów
									}
									

								}
							}
							$this->tablica_stan_flaga[$stan_ID]=1; // oznaczamy stan flagą i nie jest już brany pod uwagę w kolejnej iteracji
							$this->tablica_stan[$stan_ID]=$this->tablica_stan[$stan_ID]+1; // przypisanie stanowi dodatkowego miejsca
							$max=0;
							
						}
		
	}
	
				/**
				 * <b>OBLICZ BRAKUJACE MIEJSCA<b>
				 *
				 * <p>Oblicza ile miejsc juz przydzielono</p>
				 *
				 * @return number $brakuje - roznica miejsc miedzy rozmiarem parlamentu
				 */
	function brakuje()
	{
		$suma=0;
		for($i=0; $i< $this->liczba_stanow_c ; $i++)
			{
				$suma= $suma + $this->tablica_stan[$i];
			}
			$brakuje = $this->rozmiar_parlamentu_c - $suma;
			
		return $brakuje;
	}
}
