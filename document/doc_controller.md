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
- Nom de la page/route suivi de `Controller`
- Exemples : `AccueilController`, `CatalogueCinemaController`, `InscriptionController`

### Nom du fichier controller

- En `PascalCase`
- Même nom que la classe suivi de `.php`
- Exemples : `AccueilController.php`, `CatalogueCinemaController.php`, `InscriptionController.php`

### Nom de la vue associée au controller

- En `cameCase`
- Même nom que la classe sans le Controller et la majuscule de début, suivi de `.php`
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

Défini la **méthode** suivante :
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
- `bool $withHeaderFooter` : si vrai, ajoute le header et le footer avant et après la vue. Vrai par défaut.

## Les classes concrètes

Doivent `extends Controller`.

Définir au début de la classe les attributs utilisés en les classant en trois catégories :
- Les classes de pdo utilisées par le controller (classes qui finissent par BD, AdherentBD, FilmBD...)
- Les variables/classes qui seront transmises à la vue
- Les variables/classes uniquement utilisée par le controller

Exemple :
```php
<?php
class AccueilController extends Controller
{
    // Classes PDO utilisées
    private CinemaBD    $cinemaBD;
    private FilmBD      $filmBD;

    // Variables utilisées par la vue
    private ?array      $results;
    private string      $villeName;

    // Variables utilisées par le controller
    private int         $villeId;
    private int         $cinemaId;

    ...
```

Mettre la logique qui doit être exécutée lors de l'appel du controller dans le constructeur :

```php
<?php
  ...
    public function __construct()
    {
        $this->titre    = 'Page introuvable';
        $this->view     = 'page404';

        $this->data = array(
            'titre' => $this->titre
        );

        $this->render($this->view, $this->data);
    }
  ...
```

### Gérer les controllers qui peuvent à la fois utiliser GET ou POST

Certains controllers peuvent servir des requêtes POST ou GET.  

Dans ce cas, dans la classe :
- Définir un attribut `$requestMethod`
- Ajouter l'argument `string $requestMethod` dans le constructeur

Exemple :

```php
<?php
class InscriptionController extends Controller
{
    ...
    
    // Variables utilisées par le controller
    private string    $requestMethod;
    
    public function __construct(string $requestMethod)
    {
        $this->requestMethod = $requestMethod;
        
        if ($this->requestMethod === 'POST') {
          ...
        } else if ($this->requestMethod === 'GET') {
          ...
        }
        
        ...
```

Le fichier `Index.php` extrait la méthode dans une variable qui est passée au Router :

```php
<?php
$requestMethod = $_SERVER['REQUEST_METHOD'];
```
Ensuite cette variable peut être passé au constructeur du controller depuis le `Router`:

```php
<?php
case 'inscription':
    new InscriptionController($requestMethod);
    break;
```
