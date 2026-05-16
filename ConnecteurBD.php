<?php

/**
 * Établit et expose la connexion à la base de données MySQL via PDO.
 * En cas d'échec, retourne une réponse JSON d'erreur et arrête l'exécution.
 */
class ConnecteurBD {

    private PDO $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=localhost;dbname=localisation;charset=utf8",
                "root",
                ""
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            http_response_code(500);
            die(json_encode(["ok" => false, "message" => "Connexion impossible"]));
        }
    }

    public function obtenirPDO(): PDO {
        return $this->pdo;
    }
}
