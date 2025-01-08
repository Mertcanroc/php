<?php

class Dier {
    protected $naam;

    public function __construct($naam) {
        $this->naam = $naam;
    }

    public function maakGeluid() {
        echo "Dit dier maakt een geluid.";
    }
}

class Hond extends Dier {
    public function maakGeluid() {
        echo "Woef!";
    }

    public function haalStok() {
        echo "$this->naam haalt de stok.";
    }
}

$hond = new Hond("Gemairo");
$hond->maakGeluid();
$hond->haalStok(); 
?>

