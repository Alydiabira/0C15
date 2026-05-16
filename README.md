# Ina Zaoui

Pour se connecter avec le compte de Ina, il faut utiliser les identifiants suivants:
- identifiant : `ina`
- mot de passe : `password`

Vous trouverez dans le fichier `backup.zip` un dump SQL anonymisé de la base de données et toutes les images qui se trouvaient dans le dossier `public/uploads`.
Faudrait peut être trouver une meilleure solution car le fichier est très gros, il fait plus de 1Go.



Option B - Mission (cas fictif)



#Pourquoi réaliser cette mission ?



 

La mission de ce projet vous permettra de consolider des compétences acquises tout au long de votre formation. En mettant en pratique les concepts et les techniques abordés dans les projets précédents, vous aurez l'opportunité de renforcer votre compréhension de divers aspects du développement web.

 

Ce projet vous offre également l'occasion de développer votre sens de l'autonomie et de la responsabilité en tant que professionnel du développement : 

en travaillant sur l'implémentation de nouvelles fonctionnalités et la correction des bugs, vous apprendrez à gérer votre temps et vos priorités tout en respectant les délais impartis. ;
la rédaction de la documentation et la mise en place d'une pipeline d'intégration continue renforceront vos compétences en communication et en collaboration, des qualités essentielles dans un environnement professionnel.
 

#Découvrez votre mission



 

