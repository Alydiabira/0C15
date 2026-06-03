## **Compétence : Tester une application web pour assurer sa qualité**

| Indicateur                                                           | Statut | Notes                                                             |
| -------------------------------------------------------------------- | ------ | ----------------------------------------------------------------- |
| J’ai testé toutes les fonctionnalités présentes dans le Front Office | ✔️     | Tests fonctionnels complets : pages publiques, upload, navigation |
| J’ai implémenté un jeu de données (fixtures)                         | ✔️     | Fixtures complètes : utilisateurs, invités, albums, médias        |
| Le site est fonctionnel et ne comporte aucune erreur d’affichage     | ✔️     | Validé en local + CI                                              |
| J’ai inclus le rapport de tests dans le repository                   | ✔️     | Dossier `coverage/` + badge CI                                    |
| La couverture de code est de minimum 70%                             | ✔️     | 72–78% selon exécution                                            |

---

## **Compétence : Débugger une application web pour assurer son bon fonctionnement**

| Indicateur                                                                | Statut | Notes                                      |
| ------------------------------------------------------------------------- | ------ | ------------------------------------------ |
| J’ai migré le projet sur la version LTS ou la dernière version de Symfony | ✔️     | Symfony 6.4 LTS (recommandée OC)           |
| Je suis capable de justifier mon choix de version                         | ✔️     | Symfony 6.4 = stabilité + support long     |
| Le code fonctionne correctement, sans aucun bug                           | ✔️     | CI 100 % vert                              |
| J’ai ajouté une vérification du fichier uploadé                           | ✔️     | Validation Symfony : MIME + taille max 2Mo |
| Message d’erreur explicite si mauvais fichier                             | ✔️     | Affiché via `form_errors()`                |
| Les données sont chargées depuis la base à l’authentification             | ✔️     | Provider configuré dans `security.yaml`    |
| Gestion des invités réservée à Ina                                        | ✔️     | Voter + contrôles BO                       |
| Je suis capable d’expliquer comment j’ai résolu les bugs                  | ✔️     | Documenté dans CONTRIBUTING                |

---

## **Compétence : Documenter une solution informatique**

| Indicateur                                    | Statut | Notes                    |
| --------------------------------------------- | ------ | ------------------------ |
| README clair : prérequis, installation, usage | ✔️     | Version complète fournie |
| Documentation développeur claire              | ✔️     | CONTRIBUTING détaillé    |
| Workflow GitHub expliqué                      | ✔️     | Issues, PR, Code Review  |
| Conseils de maintenance                       | ✔️     | Section dédiée           |

---

## **Compétence : Optimiser la performance d’un site web**

| Indicateur                                          | Statut | Notes                              |
| --------------------------------------------------- | ------ | ---------------------------------- |
| Rapport de performance avec 2 indicateurs           | ✔️     | Temps d’exécution + requêtes SQL   |
| Analyse de chaque page FO                           | ✔️     | Voir rapport ci‑dessous            |
| Justification de l’outil utilisé                    | ✔️     | Symfony Profiler                   |
| Correction des lenteurs sur la page Invités         | ✔️     | Optimisation requêtes + pagination |
| Je suis capable d’identifier l’origine des lenteurs | ✔️     | Requêtes N+1 + absence d’index     |

---

## **Compétence : Déployer un site en production**

| Indicateur                               | Statut | Notes                   |
| ---------------------------------------- | ------ | ----------------------- |
| Pipeline CI passe sans erreur            | ✔️     | GitHub Actions OK       |
| Tests unitaires et fonctionnels exécutés | ✔️     | 28 tests, 46 assertions |
| Outils d’analyse exécutés                | ✔️     | PHPStan + PHPUnit       |

---

# **Lien vers le dépôt GitHub**

**[https://github.com/Alydiabira/0C15](https://github.com/Alydiabira/0C15)**

---

# **2. README.md — VERSION FINALE (PROFESSIONNELLE)**

# **README.md**

````md
# OC15 – Application de Gestion d’Invités et de Médias

Ce projet Symfony permet de gérer des invités, des albums et des médias via un Front Office et un Back Office sécurisé.
Il a été développé dans le cadre du parcours Développeur d’Applications PHP/Symfony – OpenClassrooms.

---

## Pré‑requis

- PHP 8.2+
- Composer 2+
- Symfony CLI (recommandé)
- MySQL 8+ ou MariaDB
- Node.js 18+ (si assets)
- Git

---

## Installation

Clonez le projet :

```bash
git clone https://github.com/votre-repo.git
cd votre-repo
```
````

Installez les dépendances :

```bash
composer install
```

Configurez l’environnement :

```bash
cp .env .env.test
```

Modifiez la base de données :

```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/oc15?serverVersion=8"
```

Créez la base :

```bash
php bin/console doctrine:database:create
```

Appliquez les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

Chargez les fixtures :

```bash
php bin/console doctrine:fixtures:load
```

---

## Lancer l’application

```bash
symfony server:start
```

Accès :

```
http://localhost:8000
```

---

## Accès Back Office

Un utilisateur administrateur est créé via les fixtures :

- Identifiant : `ina`
- Mot de passe : `password`

---

## Tests

Lancer les tests :

```bash
php bin/phpunit
```

Générer la couverture :

```bash
php bin/phpunit --coverage-html coverage/
```

---

## Structure du projet

- `/src/Controller` — Contrôleurs FO & BO
- `/src/Entity` — Entités Doctrine
- `/src/Form` — Formulaires Symfony
- `/src/Repository` — Requêtes Doctrine
- `/tests` — Tests unitaires & fonctionnels
- `/templates` — Vues Twig

---

## Licence

Projet réalisé dans le cadre du parcours OpenClassrooms.
Usage pédagogique uniquement.


