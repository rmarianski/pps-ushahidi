<?php defined('SYSPATH') or die('No direct script access.');

// redirect to the trends page
// need a separate controller to lookup the id of the trends page to redirect to
// this can be different for each site based on when it was added
// if the trends page is not found, show the map page

class Home_Controller extends Main_Controller {

  public function index() {
    $pages = ORM::factory("page")
      ->where("page_title", "Trends")
      ->where("page_active", "1")
      ->find_all();

    if (!empty($pages)) {
      $page = $pages[0];
      $page_url = "page/index/" . $page->id;
    } else {
      $page_url = "main";
    }
    url::redirect($page_url);
  }

}
