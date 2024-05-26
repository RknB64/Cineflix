<?php

class AjaxRequestController extends Controller
{

    // Classes PDO utilisées
    private VilleBD $villeBD;

    // Variables utilisées par la vue

    // Variables utilisées par le controller
    private string  $request;

    public function __construct()
    {
        $this->titre = '';

        $this->request = $_POST['request'];

        switch ($this->request) {

            case "autocomplete-ville":
                $this->view = 'component/ajaxCompletionList';
                $this->villeBD = new VilleBD();
                $colName = 'nom';

                $this->data = $this->autocomplete($this->villeBD, $colName);
                $this->render($this->view, $this->data, false);
                break;

            case "toggle-admin":
                $isUpdated = AjaxHandler::toggleAdmin($_POST['idAdherent']);
                // on set le code de réponse selon si l'update à réussi ou non. (code 500 va run le block error dans l'ajax)
                $code = $isUpdated ? 200 : 500;
                http_response_code($code);
                break;

            case "delete-adherent":
                $isDeleted = AjaxHandler::deleteAdherent($_POST['idAdherent']);
                $code = $isDeleted ? 200 : 500;
                http_response_code($code);
                break;

            case "delete-film":
                $isDeleted = AjaxHandler::deleteFilm($_POST['idFilm']);
                $code = $isDeleted ? 200 : 500;
                http_response_code($code);
                break;

            case "add-film":
                $newAdherent = AjaxHandler::addFilm($_POST);
                $code = $newAdherent !== null ? 200 : 500;
                http_response_code($code);
                echo json_encode($newAdherent);
                break;
        }
    }

    // prend un object de base de donnée et le nom d'une colonne et autocomplete selon ces arguments
    // par exemple les arg ($villeBD, 'nom') autocomplete le nom des villes
    private function autocomplete($objectBD, $colName): array
    {
        $inputId = $_POST['inputId']; // TODO pas terrible ca

        $result = AjaxHandler::autocomplete($_POST['keyword'], $objectBD, $colName);

        $data = array(
            'colName' => $colName,
            'inputId' => $inputId,
            'result'  => $result,
        );

        return $data;
    }
}
