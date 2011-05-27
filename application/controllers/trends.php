<?php defined('SYSPATH') or die('No direct script access.');

class Trends_Controller extends Main_Controller {

  public function query_feed($feed_name) {
    $db = new Database();

    $feed_item_data = $db->query(
        "SELECT fi.item_title, fi.item_description, fi.item_date " .
        "FROM feed_item fi " .
        "INNER JOIN feed f on f.id=fi.feed_id " .
        "WHERE f.feed_name='$feed_name'");
    return $feed_item_data;
  }

  public function index() {
    $this->template->header->this_page = 'trends';
    $this->template->header->header_block = $this->themes->header_block();
    $this->template->content = new View('trends');

    $feed_name_list = Kohana::config('pps.feed_list');
    $feed_name_post = Kohana::config('pps.feed_post');

    $this->template->content->feed_list = $this->query_feed($feed_name_list);
    $this->template->content->feed_post = $this->query_feed($feed_name_post);
  }
}
