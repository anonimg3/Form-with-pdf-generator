<?php
    require('fpdf.php');
    define('FPDF_FONTPATH','font/');

    $imie = iconv('utf-8','windows-1250//TRANSLIT', $_POST['imie']);
    $nazwisko = iconv('utf-8','windows-1250//TRANSLIT', $_POST['nazwisko']);
    $pesel =  iconv('utf-8','windows-1250//TRANSLIT', $_POST['pesel']);
    $gender = iconv('utf-8','windows-1250//TRANSLIT', $_POST['sex']);
    $title = 'Formularz zg³oszeniowy';
    $dateOfBirth = iconv('utf-8','windows-1250//TRANSLIT', $_POST['data-urodzenia']);
    // 210 x 297
    // configure
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddFont('arial_ce','','arial_ce.php');
    $pdf->AddFont('arial_ce','I','arial_ce_i.php');
    $pdf->AddFont('arial_ce','B','arial_ce_b.php');
    $pdf->AddFont('arial_ce','BI','arial_ce_bi.php');
    $pdf->AddPage();
    $pdf->SetFont('arial_ce', 'B', 26);
    // title
    $pdf->SetTextColor(100,0,0);
    $pdf->SetXY(25,25);
    $pdf->Cell(160,0,$title,0,1,'C');
    $pdf->SetXY(25,32);
    $pdf->SetDrawColor(100,0,0);
    $pdf->Cell(160,0,'','B');
    // avatar
    $pdf->Image('img/'.$gender.'.png',125,38);
    // contennt text format
    $pdf->SetFont('arial_ce', '', 12);
    $pdf->SetTextColor(0,0,0);
    // name
    $pdf->SetXY(25,45);
    $pdf->Cell(0,0,'Imiê: '.$imie);
    // surname
    $pdf->SetXY(92,45);
    $pdf->Cell(0,0,'Nazwisko: '.$nazwisko);
    // date of birth
    $pdf->SetXY(25,52);
    $pdf->Cell(0,0,'Data urodzenia: '.$dateOfBirth);
    // pesel
    $pdf->SetXY(92,52);
    $pdf->Cell(0,0,'PESEL: '.$pesel);
    // continent
    if(isset($_POST['slct']) && !empty($_POST['slct'])){
        $continent = iconv('utf-8','windows-1250//TRANSLIT', $_POST['slct']);
        $pdf->SetXY(25,59);
        $pdf->Cell(0,0,'Kontynent: '.$continent);
    }
    // gender
    $pdf->SetXY(92,59);
    if ($gender == 'male')
    {
        $pdf->Cell(0,0,'P³eæ: mê¿czyzna');
    }else{
        $pdf->Cell(0,0,'P³eæ: kobieta');
    }
    // language
    if(isset($_POST['language']) && !empty($_POST['language'])){
        $pdf->SetXY(25,$pdf->GetY()+7);
        $pdf->Cell(0,0,'Znajomoœæ jêzyków:');
        $language = $_POST['language'];
        foreach($_POST['language'] as $language){
            $pdf->SetXY(30,$pdf->GetY()+7);
            $lng = iconv('utf-8','windows-1250//TRANSLIT', $language);
            $pdf->Cell(0,0,'- '.$lng);
        }
    }
    // dish
    if(isset($_POST['dish']) && !empty($_POST['dish'])){
        $dish = iconv('utf-8','windows-1250//TRANSLIT', $_POST['dish']);
        $pdf->SetXY(25,$pdf->GetY()+7);
        $pdf->Cell(0,0,'Ulubiona potrawa: '.$dish);
    }
    $pdf->Output();
?>


















