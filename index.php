<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Formularz</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="style.css" type="text/css" />	
</head>

<body>
	<div id="container">
		<h1>Formularz</h1>
		<hr>
		<form  action="pdf.php" onsubmit="return validation()" method="post" >			
			<div class="required">*</div>
			<input type="text" id="imie" name="imie" placeholder="Imię" name="imie" maxlength="15" onfocus="this.placeholder=''" onblur="this.placeholder='Imię'" >
			<div class="required">*</div>
			<input type="text" id="nazwisko" name="nazwisko" name="nazwisko" placeholder="Nazwisko" maxlength="15" onfocus="this.placeholder=''" onblur="this.placeholder='Nazwisko'" >
			<input type="text" id="data-urodzenia" name="data-urodzenia" maxlength="10" placeholder="Data urodzenia np. 2001-08-22" onfocus="this.placeholder=''" onblur="this.placeholder='Data urodzenia np. 2001-08-22'" >
			<div class="required">*</div>
			<input type="text" id="pesel" name="pesel" placeholder="PESEL" name="pesel" onfocus="this.placeholder=''" onblur="this.placeholder='PESEL'" >			
			<div id="pesel-error"></div>

			<fieldset>				
				<legend>Płeć:</legend>
				<div class="two-column">
					<div class="single-col">
					<div class="styled-input-single">
						<input type="radio" name="sex" id="male" value="male" />
						<label for="male">Mężczyzna</label>
					</div>
					</div>
					<div class="single-col">
					<div class="styled-input-single">
						<input type="radio" name="sex" id="female" value="female" />
						<label for="female">Kobieta</label>
					</div>
					</div>
				</div>
			</fieldset>	

	
			<fieldset>
				<legend>Języki:</legend>
				<div class="two-column">
				<div class="single-col">
					<div class="styled-input-container styled-input--square">
					<div class="styled-input-single">
						<input type="checkbox" name="language[]" value="polski" id="polski" />
						<label for="polski">Polski</label>
					</div>
					<div class="styled-input-single">
						<input type="checkbox" name="language[]" value="angielski" id="angielski" />
						<label for="angielski">Angielski</label>
					</div>
					<div class="styled-input-single">
						<input type="checkbox" name="language[]" value="niemiecki" id="niemiecki" />
						<label for="niemiecki">Niemiecki</label>
					</div>
					</div>
				</div>
				<div class="single-col">
					<div class="styled-input-container styled-input--square">
					<div class="styled-input-single">
						<input type="checkbox" name="language[]" value="hiszpanski" id="hiszpanski" />
						<label for="hiszpanski">Hiszpański</label>
					</div>
					<div class="styled-input-single">
						<input type="checkbox" name="language[]" value="francuski" id="francuski" />
						<label for="francuski">Francuski</label>
					</div>
					<div class="styled-input-single">
						<input type="checkbox" name="language[]" value="chinski" id="chinski" />
						<label for="chinski">Chiński</label>
					</div>
					</div>
				</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Potrawy:</legend>
				<div class="two-column">
				<div class="single-col">
					<div class="styled-input-container">
					<div class="styled-input-single">
						<input type="radio" name="dish" value="sushi" id="sushi" />
						<label for="sushi">Sushi</label>
					</div>
					<div class="styled-input-single">
						<input type="radio" name="dish" value="spaghetti" id="spaghetti" />
						<label for="spaghetti">Spaghetti</label>
					</div>
					<div class="styled-input-single">
						<input type="radio" name="dish" value="sajgonki" id="sajgonki" />
						<label for="sajgonki">Sajgonki</label>
					</div>
					</div>
					</div>	
					<div class="single-col">
						<div class="styled-input-container">
						<div class="styled-input-single">
							<input type="radio" name="dish" value="tortilla" id="tortilla" />
							<label for="tortilla">Tortilla</label>
						</div>
						<div class="styled-input-single">
							<input type="radio" name="dish" value="frytki" id="frytki" />
							<label for="frytki">Frytki</label>
						</div>
						<div class="styled-input-single">
							<input type="radio" name="dish" value="krewetki" id="krewetki" />
							<label for="krewetki">Krewetki</label>
						</div>
						</div>
					</div>	
				</div>
			</fieldset>
			<div class="required" style="margin: -10px 0px 0px -208px;">*</div>
			<div class="select">				
				<select name="slct" id="slct">
					<option value="0">Wybierz kontynent</option>
					<option value="Afryka">Afryka</option>
					<option value="Ameryka południowa">Ameryka południowa</option>
					<option value="Ameryka północna">Ameryka północna</option>
					<option value="Antarktyda">Antarktyda</option>
					<option value="Australia">Australia</option>
					<option value="Azja">Azja</option>
					<option value="Europa">Europa</option>
				</select>
			</div>
			<input type="submit" id="wyslij" value="Wyślij">			
		</form>
		<hr>
		<?php
			if (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['pesel'])){
				$imie = $_POST['imie'];
				$nazwisko = $_POST['nazwisko'];
				$pesel = $_POST['pesel'];
				$gender = $_POST['sex'];
				$n = strlen($pesel);				
				$p = str_split($pesel);	
				$peselError = false;
								
				$ck = $p[10];
				$w = [1,3,7,9,1,3,7,9,1,3];
				$suma = 0;
				for($i=0;$i<10;$i++){
					$suma += $p[$i] * $w[$i];
				}
				$k = 10 - ($suma % 10);

				switch($p[2]){
					case 0:
					case 1:
						$r = 19;
						break;
					case 2: 
					case 3:
						$r = 20;
						break;
					case 8:
					case 9:
						$r = 18;
						break;	
					default:
						$r = 'Nieprawidłowy rok w PESELu';
						$peselError = true;
				}
				$r.= $p[0] . $p[1];
							
				if($p[2] == 0 or $p[2] == 2 or $p[2] == 8){ $mc = '0'.$p[3];	}
					elseif($p[2] == 1 or $p[2] == 3 or $p[2] == 9) { 
						if($p[3] == 0 or $p[3] == 1 or $p[3] == 2){$mc = $p[3] + 10;}
						else { 
							$mc = 'Nieprawidłowy miesiąc w PESELu';
							$peselError = true;
						}
					}
					else { 
						$mc = 'Nieprawidłowy miesiąc w PESELu';
						$peselError = true;
					}

								
				$ldwm = [31,29,31,30,31,30,31,31,30,31,30,31];
				$dm = $p[4].$p[5];
				if($dm <= $ldwm[intval($mc)]-1){}
				else { 
					$dm = 'Nieprawidłowy dzień w PESELu';
					$peselError = true;
				}
			}	
		?>
	</div>
  	<script src="script.js"></script>
</body>
</html>


