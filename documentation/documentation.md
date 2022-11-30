# Documentation ExerciseLooper - Semi-Croustillants

## Modèle Conceptuel
![MCD](\images\MCD_ExerciseLooper.png)

## Modèle Logique
![MLD](\images\MLD_ExerciseLooper.png)

## Mise en place environement

### Prérequis
- PHP (Version utilisée : **8.1.9**)
  - Extension PDO activée (changer `;extension=pdo_mysql` par `extension=pdo_mysql` dans le fichier `php.ini`)
- MySQL (Version utilisée : **15.1 Distrib 10.9.1-MariaDB**)
  - **Avoir la base de données**
    - Se connecter avec un client SQL de votre choix et éxecuter le fichier `Create_DB.sql` qui crée la base de données du site. Les données pourront être insérées en utilisant les fonctionnalités du site directement.
- Un IDE de votre choix (développement initial effectué depuis Visual Studio Code)
- PHP Composer (https://getcomposer.org/download/)

### Procédure
1. Récuperer le repository depuis Github (clone, fork ou téléchargement .zip) (https://github.com/CPNV-ES/ExerciseLooper-TGN-NBI)
1. Faire un ``` composer install ``` à la racine du projet
1. Ouvrir le fichier ``` config.exemple.ini ``` et remplir les " " avec vos informations.
   1. Renommer le fichier en ``` config.ini ```
1. Lancer le serveur PHP via la commande ``` php -S 127.0.0.1:8080 -t public ```

## Structure du projet
- **documentation/**
Ce dossier contient les documents nécessaires à la documentation du projet (MCD, MLD, Scripts SQL).
- **public/**
Ce dossier contient l'index du projet et les ressources Images/CSS/JS s'il y en a.
- **src/**
  Ce dossier contient tous les fichiers du projet.
  - **config/**
    - Ce dossier contient le fichier de config pour les accès à la base de données (non commité évidemment mais avec un fichier d'exemple vide à remplir).
  - **controllers/**
    - Ce dossier contient les controllers de l'application, ceux-ci héritent d'un controller de base qui contient une instance du router ainsi qu'un redirect.
  - **models/**
    - Ce dossier contient les models de l'application, ceux-ci héritent d'un modèle de base qui contient toutes les actions "par défaut" liées à la base de données (CRUD).
  - **renderer/**
    - Ce dossier contient le fichier renderer, qui se charge de retourner le contenu qui sera affiché dans les vues.
  - **router/**
    - Ce dossier contient le router de l'application.
  - **views/**
    - Ce dossier contient toutes les vues du site découpées par objets (vues exercise, vues fields etc...) ainsi que les erreurs et templates.
  - **routes.php**
    - Ce fichier contient toutes les routes de l'application, celles-ci font appel à une méthode contenue dans un controller.
- **vendor** (dossier généré avec ``` composer install ```)