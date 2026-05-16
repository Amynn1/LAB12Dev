<?php

header('Content-Type: application/json');

require_once __DIR__ . '/services/ServiceCoordonnee.php';

try {
    $service = new ServiceCoordonnee();
    $liste   = $service->recupererTous();

    echo json_encode([
        "positions" => $liste,
        "total"     => count($liste),
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["positions" => [], "total" => 0, "message" => "Erreur serveur"]);
}
