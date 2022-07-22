Leçon 6.2 : Exposer Une API Rest Avec Symfony

Cloner le projet :git clone "https://github.com/SamarCHERN/Module6.git"
Installer les dépendances : composer install
Créer une base de données: php bin/console d:d:c
Jouer les migrations : php bin/console make:migration puis php bin/console d:m:m
Lancer le server : php bin/console server:run 

Les différentes routes à exécuter via des verbes HTTP sur "http://127.0.0.1:8000" en utlisant Postman:
@GET("/articles"):  pour récupérer tous les articles
@GET("/article"):  pour récupérer les 3 derniers articles
@GET("/article/lire/{id}):  pour récupérer l’article {id}
@POST("/article"):  pour  insèrer un nouvel article
@Put("/article/{id}):  pour modifier un article {id}
@Delete("/article/{id}):  pour supprimerr l’article {id}