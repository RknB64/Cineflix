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
