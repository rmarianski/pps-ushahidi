<?php defined('SYSPATH') or die('No direct script access.');

class Nearby_Controller extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->template->this_page = 'nearby';
  }

  public function index() {
    $this->template->this_page = 'nearby';
    $this->template->content = new View('nearby/admin');
    $this->template->content->title = 'Nearby settings';

    $db = new Database();

    $form = array("distance" => '');
    $errors = array("distance" => '');

    if ($_POST) {
      $post = new Validation($_POST);
      $post->pre_filter('trim', TRUE);
      $post->add_rules('distance', 'required', 'numeric');

      if ($post->validate()) {
        $nearby = new Nearby_Model(1);
        $nearby->distance = $post->distance;
        $nearby->save();

        $form = arr::overwrite($form, $post->as_array());
      } else {
        $form = arr::overwrite($form, $post->as_array());
        $errors = arr::overwrite($errors, $post->errors('distance'));
      }
    } else {
      $nearby = ORM::factory('nearby', 1);
      $form = array('distance' => $nearby->distance);
    }

    $this->template->content->form = $form;
    $this->template->content->errors = $errors;

  }

}
