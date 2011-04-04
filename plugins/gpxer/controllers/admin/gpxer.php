<?php defined('SYSPATH') or die('No direct script access.');
/**
 * GPXer Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   GPXer Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
* 
*/

class Gpxer_Controller extends Admin_Controller {
	
	public function __construct()
    {
		parent::__construct();
		$this->template->this_page = 'gpxer';
	}
	
	public function index($saved = false)
	{
		$db = new Database();
		$this->template->content = new View('gpxer/gpxer');
		
		// Add gpx mimetype
		Kohana::config_set('mimes.gpx', array('application/octet-stream'));
		
		// setup and initialize form field names
		$form = array
		(
			'gpx_location'	   => '',
			'gpx'	   => ''
		);
		
		$errors = $form;
		$form_error = FALSE;
		if ($saved == 'saved')
		{
			$form_saved = TRUE;
		}
		else
		{
			$form_saved = FALSE;
		}
		
		// check, has the form been submitted, if so, setup validation
		if ($_POST)
		{
			$post = Validation::factory(array_merge($_POST,$_FILES));
			$post->pre_filter('trim', TRUE);
			
			$post->add_rules('gpx_location','required', 'length[3,100]');
			$post->add_rules(
					'gpx',
					'upload::valid',
					'upload::required',
					'upload::type[gpx]',
					'upload::size[2M]');
			
			if ($post->validate())
			{
				// Temporary file name
				$gpx = upload::save('gpx');
				
				// Load File
				$xml = simplexml_load_file($gpx);
				
				// Get the Points Data
				$linestring = array();
				$i = 0;
				$point_array = array();
				foreach($xml->trk as $part)
				{
					foreach ($part->trkseg->trkpt as $point)
					{
						// START POINT
						if ( $i == 0 )
						{
							$longitude = $point['lon'];
							$latitude = $point['lat'];
							$time = $point->time;
						}
						
						$linestring[] = $point['lon'] . " " . $point['lat'];
						
						// We'll use these array elements to calculate distance later
						$point_array[$i][0] = $point['lon'];
						$point_array[$i][1] = $point['lat'];
						$point_array[$i][2] = $point->time;
										
						$i++;
					}
				}
				
				// If we have points...
				if (count($linestring))
				{
					// Calculate Total Distance by adding up
					// distance between each point
					$distance = 0;
					$start_time = 0;
					$end_time = 0;
					for ($i=0; $i < count($point_array); $i++)
					{ 
						if ($i == 0)
						{
							$start_time = strtotime($point_array[$i][2]);
						}
						else
						{
							$latitude1 = (double) $point_array[$i][1];
							$longitude1 = (double) $point_array[$i][0];
							$latitude2 = (double) $point_array[$i - 1][1];
							$longitude2 = (double) $point_array[$i - 1][0];
							
							$d = map::distance($latitude1, $longitude1,
								$latitude2, $longitude2);
							
							if ( ! is_nan($d))
							{
								$distance += $d;
							}
							
							$end_time = strtotime($point_array[$i][2]);
						}
					}
					
					$description = "Location: ".$post->gpx_location."\n";
					$description .= "Start Time: ".date( "Y-m-d H:i:s", $start_time )."\n";
					$description .= "End Time: ".date( "Y-m-d H:i:s", $end_time )."\n";
					$description .= "Elapsed Time: ".$this->_seconds_2Words($end_time - $start_time)."\n";
					$description .= "Distance: ".round($distance, 2)." Kms";
					
					// STEP 1: SAVE LOCATION
					$location = ORM::factory("location");
					$location->location_name = $post->gpx_location;
					$location->latitude = $latitude;
					$location->longitude = $longitude;
					$location->location_date = date( "Y-m-d H:i:s", strtotime($time) );
					$location->save();

					// STEP 2: SAVE INCIDENT
					$incident = ORM::factory("incident");
					$incident->location_id = $location->id;
					$incident->user_id = $_SESSION['auth_user']->id;
					$incident->incident_title = $post->gpx_location . " (".round($distance, 2)." Kms)";
					$incident->incident_description = $description;
					$incident->incident_zoom = 16;
					$incident->incident_date = date( "Y-m-d H:i:s", strtotime($time) );
					$incident->save();
					
					// STEP 3: SAVE LINESTRING
					$linestring = implode(",", $linestring);
					//++ Can't Use ORM for this
					$sql = "INSERT INTO ".Kohana::config('database.default.table_prefix')."geometry ( incident_id, geometry ) 
						VALUES( ".$incident->id.", GeomFromText( 'LINESTRING(".mysql_escape_string($linestring).")' ))";
					$db->query($sql);
					
					// STEP 4: SAVE POINT
					//++ Can't Use ORM for this
					$sql = "INSERT INTO ".Kohana::config('database.default.table_prefix')."geometry ( incident_id, geometry ) 
						VALUES( ".$incident->id.", GeomFromText( 'POINT(".mysql_escape_string($longitude)." ".mysql_escape_string($latitude).")' ))";
					$db->query($sql);
				}
				
				// Remove the temporary file
				unlink($gpx);
				
				// Redirect to report
				url::redirect(url::site().'admin/reports/edit/'.$incident->id);
			}
			// No! We have validation errors, we need to show the form again, with the errors
			else
			{
				// repopulate the form fields
				$form = arr::overwrite($form, $files->as_array());

				// populate the error fields, if any
				$errors = arr::overwrite($errors, $post->errors('gpxer'));
				$form_error = TRUE;
			}
		}
		
		
		$this->template->content->form = $form;
		$this->template->content->errors = $errors;
		$this->template->content->form_error = $form_error;
		$this->template->content->form_saved = $form_saved;
	}
	
	/**
	 *
	 * @convert seconds to hours minutes and seconds
	 *
	 * @param int $seconds The number of seconds
	 *
	 * @return string
	 *
	 */
	private function _seconds_2Words($seconds)
	{
	    /*** return value ***/
	    $ret = "";

	    /*** get the hours ***/
	    $hours = intval(intval($seconds) / 3600);
	    if($hours > 0)
	    {
	        $ret .= "$hours hours ";
	    }
	    /*** get the minutes ***/
	    $minutes = bcmod((intval($seconds) / 60),60);
	    if($hours > 0 || $minutes > 0)
	    {
	        $ret .= "$minutes minutes ";
	    }

	    /*** get the seconds ***/
	    $seconds = bcmod(intval($seconds),60);
	    $ret .= "$seconds seconds";

	    return $ret;
	}
	
}