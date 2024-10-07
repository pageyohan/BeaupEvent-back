# Beaup'Events - Back-End

Bienvenue dans le dépôt du back-end du projet Beaup'Events ! 🚀

Ce projet a été développé pour l'institution Beaupeyrat, et a pour objectif de simplifier et d'améliorer la gestion des événements au sein de l'établissement.
## 🏗️ Structure du Projet

Ce dépôt contient l'API et la logique back-end de Beaup'Events. Il est responsable de :

    La gestion des utilisateurs (administrateurs, organisateurs, participants).
    La création, modification et suppression des événements.
    La gestion des inscriptions et des interactions liées aux événements.
    La sécurité et l'authentification des utilisateurs.

## 🚀 Front-End

Le front-end, qui permet aux utilisateurs d'interagir avec l'application de manière intuitive, est hébergé dans un autre dépôt. Le lien vers le dépôt front-end sera ajouté ici prochainement !

[Lien vers le dépôt Front-End]
## 📦 Technologies utilisées

Les principales technologies et outils utilisés pour la partie back-end de Beaup'Events sont :

    Symfony pour la gestion des données et la création d'API avec API Platform
    JWT (JSON Web Token) pour la gestion des sessions et la sécurité.
    Tests unitaires et intégration avec PHPUnit.

## 🛠️ Installation et Utilisation

    Cloner le dépôt :

    bash

git clone https://github.com/pageyohan/BeaupEvent-back.git
cd BeaupEvent-back

Installer les dépendances :

bash

docker compose build

## ⚙️ Variables d'environnement

Le projet **Beaup'Events** utilise des variables d'environnement pour configurer la base de données, les clés JWT, etc. Voici les instructions pour générer les clés JWT nécessaires à l'authentification.

### 🗝️ Clés JWT

Pour générer les clés JWT (privée et publique) et configurer les permissions correctement, exécutez la commande suivante via Docker :

```bash
docker compose exec php sh -c '
    set -e
    apt-get install openssl
    php bin/console lexik:jwt:generate-keypair
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'
``` 

Lancer le serveur :

bash

    docker compose up (ou docker compose up -d pour garder la main dans le bash)

## ✨ Fonctionnalités à venir

    Intégration avec le système de notifications pour les événements à venir.
    Génération de rapports d'événements.
    Améliorations au niveau de la gestion des rôles d'utilisateurs.


🎉 Merci de votre intérêt pour Beaup'Events ! Nous espérons que ce projet vous sera utile. Pour toute question ou suggestion, n'hésitez pas à nous contacter.