<?php defined('SYSPATH') or die('No direct script access.');

class Nearby_Install {
  public function __construct() {
    $this->db =  new Database();
  }

  public function run_install() {
    $this->db->query("
CREATE TABLE IF NOT EXISTS `".Kohana::config('database.default.table_prefix')."nearby`
(
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`distance` INT NOT NULL,
PRIMARY KEY (id)
);");

    $nearby_query = ORM::factory('nearby');
    $total = $nearby_query->count_all();
    if ($total === 0) {
      $nearby = new Nearby_Model(1);
      $nearby->distance = 100;
      $nearby->save();
    }

  }

  public function uninstall() {
    $this->db->query("
DROP TABLE ".Kohana::config('database.default.table_prefix')."nearby;");

  }

}
