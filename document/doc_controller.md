# Documentation controller

## Nommage du controller et des éléments associés

Pour chaque controller faire correspondre :
- nom de la classe
- nom du fichier
- nom de la vue (s'il y en a une associée au controller)
- nom de l'action

Cela permet de facilement associer un controller aux autres éléments qui lui sont liés 

### Nom des classes controller

- En `PascalCase`.
- Nom de la page/route suive de `Controller`
- Exemples : `AccueilController`, `CatalogueCinemaController`, `InscriptionController`

### Nom du fichier controller

- En `PascalCase`
- Même nom que la classe suive de `.php`
- Exemples : `AccueilController.php`, `CatalogueCinemaController.php`, `InscriptionController.php`

### Nom de la vue associée au controller

- En `cameCase`
- Même nom que la classe sans le Controller et la majuscule de début, suivie de `.php`
- Exemples : `accueil.php`, `catalogueCinema.php`, `inscription.php`

### Nom de l'action associée au controller

- En `cameCase`
- Même nom que la classe sans le Controller et la majuscule de début
- Exemples : `action=accueil`, `action=catalogueCinema`, `action=inscription`

## La classe abstraite Controller

Classe que les controller doivent `extends`.

Déclare les **variables** suivante qui seront initialisée dans la classe concrète :
- `string $titre` : Le titre de la page
- `string $view` : La vue associée à la page
- `array $data` : Une array de clés/valeurs avec les variables qui seront transmises à la vue

Déclare la **méthode** suivante :
- `render` : qui permet d'inclure la vue et lui passer les variables nécessaires à son affichage

### $data

`Array` de clés et valeurs qui comporte les variables que le fichier vue utilise :
- `clé` : nom de la variables comme dans la vue
- `valeur` : valeur de la variable

Cette array est ensuite passée en argument de la fontion `render` pour transmettre ces variables à la vue.

Exemple :

```php
// dans le controller
<?php
$this->data = array(
    'titre'         => $this->titre,
    'nomFilm'       => $this->nomFilm,
    'villesListe'   => $this->villesListe,
);
$this->render($this->view, $this->data);
?>

// dans la vue
<h1> <?php echo $nomFilm?> </h1>
<?php foreach ($villesListe as $key => $ville): ?>
...
```

### fonction render

Affiche une page en lui passant les variables définies dans `$data`.  
Il n'y a pas besoin d'ajouter le header et footer séparément, ils sont ajoutés par défaut

```php
<?php
static protected function render(string $view, array $data = [], bool $withHeaderFooter = true): void
```
Arguments :
- `string $view` : le nom de la vue à afficher **sans le .php**. Exemple : `accueil`, `inscription`
- `array $data` : array de clé/valeur
- `boo $withHeaderFooter` : si vrai, ajoute le header et le footer avant et après la vue. Vrai par défaut.

## Les classes concrètes


### Gérer les controllers qui peuvent à la fois utiliser GET ou POST

## Utilisation
