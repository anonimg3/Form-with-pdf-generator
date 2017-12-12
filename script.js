var button = document.getElementById("wyslij")
var imie = document.getElementById("imie");
var nazwisko = document.getElementById("nazwisko");
var pesel = document.getElementById("pesel");
var dataUrodzenia = document.getElementById("data-urodzenia");
var slct = document.getElementById("slct");
var peselError = document.getElementById("pesel-error");
var sex = document.getElementsByName("sex");

document.getElementsByName("pesel")[0].addEventListener('change', peselValid);
document.getElementsByName("imie")[0].addEventListener('change', imieValid);
document.getElementsByName("nazwisko")[0].addEventListener('change', nazwiskoValid);

function peselValid(){
    if( this.value != "" && PeselDecode(this.value).valid == true){
        dataUrodzenia.value = PeselDecode(this.value).date.toISOString().split('T')[0];
        (PeselDecode(this.value).sex == "m") ? sex[0].checked = true : sex[1].checked = true; 
        dataUrodzenia.style.borderColor = "#a5cda5";   
        pesel.style.borderColor = "#a5cda5";   
    }else{
        dataUrodzenia.value = "";
        sex[0].checked = false;
        sex[1].checked = false;
        pesel.style.borderColor = "red";
    }
}

function imieValid(){
    if( this.value != ""){
        imie.style.borderColor = "#a5cda5";
    }else{
        imie.style.borderColor = "red";
    }
}

function nazwiskoValid(){
    if( this.value != ""){
        nazwisko.style.borderColor = "#a5cda5";
    }else{
        nazwisko.style.borderColor = "red";
    }
}

function validation(){  
    
    var error = false;
    peselError.innerText = "";

    if( imie.value == "" ){
        imie.placeholder = "Podaj imię";
        imie.style.borderColor = "red";
        error = true;
    }else{
        imie.style.borderColor = "#a5cda5"; 
    }

    if( nazwisko.value == "" ){
        nazwisko.placeholder = "Podaj nazwisko";
        nazwisko.style.borderColor = "red";
        error = true;
    }else{
        nazwisko.style.borderColor = "#a5cda5"; 
    }

    if( slct.value == 0 ){
        slct.style.color = "red";
        error = true;
    }else{
        slct.style.color = "#666"; 
    }

    if( pesel.value == "" ){
        pesel.placeholder = "Podaj PESEL";
        pesel.style.borderColor = "red";
        error = true;
    }else{
        if( PeselDecode(pesel.value).valid == false ){
            pesel.style.borderColor = "red";
            error = true;          
            peselError.innerText = "Nieprawidłowy PESEL";
        }
        else{
            peselError.innerText = "";
            pesel.style.borderColor = "#a5cda5"; 
        }
    }

    
    if( dataUrodzenia.value != "" && !isValidDate(dataUrodzenia.value) ){
        peselError.innerText = "Błędny format daty. Datę podaj w postaci YYYY-MM-DD np. 2001-08-22";
        dataUrodzenia.style.borderColor = "red";
        error = true;
    }else{
        dataUrodzenia.style.borderColor = "#a5cda5";        
    }


    return !error;    
}


function PeselDecode(pesel) 
{
   // http://artpi.pl/?p=8
   // Funkcja dekodujaca nr. Pesel 
   // Wycinamy daty z numeru
   var rok=parseInt(pesel.substring(0,2),10);
   var miesiac = parseInt(pesel.substring(2,4),10)-1;
   var dzien = parseInt(pesel.substring(4,6),10);
   // Powszechnie uwaza sie, iz daty w numerach pesel obejmuja tylko ludzi urodzonych do 2000 roku. Na szczescie prawodawcy o tym pomysleli i do miesiaca dodawane sa liczby tak, by pesele starczyly az do 23 wieku. 
   if(miesiac>80) {
        rok = rok + 1800;
        miesiac = miesiac - 80;
   }
   else if(miesiac > 60) {
        rok = rok + 2200;
        miesiac = miesiac - 60;
   }
   else if (miesiac > 40) {
        rok = rok + 2100;
        miesiac = miesiac - 40;
   }
   else if (miesiac > 20) {
        rok = rok + 2000;
        miesiac = miesiac - 20;
   }
   else
   {
        rok += 1900;
   }
   // Daty sa ok. Teraz ustawiamy.
   var urodzony=new Date();
   urodzony.setFullYear(rok, miesiac, dzien);
    
   // Teraz zweryfikujemy numer pesel
   // Metoda z wagami jest w sumie najszybsza do weryfikacji.
   var wagi = [9,7,3,1,9,7,3,1,9,7];
   var suma = 0;
    
   for(var i=0;i<wagi.length;i++) {
       suma+=(parseInt(pesel.substring(i,i+1),10) * wagi[i]);
   }
   suma=suma % 10;
   var valid=(suma===parseInt(pesel.substring(10,11),10));
    
   //plec
    if(parseInt(pesel.substring(9,10),10) % 2 === 1) { 
        var plec='m';
    } else {
        var plec='k';
    }
   return {valid:valid,sex:plec,date:urodzony};
}

function isValidDate(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    if(!dateString.match(regEx)) return false;  // Invalid format
    var d = new Date(dateString);
    if(!d.getTime()) return false; // Invalid date (or this could be epoch)
    return d.toISOString().slice(0,10) === dateString;
  }