Leçon 6.3 : Sécuriser Son API Rest

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
		$ openssl genrsa -out config/jwt/private.pem -aes256 4096
		$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubot
#Postman

	générer le token : envoyer une requete POST à /api/login_check avec le données suivant :

		body : { "username":"admin@talan.com","password":"admin123"}
		header : Content-Type : application/json

	Les différentes routes à exécuter via des verbes HTTP :
		@GET("/articles"):  pour récupérer tous les articles (non sécurisée)
		@GET("api/article"):  pour récupérer les 3 derniers articles
		@GET("api/articles/{id}):  pour récupérer l’article {id}
		@POST("api/article/"):  pour  insèrer un nouvel article
		@Put("api/article/{id}):  pour modifier un article {id}
		@Delete("api/article/{id}):  pour supprimerr l’article {id}