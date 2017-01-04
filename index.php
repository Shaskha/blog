<?php
class Voiture
{
  const ROUES = 4;
  const NB_PLACES = 5;
  const TYPE_CARBURANT = "Essence";

  protected $couleur= "Jaune La POSTE";
  protected $modele = "4L";
  protected $marque = "Renault";
  protected $kilometrage;
  protected $vitesse;
  protected $temps;

  function __construct ($vitesse)
  {
    $this -> vitesse = $vitesse;
    // $this -> temps = $temps;
  }

  function __toString ()
  {
    return "voiture";
  }

  public function avancer ()
  {
    echo "paf, un mur !, cassé voiture...";
  }

  public function setCouleur ($couleur)
  {
    $this -> couleur = $couleur;
  }

  public function setModele ($modele)
  {
    $this -> modele = $modele;
  }

  public function getRoues ()
  {
    return self::ROUES;
  }

  public function getCouleur ($couleur)
  {
    return $this -> couleur;
  }

  public function distance ($temps)
  {
    $this -> temps = $temps;
    return ($this -> vitesse) * ($this -> temps);
  }

  public function debug()
  {
    echo "class ",__CLASS__," ",__METHOD__;
  }

  public function bug($error)
  {
    throw new Exception($error);
  }
}



$voiture1 = new Voiture(30);
echo $voiture1 -> distance (3600);
echo "m";

echo $voiture1 -> debug();
$voiture1 -> bug("perdu !");
