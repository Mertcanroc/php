<?php 
include 'opgave.php';
$umut = new Persoon("Umut", 18, "M");
$demirel = new Persoon("Demirel", 23, "M");
$demirel->setLeeftijd(24);
$age=$demirel->getLeeftijd();
echo "<br> leeftijd van Demirel is: ", $age; 
echo "<br>";
$gegevens1=$demirel->getGegevens();
$gegevens2=$umut->getGegevens();
echo $gegevens1;
echo $gegevens2;
echo $demirel;