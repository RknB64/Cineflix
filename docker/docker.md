# Docker
 
## Set up

- Dans `config.php`, définir la constante :

```php
define('DB_HOST', 'mariadb');
```
- Créer un dossier data dans le dossier docker, s'il n'y en a pas.

## Commandes

Start docker : `docker-compose up -d`

Stop : `docker-compose down`

List docker qui tourne : `docker ps`

## Fonctionnalités

- Appli php accessible à : `localhost:80`
- Myadmin accessible à : `localhost:8080`
- Changement dans le fichier `src` sont appliqués quand on refresh la page
- Données de la bd persitentes
