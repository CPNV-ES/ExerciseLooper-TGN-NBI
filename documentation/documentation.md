# Documentation ExerciseLooper - Semi-Croustillants

### Modèle Conceptuel
![MCD](\images\MCD_ExerciseLooper.png)

### Modèle Logique
![MLD](\images\MLD_ExerciseLooper.png)

### Mise en place environement

#### Prérequis
- PHP (Version utilisée : **8.1.9**)
  - Extension PDO activée (changer `;extension=pdo_mysql` par `extension=pdo_mysql` dans le fichier `php.ini`)
- MySQL (Version utilisée : **15.1 Distrib 10.9.1-MariaDB**)
  - **Avoir la base de données**
    - Se connecter avec un client SQL de votre choix et éxecuter le fichier `Create_DB.sql` qui crée la base de données du site. Les données pourront être insérées en utilisant les fonctionnalités du site directement.
- Un IDE de votre choix (développement initial effectué depuis Visual Studio Code)

#### Procédure
1. Récuperer le repository depuis Github (clone, fork ou téléchargement .zip) (https://github.com/CPNV-ES/ExerciseLooper-TGN-NBI)
1. Faire un ``` composer install ``` à la racine du projet
1. Ouvrir le fichier ``` config.exemple.ini ``` et remplir les " " avec vos informations.
   1. Renommer le fichier en ``` config.ini ```
1. Lancer le serveur PHP via la commande ``` php -S 127.0.0.1:8080 -t public ```

#### Structure du projet
- documentation
Ce dossier contient les documents nécessaires à la documentation du projet (MCD, MLD, Scripts SQL)
- public
Ce dossier contient l'index du projet et les ressources Images/CSS/JS s'il y en a
- src
Ce dossier contient tous les fichiers du projet
  - config
  - controllers
  - models
  - renderer
  - router
  - views
- vendor (après avoir fait ``` composer install ```)
