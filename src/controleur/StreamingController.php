<?php

class StreamingController extends Controller {

  public function __construct() 
  {
    $this->titre = 'Streaming';
    $this->view = 'streaming';

    $this->data = array(
      'titre' => $this->titre,
    );

    $this->render($this->view, $this->data);
  }
}
