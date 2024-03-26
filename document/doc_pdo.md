# Doc pdo

## Créer une nouvelle table dans la pdo

1. Copier coller le contenue de SalleBD.php
2. Renomer en <table>BD.php
3. Dans la première classe, remplacer/ajouter les méthodes pour avoir les mêmes que dans la base de donnée. Il est important que le nom des variables soit le même que le nom des champs de la bd

```php
class <Table>
{
  public int    $id; // remplacer $id par $<nomChampBD>
  public int    $id_film;
  public int    $id_salle;
  public string $horaire_date;
}
```
> `!!` le nom des variables doivent être exactement les mêmes que dans la base de donnée.
 
4. Dans la deuxième classe qui fini par BD, remplacer les constantes par celle de la nouvelle table :

```php
class <TableBD> extends MyPdo
{
  public const TABLE        = "<nom de la table>"; 
  public const ID           = "<nom du champ id dans la bd>";
  public const CLASS_OBJ    = "<nom de la classe modifier dans l'étape 3>";
}
```

5. Modifier dans l'array `$columns` les valeurs pour correspondre au nom des camps dans la tables `sans` inclure l'id primaire.

```php
private static array $columns = array(
  "id_film",
  "id_salle",
  "horaire_date"
);

```
> `!!` le nom des champs doivent être exactement les mêmes que dans la bd
> `!!` ne pas inclure la clef primaire dedans. Par exemple si id est clef primaire, ne pas inclure.

6. Vérifier qu'il y a bien toutes les fonctions abstraites de la classe `MyPdo` (table(), id(), columns(), className()). Leur implémentation est la même pour toutes les classes concrêtes donc il faut juste copier/coller.


## Utilisations

### Create

Par exemple ajouter une salle
```php
<?php
// instancier classe BD
$sbd = new SalleBD();

// créer un objet salle 
$salle1 = new Salle();

// il n'y a pas de constructeur donc il faut ajouter chaque valeur après
$salle1->id_film = 2;
$salle1->id_salle = 3;
$salle1->horaire_date = "...";

// on ajoute l'objet salle dans la bd avec la classe BD
$sbd->add($salle1)
```
### Update

Par exemple pour update une salle

```php
<?php
// instancier classe BD
$sbd = new SalleBD();

// on récupère la salle à modifier dans un objet salle
$salleModif = new Salle();
$salleModif = $sbd->selectById(2); // où utiliser un selectWhere()

// on modifie un ou plusieurs élément de l'objet salle (par exemple l'id cine)
$salleModif->id_salle = 2;

// on modifie dans la bd
$sbd->update($salleModif);
```

## Override

Il est possible d'override les méthodes de la classe `MyPdo` dans les classes filles. Et tout de même utiliser l'implémentation de la classe `MyPdo`.
C'est utile pour ajouter une étape de vérification des valeurs.

Par exemple, override la fonction add pour adherent afin d'ajouter des valeurs par défaut avant d'appeler la fonction de la classe parrent :

```php
<?php

    // @Override
    // ajoute les valeurs par défaut avant de faire la requête
    public function add(object $ad): bool
    {
        $ad->compte = "ad";
        $ad->date_creation = date('Y-m-d H:i:s');
        $ad->points = 0;

        return parent::add($ad);
    }
``` 

## Limites

- Fonctionne pas avec les clefs primaires composées (mais surement adaptable)
- Pour des `select` très spécifique, il faut créer des fonctions dans les classes concrêtes (qui finissent par BD).
