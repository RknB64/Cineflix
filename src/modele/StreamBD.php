<?php

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

    protected function className(): string
    {
        return self::CLASS_OBJ;
    }

    protected function table(): string
    {
        return self::TABLE;
    }

    protected function columns(): array
    {
        return self::$columns;
    }

    protected function id(): string
    {
        return self::ID;
    }

    public function selectAdherentFilmsStreaming(Adherent $adherent): ?array
    {
        $db = self::connexion();
        $resultat = null;

        try {
            $query = $db->prepare("SELECT * FROM " . $this->table() . " WHERE id_adherent = " . $adherent->id .
                " AND date_expiration >= NOW(6) ORDER BY date_achat DESC;");
            $query->execute();

            while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {

                $resultat[] = $this->createObject($ligne);
            }
        } catch (PDOException $e) {
            die("Erreur !: " . $e->getMessage());
        } finally {
            $db = null;
        }

        return $resultat;
    }
}
