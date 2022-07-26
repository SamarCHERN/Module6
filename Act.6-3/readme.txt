Leçon 6.2 : Exposer Une API Rest Avec Symfony

#Installation:

	Cloner le projet :git clone "https://github.com/SamarCHERN/Module6.git"
	Installer les dépendances : composer install
	Créer une base de données: php bin/console d:d:c
	Jouer les migrations : php bin/console make:migration puis php bin/console d:m:m
	Lancer le server : php bin/console server:run 

#Installation du bundle pour la gestion des JWT:

	Lancer composer require lexik/jwt-authentication-bundle
	Générer une clé publique et privée avec une passphrase à reporter dans le .env:
		$ mkdir -p config/jwt
		$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
		$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubot

#Routes:
Les différentes routes à exécuter via des verbes HTTP en utlisant Postman:
	@GET("/articles"):  pour récupérer tous les articles
	@GET("/article"):  pour récupérer les 3 derniers articles
	@GET("/articles/{id}):  pour récupérer l’article {id}
	@POST("/article"):  pour  insèrer un nouvel article
	@Put("/article/{id}):  pour modifier un article {id}
	@Delete("/article/{id}):  pour supprimerr l’article {id}