# Docker Setup pour Laravel CRUD

Ce projet Laravel est configuré pour fonctionner avec Docker en utilisant deux services : nginx et PHP, avec une base de données externe.

## Prérequis

- Docker et Docker Compose installés
- Un réseau Docker externe nommé `shared_wobz_network` avec un conteneur de base de données connecté

## Configuration

### 1. Configuration de la base de données

Le fichier `.env.docker.example` contient un exemple de configuration. Copiez-le vers `.env` et ajustez les paramètres de connexion à votre base de données :

```bash
cp .env.docker.example .env
```

Modifiez les variables suivantes dans `.env` selon votre configuration :
- `DB_HOST=<nom_du_conteneur_db>` (nom du conteneur de base de données sur le réseau shared_wobz_network)
- `DB_PORT=3306` (port de la base de données, généralement 3306 pour MySQL)
- `DB_DATABASE=laravel` (nom de votre base de données)
- `DB_USERNAME=root` (nom d'utilisateur)
- `DB_PASSWORD=` (mot de passe)

### 2. Réseau Docker

Le projet est configuré pour utiliser le réseau externe `shared_wobz_network`. Assurez-vous que votre conteneur de base de données est connecté à ce réseau.

Pour vérifier si votre conteneur de base de données est sur le bon réseau :
```bash
docker inspect <nom_conteneur_db> | grep -A 10 Networks
```

Si votre conteneur n'est pas sur le réseau `shared_wobz_network`, connectez-le :
```bash
docker network connect shared_wobz_network <nom_conteneur_db>
```

## Utilisation

### Démarrer les services

```bash
docker-compose up -d
```

### Arrêter les services

```bash
docker-compose down
```

### Voir les logs

```bash
docker-compose logs -f
```

### Accéder au conteneur PHP

```bash
docker exec -it crud-laravel-php bash
```

### Installer les dépendances Composer

```bash
docker exec -it crud-laravel-php composer install
```

### Générer la clé d'application

```bash
docker exec -it crud-laravel-php php artisan key:generate
```

### Exécuter les migrations

```bash
docker exec -it crud-laravel-php php artisan migrate
```

## Accès à l'application

Une fois les services démarrés, l'application sera accessible à l'adresse :

```
http://localhost:8888
```

## Structure des services

- **nginx** : Serveur web sur le port 8888
- **php** : Conteneur PHP-FPM avec toutes les extensions nécessaires pour Laravel

## Notes importantes

- Les fichiers du projet sont montés en volume, donc les modifications sont reflétées immédiatement
- Le conteneur PHP est connecté au réseau `shared_wobz_network` pour accéder à la base de données externe
- Assurez-vous que le conteneur de base de données est accessible depuis le réseau Docker partagé

