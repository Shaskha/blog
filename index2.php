<?php

class vehicule
{
  protected $largeur;
  protected $hauteur;
  protected $longueur;
  protected $energie;
  private $puissance = 2500;
  protected $vitesseInstantanee;
  protected $chargeUtile;
  protected $nombrePassagers;

  function __construct ($masse, $largeur, $hauteur, $longueur)
  {
    $this -> masse = $masse;
    $this -> hauteur = $hauteur;
    $this -> largeur = $largeur;
    $this -> longueur = $longueur;
  }

  public function setVitesseInstantanee($vitesseInstantanee)
  {
    $this -> vitesseInstantanee = $vitesseInstantanee;
  }

  public function deplacer ($origine, $destination, $charge = 0)
  {
    // origine et destination = array (x, y, z)
  }

  public function accelerer ($vitesseInitiale, $vitesseFinale, $temps)
  {

  }

  public function consommer ()
  {

  }

  public function informerTrajet ($timeDepart, $time)
  {

  }

  protected function energieCinetique ()
  {
    return 0.5 * $this->masse * ($this->vitesseInstantanee)**2;
  }
}

class voiture extends vehicule
{
  protected $couleur;
  protected $marque;
  protected $modele;

  public function ec ()
  {
    return parent::energieCinetique();
  }
}

class moto extends vehicule
{
  const ROUES = 2;

  protected $couleur;
  protected $marque;
  protected $modele;

  public function chute()
  {
    echo "OUCH !";
  }

  public function wheeling ()
  {

  }
  public function getRoues()
  {
    return self::ROUES;
  }
}

$moto = new moto(500, 0.5, 1, 1.5);
echo $moto -> getRoues();
var_dump($moto);
