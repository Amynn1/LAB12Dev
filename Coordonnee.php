<?php

/**
 * Représente une coordonnée GPS enregistrée par un appareil mobile.
 * Contient la position géographique, l'horodatage et l'identifiant de l'appareil.
 */
class Coordonnee {

    private ?int $id;
    private float $lat;
    private float $lng;
    private string $horodatage;
    private string $identifiant;

    public function __construct(?int $id, float $lat, float $lng, string $horodatage, string $identifiant) {
        $this->id          = $id;
        $this->lat         = $lat;
        $this->lng         = $lng;
        $this->horodatage  = $horodatage;
        $this->identifiant = $identifiant;
    }

    public function obtenirLatitude(): float    { return $this->lat; }
    public function obtenirLongitude(): float   { return $this->lng; }
    public function obtenirHorodatage(): string { return $this->horodatage; }
    public function obtenirIdentifiant(): string { return $this->identifiant; }
}
