8Joke Installation
========================

- Création du container de la base de données : 

```
docker run --name mysql -e MYSQL_ROOT_PASSWORD=root -p 4242:3306 -d mysql:5.7
```

- Création de la base de données dans le container :

```
./bin/console  doctrine:database:create
```

- Génération des tables via les entités doctrine :

```
./bin/console  doctrine:schema:update --force
```

- On copie le fichier command.sql contenant les requêtes qui injecteront des données dans la base dans le container :

```
docker cp ./command.sql mysql:/
```

- On exécute les commandes dans le container :

```
docker exec mysql /bin/sh -c 'mysql -u root -proot  <command.sql'
```

Utilisateur par défaut :
- login : admin
- password : test
