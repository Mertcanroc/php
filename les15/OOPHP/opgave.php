<?php
class Persoon
{
    public $naam;
    private $leeftijd;
    protected $geslacht;
    public $isStudent;
    public $gemiddeldCijfer;

    function setLeeftijd(int $leeftijd) {
        $this->leeftijd = $leeftijd;
    }

    function getLeeftijd() {
        return $this->leeftijd;
    }

    function getGegevens() {
        $gegevens = 
        "<br> De gegevens van " . $this->naam . " zijn: " . 
        "<br> Leeftijd: " . $this->leeftijd . 
        "<br> Geslacht: " . $this->geslacht;
        return $gegevens;
    }

    // Corrected the method name to __toString()
    function __toString() {
        return("<br>De gegevens van " . $this->naam . " zijn:" .
        "<br>Leeftijd: " .  $this->leeftijd . 
        "<br>Geslacht: " . $this->geslacht);
    }

    //constructor methode
    function __construct(string $naam, int $leeftijd, string $geslacht)
    {
        $this->naam = $naam;
        $this->leeftijd = $leeftijd;
        $this->geslacht = $geslacht;
        echo "<br> Nieuwe persson-object aangemaakt";
        echo "<br> De property naam is " . $this->naam;
    }

    function __destruct()
    {
        echo "<br> Persoon object $this->naam wordt verwijderd";
    }

    function setGeslacht(string $geslacht)
    {
        $this->geslacht = $geslacht;
    }

    function getGeslacht() 
    {
        return $this->geslacht; 
    }
}
