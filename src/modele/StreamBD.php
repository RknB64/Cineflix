
<?php

final class Stream

{   public int  $id;
    public int  $id_film;
    public int  $id_adherent ;
    public string $date_achat; // format "yyyy-mm-dd"
    public string $date_expiration ; 
}
class StreamBD extends MyPdo 
{
    public const TABLE        = "stream";
    public const ID           = "id";
    public const CLASS_OBJ    = "Stream";

    private static array $columns = array(


        "id_film",
        "id_adherent",
        "date_achat",
        "date_expiration",
        
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


// require_once("DbConnect.php");

// class StreamBD extends DbConnect {
//     private static $table = "stream";

//     public static function getStreams() : array {
//         $db = self::connexion();
//         $result = [];

//         try {
//             $query = $db->query("SELECT * FROM " . self::$table);
//             $result = $query->fetchAll(PDO::FETCH_ASSOC);
//         } catch (PDOException $e) {
//             die("Error fetching streams: " . $e->getMessage());
//         }

//         $db = null;
//         return $result;
//     }

//     public static function addStream($id_film, $id_adherent, $date_expiration, $date_achat) : bool {
//         $db = self::connexion();

//         try {
//             $query = $db->prepare("INSERT INTO " . self::$table . " (id_film, id_adherent, date_expiration, date_achat) 
//                 VALUES (?, ?, ?, ?)");
//             $query->execute([$id_film, $id_adherent, $date_expiration, $date_achat]);
//             return true;
//         } catch (PDOException $e) {
//             die("Error adding stream: " . $e->getMessage());
//             return false;
//         }
//     }

//     public static function deleteStream($stream_id) : bool {
//         $db = self::connexion();

//         try {
//             $query = $db->prepare("DELETE FROM " . self::$table . " WHERE id = ?");
//             $query->execute([$stream_id]);
//             return true;
//         } catch (PDOException $e) {
//             die("Error deleting stream: " . $e->getMessage());
//             return false;
//         }
//     }

   
// }
?>
