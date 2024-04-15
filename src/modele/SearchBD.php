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
            $query = $db->prepare("SELECT cinema.*
            FROM cinema
            INNER JOIN film ON cinema.id = film.id
            INNER JOIN ville ON cinema.id_ville = ville.id
            WHERE ville.nom = :ville"
        );

    
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
 

public function getFilmsByCinemaId($cinemaId) {
    $db = self::connexion();
    try {
        // Prepare the SQL query to fetch films based on cinema ID
        $query = $db->prepare("SELECT film.*
                               FROM cinema
                               INNER JOIN salle ON cinema.id = salle.id_cinema
                               INNER JOIN seance ON salle.id = seance.id_salle
                               INNER JOIN film ON seance.id_film = film.id
                               WHERE cinema.id = :cinemaId");
        
        // Bind the cinema ID parameter
        $query->bindParam(':cinemaId', $cinemaId, PDO::PARAM_INT);
        
        // Execute the query
        $query->execute();
        
        // Fetch the results
        $films = $query->fetchAll(PDO::FETCH_OBJ);
        
        // Return the films data
        return $films;
    } catch (PDOException $e) {
        // Handle any potential errors
        die("Error: " . $e->getMessage());
    }
}

    
  
    

}
