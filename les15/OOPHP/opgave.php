<?php
{
    class Persoon
    {
        public $naam;
        private $leeftijd;
        protected $geslacht;
        public $isStudent;
        public $gemiddeldCijfer;
 
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
}