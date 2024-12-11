<?php 
class Medewerker {
    public $uurloon = 10;
    public $aantal_uren = 40;

    public function weekloon() {
        return $this->uurloon * $this->aantal_uren;
    }

    $medewerker = new Medewerker();
    echo $medewerker->weekloon();
}

?>