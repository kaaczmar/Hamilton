<?php
require"Parlament.php";

class ExampleTest extends PHPUnit_Framework_TestCase {
 
	
	function testobliczSD()
	{
		$obiekt = new Parlament;
		$obiekt->obliczSD(602700,105);
		
		$testSD = $obiekt->SD_c;
		$this->assertEquals(5740, $testSD);
	}
	
	function testobliczSQ()
	{
				
		$obiekt = new Parlament;
		$obiekt->SD_c = 5740;
		
		$obiekt->obliczSQ(105350,0);
		$obiekt->obliczSQ(128500,1);
		$obiekt->obliczSQ(153120,2);
		$obiekt->obliczSQ(98530,3);
		$obiekt->obliczSQ(117200,4);
		
		$testSQ_0 = $obiekt->tablica_SQ[0];
		$testSQ_1 = $obiekt->tablica_SQ[1];
		$testSQ_2 = $obiekt->tablica_SQ[2];
		$testSQ_3 = $obiekt->tablica_SQ[3];
		$testSQ_4 = $obiekt->tablica_SQ[4];
		
		$this->assertEquals(18.35, $testSQ_0);
		$this->assertEquals(22.39, $testSQ_1);
		$this->assertEquals(26.68, $testSQ_2);
		$this->assertEquals(17.17, $testSQ_3);
		$this->assertEquals(20.42, $testSQ_4);
		
	}
	
	function testobliczSQ_floor()
	{
				
		$obiekt = new Parlament;
		$obiekt->SD_c = 5740;
		$obiekt->tablica_populacja[0] = 105350;
		$obiekt->tablica_populacja[1] = 128500;
		$obiekt->tablica_populacja[2] = 153120;
		$obiekt->tablica_populacja[3] = 98530;
		$obiekt->tablica_populacja[4] = 117200;
		
		$obiekt->obliczSQ_floor(0);
		$obiekt->obliczSQ_floor(1);
		$obiekt->obliczSQ_floor(2);
		$obiekt->obliczSQ_floor(3);
		$obiekt->obliczSQ_floor(4);
		
		$testSQ_floor_0 = $obiekt->tablica_SQfloor[0];
		$testSQ_floor_1 = $obiekt->tablica_SQfloor[1];
		$testSQ_floor_2 = $obiekt->tablica_SQfloor[2];
		$testSQ_floor_3 = $obiekt->tablica_SQfloor[3];
		$testSQ_floor_4 = $obiekt->tablica_SQfloor[4];
		
		$this->assertEquals(18, $testSQ_floor_0);
		$this->assertEquals(22, $testSQ_floor_1);
		$this->assertEquals(26, $testSQ_floor_2);
		$this->assertEquals(17, $testSQ_floor_3);
		$this->assertEquals(20, $testSQ_floor_4);
		
	}
	
	function testbrakuje()
	{
		
		$obiekt = new Parlament;
		
		$obiekt->tablica_stan[0] = 18;
		$obiekt->tablica_stan[1] = 22;
		$obiekt->tablica_stan[2] = 26;
		$obiekt->tablica_stan[3] = 17;
		$obiekt->tablica_stan[4] = 20;
		
		$obiekt->rozmiar_parlamentu_c = 105;
		$obiekt->liczba_stanow_c = 5;
		
		$testbrakuje = $obiekt->brakuje();
		
		
		$this->assertEquals(2, $testbrakuje);
	}
	
	
	function testprzydziel_brakujace_miejsca()
	{
		$obiekt = new Parlament;
		
		$obiekt->tablica_stan[0] = 18;
		$obiekt->tablica_stan[1] = 22;
		$obiekt->tablica_stan[2] = 26;
		$obiekt->tablica_stan[3] = 17;
		$obiekt->tablica_stan[4] = 20;
		
		$obiekt->tablica_SQ[0] = 18.35;
		$obiekt->tablica_SQ[1] = 22.39;
		$obiekt->tablica_SQ[2] = 26.68;
		$obiekt->tablica_SQ[3] = 17.17;
		$obiekt->tablica_SQ[4] = 20.42;
		
		$obiekt->tablica_SQfloor[0] = 18;
		$obiekt->tablica_SQfloor[1] = 22;
		$obiekt->tablica_SQfloor[2] = 26;
		$obiekt->tablica_SQfloor[3] = 17;
		$obiekt->tablica_SQfloor[4] = 20;
		
		$obiekt->tablica_stan_flaga[0] = 0;
		$obiekt->tablica_stan_flaga[1] = 0;
		$obiekt->tablica_stan_flaga[2] = 0;
		$obiekt->tablica_stan_flaga[3] = 0;
		$obiekt->tablica_stan_flaga[4] = 0;
		
		$obiekt->rozmiar_parlamentu_c = 105;
		$obiekt->liczba_stanow_c = 5;
		
		$brakuje = 2;
		
		$obiekt->przydziel_brakujace_miejsca($brakuje);
		
		
		$this->assertEquals(18, $obiekt->tablica_stan[0]);
		$this->assertEquals(22, $obiekt->tablica_stan[1]);
		$this->assertEquals(27, $obiekt->tablica_stan[2]);
		$this->assertEquals(17, $obiekt->tablica_stan[3]);
		$this->assertEquals(21, $obiekt->tablica_stan[4]);
		
		
	}
	
	function testwczytywanie()
	{
		$obiekt = new Parlament;
		$error = "brak";
		
		//ustawic sciezke do pliku !!!!
		$dane=file("C:/xampp/htdocs/phpunit_example/tests/program.txt");
		
		$obiekt->wczytywanie($error,2,$dane);		

		

		$this->assertEquals(105350,$obiekt->tablica_populacja[0]);
		$this->assertEquals(128500,$obiekt->tablica_populacja[1]);
		$this->assertEquals(153120,$obiekt->tablica_populacja[2]);
		$this->assertEquals(98530,$obiekt->tablica_populacja[3] );
		$this->assertEquals(117200,$obiekt->tablica_populacja[4]);
		
		$this->assertEquals(105,$obiekt->rozmiar_parlamentu_c);
		$this->assertEquals(5,$obiekt->liczba_stanow_c);
		
	}
	
	
	
	
	
	
	
} 
?>
