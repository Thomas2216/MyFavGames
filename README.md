# MyFavGames

Application privée permettant à un utilisateur connecté de rechercher et gérer ses jeux vidéo favoris.

Projet personnel réalisé pour démontrer et appliquer mes compétences. Idée de projet initialement soumise par mon ancien maître de stage.

## Stack technique

- **Back-end** : Symfony 7.2, en mode API pure (découplé d'un front)
- **API** : [API Platform](https://api-platform.com/) — génération automatique du CRUD, documentation OpenAPI/Swagger
- **Authentification** : JWT ([LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)), API stateless
- **Base de données** : Doctrine ORM
- **Tests** : PHPUnit (`symfony/test-pack`)
- **Front-end** : React + Vite (dépôt/dossier externalisé, non versionné avec le back)
- **API externe de jeux** : [FreeToGame API](https://www.freetogame.com/api-doc)

## Fonctionnalités prévues

### Compte utilisateur

- Création de compte : nom, prénom, pseudo, email, date de naissance (16 ans minimum), photo de profil
- Connexion via email + mot de passe (haché en base)
- Mot de passe oublié
- Édition des informations du compte
- Suppression du compte

### Jeux favoris

- Page d'accueil avec barre de recherche (via l'API FreeToGame)
- Affichage des 6 derniers jeux ajoutés en favori
- Page "Mes jeux" : liste complète des favoris, filtres par date/plateforme (optionnel), suppression d'un jeu, pagination (optionnel)

## Installation

```bash
git clone https://github.com/Thomas2216/MyFavGames.git
cd MyFavGames
composer install
```

### Configuration

Copier `.env` en `.env.local` et renseigner :

```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/myfavgames?serverVersion=8.0"
```

### Clés JWT

Générer la paire de clés si absente (`config/jwt/`) :

```bash
php bin/console lexik:jwt:generate-keypair
```

Renseigner `JWT_PASSPHRASE` dans `.env.local`.

### Base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Lancer le serveur

```bash
symfony serve
```

L'API est accessible sur `/api`, avec la documentation Swagger interactive.

## Authentification

1. Créer un compte via `POST /api/users`
2. Se connecter via `POST /api/login` (retourne un token JWT)
3. Utiliser le token sur les routes protégées via le header :

```
Authorization: Bearer <token>
```

## Tests

```bash
php bin/console doctrine:database:create --env=test
php bin/phpunit
```

## Statut du projet

🚧 En cours de développement — le back (auth + gestion des utilisateurs) est en place, le reste des fonctionnalités (jeux favoris, front React) reste à construire.
