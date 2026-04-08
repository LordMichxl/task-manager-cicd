# Task Manager CI/CD

![CI](https://github.com/LordMichxl/task-manager-cicd/actions/workflows/ci.yml/badge.svg)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![Docker](https://img.shields.io/badge/Docker-ready-blue)

Application web de gestion de tâches développée avec Laravel 12, intégrant une pipeline CI/CD complète via GitHub Actions et une infrastructure Docker.

## Fonctionnalités

- Créer une tâche (titre, description, statut, priorité, date limite)
- Modifier une tâche existante
- Supprimer une tâche
- Lister toutes les tâches avec filtrage par statut
- Voir le détail d'une tâche

## Prérequis

- PHP 8.2+
- Composer 2.x
- Node.js 20+
- Docker & Docker Compose

## Installation locale

'''bash
git clone https://github.com/LordMichxl/task-manager-cicd.git
cd task-manager-cicd
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan serve


## Lancement avec Docker

'''bash
docker-compose up -d
docker-compose exec app php artisan migrate


L'application est accessible sur http://localhost.

## Commandes utiles
'''bash
php artisan serve
# Lancer les tests
php artisan test

# Lancer les tests avec couverture
php artisan test --coverage --min=70


## Workflow Git (GitHub Flow)

- 'main' — branche principale toujours stable
- Chaque fonctionnalité → nouvelle branche depuis 'main'
- Pull Request → code review → merge dans 'main'
- Commits au format Conventional Commits
