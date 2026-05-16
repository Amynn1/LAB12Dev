<?php

require_once __DIR__ . '/../config/ConnecteurBD.php';
require_once __DIR__ . '/../modeles/Coordonnee.php';
require_once __DIR__ . '/../interfaces/IDepot.php';

/**
 * Gère la persistance des coordonnées GPS en base de données.
 * Implémente IDepot pour les opérations d'insertion et de lecture.
 */
class ServiceCoordonnee implements IDepot {

    private ConnecteurBD $bd;

    public function __construct() {
        $this->bd = new ConnecteurBD();
    }

    /**
     * Enregistre une coordonnée GPS dans la table `position`.
     * Utilise une requête préparée pour éviter les injections SQL.
     */
    public function inserer($coordonnee): void {
        $sql  = "INSERT INTO `position` (latitude, longitude, date, imei) VALUES (?, ?, ?, ?)";
        $stmt = $this->bd->obtenirPDO()->prepare($sql);
        $stmt->execute([
            $coordonnee->obtenirLatitude(),
            $coordonnee->obtenirLongitude(),
            $coordonnee->obtenirHorodatage(),
            $coordonnee->obtenirIdentifiant(),
        ]);
    }

    /**
     * Récupère toutes les coordonnées enregistrées, triées de la plus récente à la plus ancienne.
     */
    public function recupererTous(): array {
        $sql = "SELECT * FROM `position` ORDER BY date DESC";
        return $this->bd->obtenirPDO()->query($sql)->fetchAll();
    }
}