En tant qu’indépendant, vous venez de décrocher un nouveau contrat de prestation pour Ina Zaoui, une photographe spécialisée dans les photos de paysages du monde entier. Elle est connue pour son mode de déplacement eco-friendly (à dos d'animal, à pied, en vélo ou bateau à voile et montgolfière...).

 

Il vous est demandé de mettre à jour et corriger son site. Vous remplacez la personne chargée du développement et de la maintenance du site, le temps qu’Ina trouve un remplaçant permanent.

 

Elle vous envoie des informations pour cette mission :

 

De : Ina Zaoui

À : moi

Sujet : Mise à jour du site
Bonjour, 

 

Ravie que tu sois disponible pour prendre le relais du site ! Voici plus d’informations sur le site et ce qu’on attend de toi :

 

Tu verras que le site date un peu et n’a jamais été mis à jour depuis plusieurs années. Ton prédécesseur m’a indiqué avant de partir qu’il serait préférable de mettre à niveau le site pour éviter de potentiels problèmes de sécurité. 

 

La dernière fonctionnalité qui a été ajoutée au site, c’est la possibilité de promouvoir de jeunes photographes sur mon site. Mais d’après mon ancien développeur, il y aurait encore des points à régler, en plus de ça j’ai pu identifier quelques problèmes sur le site.

 

Je suis en train de finaliser le contrat d’Ingrid, notre nouvelle développeuse en interne, mais elle prendra le poste d’ici un mois. Afin de l’accueillir dans de bonnes conditions, pourrais-tu rédiger la documentation nécessaire pour lui faciliter son intégration sur ce projet ?

 

Enfin, ton prédécesseur m’avait parlé d’un processus super intéressant, l’intégration continue. A priori, ça me permettrait de m'assurer que chaque mise à jour ne provoque pas d’erreur. Par contre, il m’avait prévenu que c’était une tâche relativement compliquée, du coup il n’a pas eu le temps de travailler dessus avant de partir. Tu penses pouvoir m’aider à ce sujet-là ?

 

Je te rassure, tu trouveras la note de cadrage en pièce jointe, rédigée avec le développeur et moi-même. Je te partage également le repository du site sur Github, ainsi que le fichier back-up pour te connecter sur mon compte.

 

Une fois les modifications effectuées, tu peux me partager le code dans un repository Github et le rapport de performance en PDF.

 

Merci, je suis à ta disposition si tu as des questions !

Ina
Pièce jointe : 

Note de cadrage
 

Pour vous aider à mener à bien cette mission, vous pouvez suivre les étapes décrites ci-dessous.
Étapes

Avant de commencer le travail, prenez le temps de lire l’ensemble des documents du projet :

Consultez le code source du projet afin de vous familiariser avec le projet avant de le cloner et l’installer. 
Lisez la note de cadrage pour connaître les tâches à réaliser.
Enfin, lisez la grille d'auto-évaluation du projet, pour vous assurer d’avoir bien compris l’ensemble des attentes du projet.
 

Recommandations

De nombreuses choses sont à mettre en place sur le projet, comme :

la correction d’anomalies, 
la rédaction de la documentation, 
l’implémentation de tests et de nouvelles fonctionnalités, 
la mise en place de l’intégration continue. 
 

Prenez le temps de découper toutes les étapes, essayez d’avoir une granularité la plus fine possible pour ne pas vous laisser déborder par la charge de travail, parfois une petite tâche peut s’avérer beaucoup plus complexe qu’il n’y paraît.

 

Il est fortement conseillé de présenter votre plan à votre mentor avant de commencer vos développements. Cela vous permettra de mieux aborder la suite du projet et vous aidera à mieux concevoir votre solution.

Il est temps de passer à l’action : la migration vers une version plus récente de Symfony. 

 

Recommandation

Consultez la documentation officielle pour comprendre les modifications apportées au framework et les éventuelles incompatibilités avec la version actuelle de votre projet. Cette compréhension vous aidera à planifier votre migration et à justifier vos choix.
 

Ressources

La documentation Upgrading a Major Version (e.g. 5.4.0 to 6.0.0) de Symfony.
Dans cette étape de votre projet, vous vous attaquerez à la résolution de quelques anomalies importantes. 

 

En effet, votre application présente actuellement des lacunes en ce qui concerne :

la vérification des fichiers uploadés :
la gestion dynamique des connexions depuis la base de données. 
 

Ressources

La documentation de Symfony est assez complète sur la gestion des images. Dernièrement, une nouveauté est apparue avec la version 7.1 de Symfony pour faciliter la gestion de l’upload.
La notion que vous chercherez pour cette problématique est “User Provider”, et Symfony propose une documentation très claire sur le sujet.
Les anomalies résolues, il est temps d'implémenter de nouvelles fonctionnalités pour enrichir l'expérience utilisateur de l'application.

 

Pour réaliser cette tâche, découpez-la en sous-tâches :

Concevez l'interface de gestion des invités, accessible uniquement à l'administrateur (Ina).
Ajoutez une page listant l’ensemble des invités.
Mettez en place la fonctionnalité permettant à Ina de :
ajouter de nouveaux invités ;
bloquer l’accès d’un invité ;
Intégrez un mécanisme permettant à Ina de révoquer l'accès des invités sélectionnés, ce qui entraînera le non-affichage de leurs photos sur la plateforme, et l’impossibilité de se connecter sur leur accès.
Ajouter la possibilité de supprimer un invité, sans oublier la suppression en cascade du contenu associé.
Vérifiez maintenant que le site marche comme voulu.

 

Soyez attentif à la pertinence des tests implémentés. Un test doit ajouter de la valeur au projet, mais pas seulement, ça permet aussi de documenter naturellement le code du projet. 

 

Voici les étapes à suivre pour mener à bien cette étape :

Ajoutez des fixtures : Créez un jeu de données de tests représentatif de différents scénarios d'utilisation de votre application. Ces données serviront de base pour vos tests unitaires et fonctionnels.
Implémentez les tests : 
Utilisez PHPUnit pour écrire des tests unitaires et fonctionnels qui couvrent l'ensemble des fonctionnalités du Front Office de votre application. 
Assurez-vous que votre suite de tests atteint un taux de couverture de code d'au moins 70 % pour garantir une validation efficace du comportement de votre application.
L’application maintenant testée, vous vous concentrez sur la performance. La performance est un sujet qui ne doit jamais être mis de côté. Assurer une bonne expérience pour les utilisateurs du site est très important. 

 

Dans un premier temps, il vous est demandé d’identifier les facteurs provoquant des lenteurs sur la page “Invités”. 

 

Vous pouvez utiliser le Web Profiler de Symfony afin de repérer la source des lenteurs. D’autres outils plus complets existent également qui peuvent répondre à cette problématique, comme New Relic. Vous devez aussi tester le temps d’affichage des pages Front Office.

 

Ensuite, vous devez appliquer les corrections nécessaires pour garantir un chargement de la page plus rapide.

 

Dans un second temps, vous devrez rédiger un rapport de performance. Vous testerez le temps d’affichage des pages Front Office après la correction des lenteurs sur la page “Invités”. Comme expliqué dans la note de cadrage, vous avez une totale liberté sur l’outil et le contenu du document.

 

Avant de vous lancer dans ce rapport de performance : 

Prenez le temps de choisir l’outil qui vous semble le plus approprié.
Lisez les indicateurs que vous devrez analyser pour chaque page. 
Vous passez à la documentation pour préparer la passation avec le nouveau développeur.

 

Commencez par rédiger un fichier README.md clair et concis qui présente :

Pré-requis ;
Installation ;
Usage.
 

Ensuite, écrivez un fichier CONTRIBUTING.md détaillant les directives pour contribuer au projet. Incluez les informations sur la manière de :

soumettre des problèmes, 
proposer des fonctionnalités,
contribuer au code, aux tests, et à la documentation.
 

Ressource

L’article How to Write a Good README File for Your GitHub Project (en anglais) qui explique comment rédiger un fichier README.md complet.
Enfin, vous pouvez préparer le déploiement du site.

 

Pour réaliser cette étape, rappelez-vous de ce que vous avez fait dans le projet précédent :

Créer la base de la configuration ;
Ajouter l'exécution des tests ;
Ajouter l'exécution des outils d'analyse statique.
 

N’hésitez pas à tester chacune de ces étapes.

Prenez du recul sur votre travail

Une fois votre travail terminé, prenez du recul sur cette activité :

Quelles tâches avez-vous réalisées ?
Qu'avez-vous appris à faire ?
Quels ont été les points de difficulté ?
 

Pour répondre à ces questions, remplissez cette grille d'auto-évaluation.

 

Cette mission fait l’objet d’une soutenance durant laquelle vous présenterez vos livrables à un évaluateur. Pour savoir comment mener à bien cette soutenance, rendez-vous sur la page Evaluation.
 

Ça y est, vous êtes prêt à passer à la suite !