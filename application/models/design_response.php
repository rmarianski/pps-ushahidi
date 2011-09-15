<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for reported Incidents
 *
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Robert Marianski
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Design Response Model
 * @copyright  PPS - http://www.pps.org/
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class Design_Response_Model extends ORM
{
        protected $has_one = array('incident');

	// Database table name
	protected $table_name = 'design_response';
}
