<?php

class Pacijent {
    public $ime;
    public $prezime;
    public $visina;
    public $tezina;
    public $datum;
    public $pol;
    public $adresa;
    public $telefon;
    public $email;
    public $jmbg;
    public $osiguranje;
    public $bmi;
    
    function __construct($ime, $prezime, $visina, $tezina, $datum, $pol, $adresa, $telefon, $email, $jmbg, $osiguranje) {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->visina = $visina;
        $this->tezina = $tezina;
        $this->datum = $datum;
        $this->pol = $pol;
        $this->adresa = $adresa;
        $this->telefon = $telefon;
        $this->email = $email;
        $this->jmbg = $jmbg;
        $this->osiguranje = $osiguranje;
    }
    
    function izracunajBMI() {
        return $this->tezina / (($this->visina / 100) * ($this->visina / 100));
    }
    
    function setBmi($bmi) {
        if ($bmi < 18.5) {
            $this->bmi = "Neuhranjenost";
        } else if ($bmi <= 24.9) {
            $this->bmi = "Idealna masa";
        } else if ($bmi <= 29.9) {
            $this->bmi = "Prekomerna masa";
        } else if ($bmi <= 34.9) {
            $this->bmi = "Blaga gojaznost";
        } else if ($bmi <= 39.9) {
            $this->bmi = "Teska gojaznost";
        } else if ($bmi > 40) {
            $this->bmi = "Ekstremna gojaznost";
        } else {
            echo "Pogresna vrednost za bmi!";
        }
    }


}



