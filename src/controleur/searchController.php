<?php

// include_once("./modele/MyPdo.php");
// include_once("./modele/SearchBD.php");


class searchController
{
    public function search($villeId)
    {
        $concreteMyPdo = new CinemaBD();
        $cine = new Cinema();
        $cine->id_ville = $villeId;;

        return $concreteMyPdo->selectWhere($cine);

    }
    public function getFilmsByCinemaId($cinemaId)
    {
        $concreteMyPdo = new FilmBD();
        $films = $concreteMyPdo->getFilmsByCinemaId($cinemaId);

        // You can return the films or render a view with the films data
        if (!empty($films)) {
            echo json_encode($films);
        } else {
            echo json_encode(['error' => 'No films found for the specified cinema ID']);
        }
    }
}

$controller = new searchController();

if (isset($_GET['ville_id'])) {

    include './vue/header.html.php';

    // Retrieve the city from the URL parameters
    $villeId = intval($_GET['ville_id']);
    $villeName = $_GET['ville'];

    // Call the search method with the retrieved city
    $results = $controller->search($villeId);

    if (!empty($results)) {
        include './vue/Resultats_recherche.php';
    } else {
         echo "<h1><span style='color: white;'>Aucun cinéma trouvé pour la ville de " .$villeName. "</span></h1>";
    }

    include './vue/footer.html.php';

} elseif (isset($_GET['cinema'])) {
    // Retrieve the cinema ID from the URL parameters
    $cinemaId = $_GET['cinema'];
    // Call the getFilmsByCinemaId method with the retrieved cinema ID
    $controller->getFilmsByCinemaId($cinemaId);
} else {
    // Display an error message if neither city nor cinema parameter is provided
    echo "No city or cinema specified for search.";
}
