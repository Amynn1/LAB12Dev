<?php

/**
 * Contrat de base pour les dépôts de données.
 * Toute classe de service accédant à la base doit implémenter cette interface.
 */
interface IDepot {

    /** Persiste un nouvel objet en base de données. */
    public function inserer($objet): void;

    /** Retourne la liste complète des enregistrements. */
    public function recupererTous(): array;
}
