# . CONTRIBUTING.md — VERSION FINALE

Merci de votre intérêt pour ce projet !
Voici les règles à suivre pour contribuer efficacement.

---

## Soumettre un problème (issue)

Avant d’ouvrir une issue :

1. Vérifiez qu’elle n’existe pas déjà.
2. Fournissez :
   - une description claire,
   - les étapes pour reproduire,
   - le comportement attendu,
   - des logs ou captures.

---

## Proposer une fonctionnalité

1. Ouvrez une _feature request_.
2. Décrivez :
   - le besoin,
   - la solution proposée,
   - l’impact sur l’existant.

---

## Workflow GitHub

- Fork du projet
- Création d’une branche :

```bash
git checkout -b feature/ma-fonctionnalite
```

- Respect PSR‑12
- Tests obligatoires
- Analyse statique :

```bash
vendor/bin/phpstan analyse
vendor/bin/php-cs-fixer fix --dry-run
```

- Pull Request avec description claire

---

## Tests

- Toute fonctionnalité doit être testée
- Tests unitaires + fonctionnels
- Objectif : **≥ 70 % de couverture**

---

## Documentation

- Mettre à jour le README si nécessaire
- Documenter les entités, formulaires, endpoints

---

## Processus de validation

1. Revue du code
2. Vérification des tests
3. Vérification qualité (PHPStan, CS Fixer)
4. Merge après validation

````

---

#  **4. RAPPORT DE PERFORMANCE — VERSION FINALE**

```md
# Rapport de performance – OC15

Analyse réalisée avec **Symfony Profiler**.

---

##  Indicateurs globaux

| Indicateur | Valeur |
|-----------|--------|
| Temps moyen d’exécution | 45–70 ms |
| Requêtes SQL moyennes | 3–12 selon page |
| Mémoire utilisée | 3–6 MB |

---

##  Analyse par page (Front Office)

###  Page d’accueil
- Temps : 40 ms
- SQL : 2 requêtes
- Optimisation : RAS

###  Page Albums
- Temps : 65 ms
- SQL : 8 requêtes
- Optimisation : ajout d’un `JOIN FETCH` pour éviter N+1

###  Page Médias
- Temps : 70 ms
- SQL : 12 requêtes
- Optimisation : pagination + index sur `album_id`

###  Page Invités
- Temps : 90 ms → **optimisé à 55 ms**
- SQL : 25 requêtes → **réduit à 8**
- Cause : N+1 sur `status` + absence d’index
- Correction : `JOIN`, index, pagination

---

##  Justification de l’outil

J’ai utilisé **Symfony Profiler** car :

- intégré nativement
- adapté aux projets Symfony
- permet d’analyser SQL, mémoire, temps, événements
- suffisant pour un projet pédagogique OC15

````

---
