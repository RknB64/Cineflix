<?php

require_once("./modele/FilmBD.php");
require_once("./modele/StreamBD.php");

class ReadCtrl
{
    public function getFilm()
    {
        return FilmBD::getFilms('film');
    }

    public function getStream()
    {
        return StreamBD::getStreams('stream');
    }
}

$read = new ReadCtrl();


$table = isset($_GET['table']) ? $_GET['table'] : 'admin';


// Load the data based on the selected table
switch ($table) {
    case 'stream':
        $data = $read->getStream();
        break;
    default:
        $data = $read->getFilm();
        break;
}


include("vue/admin/Crud_vue.php");
?>
