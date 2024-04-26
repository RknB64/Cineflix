<?php

class AjaxRequestController extends Controller
{

  private string $completionView = 'component/ajaxCompletionList';

  private string $request;
  private VilleBD $villeBD;

  public function __construct()
  {

    $this->request = $_POST['request'];

    switch ($this->request) {

      case AjaxHandler::AUTOCOMPLETE_VILLE:
        $this->villeBD = new VilleBD();
        $colName = 'nom';

        $this->data = $this->autocomplete($this->villeBD, $colName);
        $this->render($this->completionView, $this->data, false);
        break;

      default:
        // TODO
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
