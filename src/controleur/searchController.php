<?php

include_once("./modele/MyPdo.php");
include_once("./modele/SearchBD.php");


class searchController
{
    public function search($ville)
    {
        $concreteMyPdo = new SearchBD();

        $results = $concreteMyPdo->Search_selon_Ville($ville);

        if (!empty($results)) {
            //  var_dump($results);
            include './vue/header.html.php';
            include './vue/Resultats_recherche.php';
        } else {
            echo "<h1><span style='color: red;'>Aucun résultat trouvé.</span></h1>";

        }
    }
    public function getFilmsByCinemaId($cinemaId) {
        $concreteMyPdo = new SearchBD();
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
if(isset($_GET['ville'])) {
    // Retrieve the city from the URL parameters
    $ville = $_GET['ville'];
    // Call the search method with the retrieved city
    $controller->search($ville);
    include './vue/footer.html.php';
} elseif(isset($_GET['cinema'])) {
    // Retrieve the cinema ID from the URL parameters
    $cinemaId = $_GET['cinema'];
    // Call the getFilmsByCinemaId method with the retrieved cinema ID
    $controller->getFilmsByCinemaId($cinemaId);
} else {
    // Display an error message if neither city nor cinema parameter is provided
    echo "No city or cinema specified for search.";
}


?>