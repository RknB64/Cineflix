<?php

class InscriptionController extends Controller
{

  private array     $formFields;
  private string    $requestMethod;

  public function __construct(string $requestMethod)
  {
    $this->requestMethod = $requestMethod;
    $this->titre    = 'Inscription';
    $this->view     = 'inscription';

    // inputs qui seront affichés
    $this->formFields = UserRegister::getFormFields();


    // TODO si register ok, login et rediriger l'utilisateur
    if ($this->requestMethod === 'POST') {
      UserRegister::handleRegisterPost($_POST);
    }

    $this->data = array(
      'titre'       => $this->titre,
      'formFields'  => $this->formFields
    );

    $this->render($this->view, $this->data);

  }
}
