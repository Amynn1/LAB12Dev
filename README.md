# LAB12Dev
# GPS Tracker — Localisation en temps réel

Application Android de suivi GPS en temps réel. L'appareil envoie ses coordonnées géographiques vers un serveur PHP qui les stocke en base de données MySQL. Une deuxième vue affiche l'ensemble des points enregistrés sur une carte Google Maps interactive.

---

## Technologies

- Android (Java, API 24+)
- Google Maps SDK for Android
- Volley (requêtes HTTP asynchrones)
- PHP 8 (API REST)
- MySQL / MariaDB (via PDO)
- XAMPP (environnement de développement local)

---

## Fonctionnalités

- Acquisition de la position GPS toutes les 5 secondes (déplacement minimal : 5 m)
- Validation des coordonnées côté application et côté serveur
- Envoi automatique au serveur via POST avec horodatage
- Affichage de l'heure du dernier envoi réussi
- Vue carte avec marqueurs numérotés et compteur de points
- Indicateur de chargement pendant la récupération des données

---

## Structure du projet

```
GPS-Tracker/
├── Android-App/                  # Application Android (Android Studio)
│   └── app/src/main/java/com/ennoukra/gpstracker/
│       ├── TrackeurActivity.java  # Suivi GPS + envoi serveur
│       └── CarteActivity.java     # Affichage des positions sur Maps
│
└── Backend/                       # Serveur PHP
    ├── modeles/Coordonnee.php     # Modèle de données
    ├── config/ConnecteurBD.php    # Connexion PDO
    ├── interfaces/IDepot.php      # Contrat des dépôts
    ├── services/ServiceCoordonnee.php
    ├── enregistrer.php            # POST — sauvegarde une position
    └── lister.php                 # GET  — retourne toutes les positions
```

---

## Installation

### Prérequis

- Android Studio (Hedgehog ou plus récent)
- XAMPP (Apache + MySQL)
- Une clé API Google Maps

### 1. Base de données

Créer la base et la table dans phpMyAdmin (ou via la console MySQL) :

```sql
CREATE DATABASE IF NOT EXISTS localisation CHARACTER SET utf8 COLLATE utf8_general_ci;

USE localisation;

CREATE TABLE position (
    id        INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    latitude  DOUBLE       NOT NULL,
    longitude DOUBLE       NOT NULL,
    date      DATETIME     NOT NULL,
    imei      VARCHAR(64)  NOT NULL
);
```

### 2. Backend PHP

Copier le dossier `Backend/` dans `htdocs/localisation/` de XAMPP :

```
C:\xampp\htdocs\localisation\
```

Vérifier les paramètres de connexion dans `Backend/config/ConnecteurBD.php` (host, dbname, user, password).

### 3. Application Android

1. Ouvrir `Android-App/` dans Android Studio.
2. Renseigner la clé Google Maps dans `res/values/google_maps_api.xml` :
   ```xml
   <string name="google_maps_key">VOTRE_CLE_ICI</string>
   ```
3. Adapter l'URL du serveur dans `TrackeurActivity.java` et `CarteActivity.java`
   (remplacer `10.0.2.2` par l'adresse IP réelle si vous n'utilisez pas l'émulateur Android).
4. Lancer l'application sur un émulateur ou un appareil physique.

---

## Endpoints API

| Méthode | URL                  | Description                        |
|---------|----------------------|------------------------------------|
| POST    | `/enregistrer.php`   | Enregistre une position GPS        |
| GET     | `/lister.php`        | Retourne toutes les positions JSON |

Exemple de réponse de `lister.php` :

```json
{
  "positions": [
    { "id": "1", "latitude": "48.8566", "longitude": "2.3522", "date": "2026-05-08 14:30:00", "imei": "Pixel_7_abc123" }
  ],
  "total": 1
}
```

---
<img width="432" height="757" alt="image" src="https://github.com/user-attachments/assets/520984d9-7667-4318-876f-fd5a789bb8ee" />

  <img width="1108" height="417" alt="image" src="https://github.com/user-attachments/assets/51d2dcc3-a724-405c-acee-1e32bd4f187a" />  
  <img width="389" height="740" alt="image" src="https://github.com/user-attachments/assets/61ddd3e4-638e-42d9-afb4-1522b418568f" />


