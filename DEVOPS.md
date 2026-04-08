# Documentation DevOps — Task Manager CI/CD

## 1. Architecture de la pipeline CI/CD

Push / Pull Request vers main
│
▼
┌─────────────────────────────┐
│      GitHub Actions         │
│                             │
│  Job: tests                 │
│  ├── Setup PHP 8.2          │
│  ├── composer install       │
│  ├── php artisan migrate    │
│  └── php artisan test       │
│                             │
│  Job: frontend              │
│  ├── npm ci                 │
│  └── npm run build          │
└─────────────────────────────┘

## 2. Stratégie de branches Git

Nous utilisons **GitHub Flow** :

- `main` est la seule branche permanente, toujours déployable
- Chaque fonctionnalité → branche dédiée (`feat/task-model`, `feat/details_tache`, etc.)
- Une Pull Request est créée pour revue de code avant tout merge
- Les commits suivent la convention **Conventional Commits**

## 3. Répartition des tâches

| Développeur | Tâche |
|-------------|-------|
| Jean André     | Création des tâches (create) ; .github/workflows/ci.yml - Pipeline CI et .github/workflows/docker-publish.yml |
| Michel         | initialisation, migration, GitHub ; Dockerfile et Docker compose |
| Mame Diarra    | Modifier une tâche existante ; CHANGELOG.md et GHCR |
| Edou           | Voir les détails d’une tâche ; DEVOPS.md  et README.md|
| Sayba          | Supprimer une tâche ; phpstan.neon et .php-cs-fixer.php |

## 4. Configuration Docker

| Service | Image | Rôle |
|---------|-------|------|
| `app` | PHP 8.2 FPM Alpine | Logique applicative Laravel |
| `nginx` | nginx:alpine | Reverse proxy, assets statiques |
| `mysql` | mysql:8.0 | Base de données |
| `redis` | redis:7-alpine | Cache et sessions |

## 5. Outils utilisés

| Outil | Rôle |
|-------|------|
| GitHub Actions | Orchestration de la pipeline CI/CD |
| PHPUnit / Pest | Tests unitaires et feature |
| Docker Compose | Orchestration des conteneurs en local |
| Bootstrap 5 | Interface utilisateur |
| Conventional Commits | Historique lisible et structuré |

## 6. Difficultés rencontrées et solutions

| Difficulté | Solution |
|-----------|----------|
| Double migration tasks | Suppression de la migration dupliquée |
| Conflit de merge sur routes/web.php | Résolution manuelle en gardant toutes les routes |
| Table tasks absente en tests | Ajout de 'RefreshDatabase' dans tous les fichiers de test |
| Tests Pest vs PHPUnit | Uniformisation en PHPUnit classique |
| Les problemes liées à pipeline GIthub action |Recherche et débuggage
| php cs fixer affichait une erreur de namespace | créer un mini fichier
| Erreur de contraintes SQL(in_progeress) et échec du build Docker(extension PHP manquantes) | Harmonisation des status dans le code et mise à jour du Dockerfile avec les bonnes extensions
