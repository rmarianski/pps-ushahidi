<?php defined('SYSPATH') or die('No direct script access.');

Event::add('ushahidi_action.report_meta', 'add_nearby_link');
Event::add('ushahidi_action.report_form', 'update_map_js');
Event::add('ushahidi_action.nav_admin_settings', '_nearby_link');

function _nearby_link() {
    $this_sub_page = Event::$data;
    echo $this_sub_page === "nearby" ? "Nearby" : '<a href="'.url::site('admin/nearby').'">Nearby</a>';
}

function randsign($i) {
  return rand() % 2 === 0 ? $i : $i * -1;
}

function nearby_latlng($lat, $lng) {

  $nearby = new Nearby_Model(1);
  $distance_in_feet = $nearby->loaded ? $nearby->distance : 100;

  // go halfway in each direction
  $half = $distance_in_feet / 2;

  $lat_step_in_feet = randsign(rand(1, $half));
  $lng_step_in_feet = randsign(rand(1, $half));

  // this multiplier seems to work about right
  $multipler = 0.0000166;

  $lat_step = $lat_step_in_feet * $multipler;
  $lng_step = $lng_step_in_feet * $multipler;

  return array($lat + $lat_step,
               $lng + $lng_step);
}

function add_nearby_link() {
  $id = Event::$data;
  $location = ORM::factory('location')
    ->join('incident', 'incident.location_id', 'location.id', 'INNER')
    ->where('incident.id', $id)
    ->find();
  $new_latlng = nearby_latlng($location->latitude, $location->longitude);
  $lat = $new_latlng[0];
  $lng = $new_latlng[1];

  echo '<a href="' . url::site('/reports/submit') . '?lat=' . $lat . '&lng=' . $lng . '">Add idea nearby</a>';
}

function update_map_js() {
  if (isset($_GET['lat']) and isset($_GET['lng'])) {
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    if (is_numeric($lat) and is_numeric($lng)) {
      $js = View::factory('nearby/update_map_location_js');
      $js->lat = $lat;
      $js->lng = $lng;
      $js->render(TRUE);
    }
  }
}
