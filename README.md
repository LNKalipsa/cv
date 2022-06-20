Bonjour !
Ceci est un petit projet Symfony dans le but de générer une page contenant vos informations de CV. Vous avez accès à un back-office entièrement fonctionnel.

Le projet nécessite quelques améliorations, celles-ci viendront dans une V2 :
  - Amélioration du design global de la landing-page et ajout d'un footer
  - Ajout d'une connexion sécurisée via le security bundle
  - Possibilité d'ajouter une photo via Vichuploader

Prérequis d'installation :
  - Serveur Apache
  - Composer

Pour installer le projet :
   - composer install
   - yarn install
   - npm install

Configurer la Base de données :
  - faire une copie du fichier .env et le renommer .env.dev.local
  - dans ce fichier décommenter ligne 30 et configurer vos accès à votre base de donnée
  - lancer la commande php bin/console doctrine:migration:migrate

Pour visualiser le projet : 
  - Serveur local Apache / PHP (mettre le projet dans le dossier "wwww" de votre serveur local)
  - lancer la commande yarn encore dev (pour lancer le webpack)
