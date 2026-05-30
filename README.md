# Ina Zaoui

Pour se connecter avec le compte de Ina, il faut utiliser les identifiants suivants:

- identifiant : `ina`
- mot de passe : `password`

Vous trouverez dans le fichier `backup.zip` un dump SQL anonymisé de la base de données et toutes les images qui se trouvaient dans le dossier `public/uploads`.
Faudrait peut être trouver une meilleure solution car le fichier est très gros, il fait plus de 1Go.

# OC15 – Application de Gestion d’Invités et de Médias

Ce projet Symfony permet de gérer des invités, des albums et des médias via un Front Office et un Back Office sécurisé.  
Il a été développé dans le cadre du parcours Développeur d’Applications PHP/Symfony – OpenClassrooms.

---

## 🚀 Pré-requis

- PHP 8.2+
- Composer 2+
- Symfony CLI (recommandé)
- MySQL 8+ ou MariaDB
- Node.js 18+ (si assets)
- Git

---

## 🛠️ Installation

Clonez le projet :

````bash
git clone https://github.com/votre-repo.git
cd votre-repo


---

# 🧩 README.md — Structure complète et professionnelle

---

# 📌 **README.md**

```md
# OC15 – Application de Gestion d’Invités et de Médias

Ce projet Symfony permet de gérer des invités, des albums et des médias via un Front Office et un Back Office sécurisé.
Il a été développé dans le cadre du parcours Développeur d’Applications PHP/Symfony – OpenClassrooms.

---

## 🚀 Pré-requis

- PHP 8.2+
- Composer 2+
- Symfony CLI (recommandé)
- MySQL 8+ ou MariaDB
- Node.js 18+ (si assets)
- Git

---

## 🛠️ Installation

Clonez le projet :

```bash
git clone https://github.com/votre-repo.git
cd votre-repo
````

Installez les dépendances :

```bash
composer install
```

Créez le fichier d’environnement :

```bash
cp .env .env.local
```

Configurez la base de données dans `.env.local` :

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

## ▶️ Lancer l’application

```bash
symfony server:start
```

L’application sera disponible sur :

```
http://localhost:8000
```

---

## 🧪 Tests

Lancer la suite de tests :

```bash
php bin/phpunit
```

Générer la couverture :

```bash
php bin/phpunit --coverage-html coverage/
```

---

## 📂 Structure du projet

- `/src/Controller` — Contrôleurs FO & BO
- `/src/Entity` — Entités Doctrine
- `/src/Form` — Formulaires Symfony
- `/src/Repository` — Requêtes Doctrine
- `/tests` — Tests unitaires & fonctionnels
- `/templates` — Vues Twig

---

## 🔐 Accès Back Office

Un utilisateur administrateur est créé via les fixtures :

- Email : `ina@test.com`
- Mot de passe : `password`

---

## 📄 Licence

Projet réalisé dans le cadre du parcours OpenClassrooms.  
Usage pédagogique uniquement.

````

---

# 🧩 CONTRIBUTING.md — Version complète et professionnelle

---

# 📌 **CONTRIBUTING.md**

```md
# Guide de contribution

Merci de votre intérêt pour ce projet !
Voici les règles à suivre pour contribuer efficacement.

---

## 🐛 Soumettre un problème (issue)

Avant d’ouvrir une issue :

1. Vérifiez qu’elle n’existe pas déjà.
2. Fournissez :
   - une description claire du problème,
   - les étapes pour le reproduire,
   - le comportement attendu,
   - des captures ou logs si nécessaire.

Créez ensuite une issue via GitHub.

---

## 💡 Proposer une nouvelle fonctionnalité

1. Ouvrez une issue de type *feature request*.
2. Décrivez :
   - le besoin,
   - la solution proposée,
   - l’impact sur l’existant.

Attendez la validation avant de commencer le développement.

---

## 🧑‍💻 Contribuer au code

### Règles :

- Forkez le projet.
- Créez une branche dédiée :

```bash
git checkout -b feature/ma-fonctionnalite
````

- Respectez les standards PSR-12.
- Ajoutez des tests (unitaires et/ou fonctionnels).
- Vérifiez que la suite de tests passe :

```bash
php bin/phpunit
```

- Faites une Pull Request claire :
  - description,
  - justification,
  - captures si nécessaire.

---

## 🧪 Contribuer aux tests

- Chaque nouvelle fonctionnalité doit être testée.
- Les tests doivent couvrir :
  - entités,
  - formulaires,
  - contrôleurs FO,
  - repositories.
- Objectif : **≥ 70 % de couverture**.

---

## 📘 Contribuer à la documentation

- Mettez à jour le README si nécessaire.
- Documentez les endpoints, les formulaires, les entités.
- Ajoutez des commentaires pertinents dans le code.

---

## ✔️ Processus de validation

1. Revue du code par un mainteneur.
2. Vérification des tests.
3. Vérification de la qualité du code.
4. Merge après validation.

Merci pour votre contribution !

```

```
