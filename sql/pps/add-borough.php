<?php
// geocode locations that don't have a borough selected
// and update database

// work around kohana checks
define('SYSPATH', realpath("system") . "/");
$_SERVER["HTTP_HOST"] = "localhost";

include("application/config/database.php");
include("application/libraries/GoogleMapAPI.php");

$map_object = new GoogleMapAPI_Core;

$conn = $config['default']['connection'];

$link = mysql_connect($conn['host'], $conn['user'], $conn['pass']);
if (!$link) {
  die('could not connect to database');
}

$db_selected = mysql_select_db($conn['database'], $link);
if (!$db_selected) {
  die('could not select db');
}

$result = mysql_query('SELECT id, latitude, longitude FROM location WHERE borough is NULL');
if (!$result) {
  die('error querying database');
}

$n_geocoded = 0;
$n_updated = 0;

while ($row = mysql_fetch_assoc($result)) {
  $geocode_result = $map_object->reverseGeocode($row['latitude'], $row['longitude']);
  $borough = $map_object->parseBorough($geocode_result);
  $n_geocoded += 1;
  if ($borough) {
    mysql_query("UPDATE location SET borough='".$borough."' WHERE id=".$row['id']);
    $n_updated += 1;
  }
  // throttle requests sent out
  sleep(1);
}

mysql_close($link);

echo "$n_geocoded geocoded\n";
echo "$n_updated updated\n";
