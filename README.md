Quoty
=======
Symfony 2.3 Website
-----------

**Quoty** est une petite application utilisant le framework Symfony 2.3 (standard edition)

Le projet a été généré grâce à Composer


Un lien vers le projet en ligne est disponible ici :

http://quoty.alwaysdata.net

Ce projet n'est pas :

 - Un site commercial.
 - Un projet étudiant.

Ce projet est :

 - Une preuve de ma connaissance du framework.
 
J'ai pu expérimenté :

- L'ORM Doctrine
- Le bundle de gestion des utilisateurs FOSUserBundle
- Le templating Twig
								
								
J'ai utilisé les commandes fournies par la console php de Symfony,
pour générer les Bundles, les Controllers, les Entities, les Form ... 
L'utilisation des Fixtures, des Annotations de validation, 
ou un peu de templating avec Twig ne me fait pas peur !


Pour synthétiser, je sais gérer les bases de la création de nouveaux composants, la gestion des utilisateurs (authentification et autorisation)


J'ai les bases pour démarrer ou rejoindre un projet utilisant Symfony2.
L'expertise viendra avec le temps !


Principe du site
---------------


Ce site est un site pour poster des citations.
On peut :

- S'inscrire
- Se connecter
- Poster jusqu'à 5 Citations ; après cela, le compte est désactivé.
- Un utilisateur au rang Super Admin peut supprimer ou modifier des citations existantes.

** Important **

Si un utilisateur est déjà enregistré (email ou pseudo déjà pris), il y a une erreur
qui n'est pas géré suite au fait que ma version de Symfony est antérieure à la gestion du bug
dans le FOSUserBundle : https://github.com/FriendsOfSymfony/FOSUserBundle/issues/1516

Les citations normalement peuvent être identiques.


