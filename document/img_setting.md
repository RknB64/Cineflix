# Img setting


Pour pouvoir ajouter une image depuis la page admin il faut modifier les autorisations du server :

```bash
chown -R www-data:www-data /var/www/html/static/img/

chmod 755 /var/www/html/static/img/
```
