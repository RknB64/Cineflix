# Doc autoload

Le fichier `/src/cls/autoload.php` permet de charger automatiquement les classes sans require ou include.
Marche quand on fait un `new` ou un appel `static` à une classe.

> `!!` ne marche que pour les classes (static ou non). pour un fichier qui ne comporte que des fonctions/html/js... il faut toujours faire un require.

## Usage

Le fichier de configuration définie une constante `AUTOLOAD` qui donne le chemin vers le fichier.
Il y a juste à ajouter `require_once AUTOLOAD;` en haut du fichier `index.php` et tout devrais marcher.

Si jamais il y a des erreurs de classe non trouvée, essayer de rajouter `require_once AUTOLOAD;`, en haut du fichier d'où provient le problème.

## Code

Utilise la fonction `spl_autoload_register` de php qui prend une autre fonction en paramètre.

```php
<?php
spl_autoload_register("autoloadFunction");
```
À chaque fois qu'un appel à une classe est effectué dans le code, la fonction passée en paramètre est appelée.

Cette fonction `autoloadFunction` prend en paramètre le nom de la classe demandée et va chercher de manière récursive dans les dossiers du projet la classe en question.
