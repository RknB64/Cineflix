<?php

class Utilities
{
    public static function sanitaze(String $input): String
    {

        $input = trim($input);
        $input = addslashes($input);
        $input = filter_var($input);

        return $input;
    }

    public static function alerte(String $message): void
    {
        echo '<script>alert("'.$message.'")</script>';
    }


    public static function formatDate(string $date): string
    {
        return (new DateTime($date))->format('d/m/y');
    }
}
