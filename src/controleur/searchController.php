<?php

include_once("./modele/MyPdo.php");
include_once("./modele/SearchBD.php");
include './vue/header.html.php';

class searchController
{
    public function search($ville)
    {
        $concreteMyPdo = new SearchBD();

        $results = $concreteMyPdo->Search_selon_Ville($ville);

        if (!empty($results)) {
            // var_dump($results);
            include './vue/Resultats_recherche.php';
        } else {
            echo "No results found.";
        }
    }
}

// Create an instance of the controller
$controller = new searchController();

// Check if the "ville" parameter is set in the URL
if(isset($_GET['ville'])) {
    // Retrieve the city from the URL parameters
    $ville = $_GET['ville'];
    // var_dump($ville);
    // Call the search method with the retrieved city
    $controller->search($ville);
} else {
    // Display an error message if the city parameter is not provided
    echo "No city specified for search.";
}


include './vue/footer.html.php';
?>
