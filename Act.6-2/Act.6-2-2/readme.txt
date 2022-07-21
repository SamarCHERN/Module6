Suite Leçon 6.2 : Exposer Une API Rest Avec Symfony

# On clone le dépot 
https://github.com/SamarCHERN/Module6.git

# On installe les dépendances:
composer install

# On lance le serveur
php bin/console server:run

Pour exécuter le code voici les différentes routes pour réaliser des actions HTTP sur l’API creé :

Les différentes routes à exécuter :
@Route("/"):  pour récupérer tous les articles
@Route("/blog/{id}"):  pour récupérer l’article {id}
@Route("/post"):  pour  insèrer un nouvel article
@Route("/put/{id}):  pour modifier un article {id}
@Route("/article/{id}):  pour supprimer l’article {id}
