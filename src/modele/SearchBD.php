<?php
class SearchBD extends MyPdo {

    protected function table(): string {
    
        return 'your_table_name';
    }

    protected function id(): string {
       
        return 'your_id_column_name';
    }

    protected function columns(): array {
     
        return ['column1', 'column2', 'column3']; 
    }

    protected function className(): string {

        return 'YourClassName'; 
    }

    public function Search_selon_Ville($ville): ?array {
        $db = self::connexion();
        try {
            $query = $db->prepare("SELECT *
            FROM film
            INNER JOIN seance ON seance.id_film = film.id
            INNER JOIN salle ON seance.id_salle = salle.id
            INNER JOIN cinema ON cinema.id = salle.id_cinema
            INNER JOIN ville ON ville.id = cinema.id_ville
            WHERE ville.nom = :ville");
    
            // Bind the parameter using named parameter syntax
            $query->bindParam(':ville', $ville, PDO::PARAM_STR);
    
            $query->execute();
    
            // Fetch the results
            $resultat = $query->fetchAll(PDO::FETCH_OBJ);
    
            // Check if there are any results
            if ($resultat) {
                return $resultat;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            die("Erreur !: " . $e->getMessage());
        }
    }
    
    
}
