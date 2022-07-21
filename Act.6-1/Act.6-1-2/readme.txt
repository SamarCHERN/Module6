Leçon 6.1 : Client REST

# On clone le dépot 
https://github.com/SamarCHERN/Module6.git

# On installe les dépendances:
composer install

# On lance le serveur
php bin/console server:run

Pour exécuter le code voici les différentes routes pour réaliser des actions HTTP sur "https://jsonplaceholder.typicode.com/" :

@Route ("/"): GET/posts
@Route ("/blog/{id}"): GET    /posts/id
@Route ("/post/{id}"): 	GET    /posts?userId=1
@Route ("/blog/{id}/comments"):GET  /posts/id/comments
@Route ("/comments/{postid}"): GET  /posts/comments?postId=id
@Route ("/post"): POST	/posts
@Route ("/put/{id}"): PUT	/posts/id
@Route ("/patch/{id}"):PATCH	/posts/id
@Route ("/delete/{id}"):DELETE	/posts/id