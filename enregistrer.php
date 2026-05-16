<?php

header('Content-Type: application/json');

/* Seules les requêtes POST sont acceptées */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["ok" => false, "message" => "Méthode non autorisée"]);
    exit;
}

require_once __DIR__ . '/services/ServiceCoordonnee.php';
require_once __DIR__ . '/modeles/Coordonnee.php';

$lat         = $_POST['latitude']  ?? null;
$lng         = $_POST['longitude'] ?? null;
$horodatage  = $_POST['date']      ?? null;
$identifiant = $_POST['imei']      ?? null;

/* Vérification des champs obligatoires */
if ($lat === null || $lng === null || $horodatage === null || $identifiant === null) {
    http_response_code(400);
    echo json_encode(["ok" => false, "message" => "Paramètres manquants"]);
    exit;
}

/* Validation des plages géographiques */
$lat = (float) $lat;
$lng = (float) $lng;

if ($lat < -90.0 || $lat > 90.0 || $lng < -180.0 || $lng > 180.0) {
    http_response_code(422);
    echo json_encode(["ok" => false, "message" => "Coordonnées hors limites"]);
    exit;
}

/* Nettoyage de l'identifiant appareil (max 64 caractères) */
$identifiant = substr(strip_tags($identifiant), 0, 64);

try {
    $service = new ServiceCoordonnee();
    $service->inserer(new Coordonnee(null, $lat, $lng, $horodatage, $identifiant));
    echo json_encode(["ok" => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "message" => "Erreur serveur"]);
}
