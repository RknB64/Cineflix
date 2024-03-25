<?php





class Achat

{   public int  $id_billet;
    public string  $horaire_date ;
    public string  $date_d’achat  ;// format "yyyy-mm-dd"
    public int $nb_places_achetees; 
    public int $id_adherent ; 
    public int $id_seance ; 
}
class AchatBD extends MyPdo 
{
    public const TABLE        = "achat";
    public const ID           = "id";
    public const CLASS_OBJ    = "Achat";

    private static array $columns = array(
        "id_billet",
        "horaire_date",
        "date_achat",
        "nb_places_achetees",
        "id_adherent",
        "id_seance",
       
        
    );

    protected function className() : string
  {
    return self::CLASS_OBJ;
  }

  protected function table() : string
  {
    return self::TABLE;
  }

  protected function columns() : array
  {
    return self::$columns;
  }

  protected function id() : string
  {
    return self::ID;
  }

    
}

// require_once("./modele/DbConnect.php");

// class AchatBD extends DbConnect{
//     private static $table = "achat";
//     public static function getStreams() : array {
//         $db = self::connexion();
//         $result = [];

//         try {
//             $query = $db->query("SELECT * FROM " . self::$table);
//             $result = $query->fetchAll(PDO::FETCH_ASSOC);
//         } catch (PDOException $e) {
//             die("Error fetching achat: " . $e->getMessage());
//         }

//         $db = null;
//         return $result;
//     }

//     public static function addStream($id_billet, $horaire_date, $date_d’achat , $nb_places_achetees,$id_adherent,$id_seance) : bool {
//         $db = self::connexion();

//         try {
//             $query = $db->prepare("INSERT INTO " . self::$table . " (id_billet, horaire_date, date_d’achat , nb_places_achetees,id_adherent,id_seance) 
//                 VALUES (?, ?, ?, ?,?,?)");
//             $query->execute([$id_billet, $horaire_date, $date_d’achat , $nb_places_achetees,$id_adherent,$id_seance]);
//             return true;
//         } catch (PDOException $e) {
//             die("Error adding stream: " . $e->getMessage());
//             return false;
//         }
//     }

//     public static function deleteStream($id_billet) : bool {
//         $db = self::connexion();

//         try {
//             $query = $db->prepare("DELETE FROM " . self::$table . " WHERE id = ?");
//             $query->execute([$id_billet]);
//             return true;
//         } catch (PDOException $e) {
//             die("Error deleting stream: " . $e->getMessage());
//             return false;
//         }
//     }

   
// }