


<div id="content">
	<div class="content-bg">
		<!-- start report form block -->
		<?php print form::open(NULL, array('enctype' => 'multipart/form-data', 'id' => 'reportForm', 'name' => 'reportForm', 'class' => 'gen_forms')); ?>
		<input type="hidden" name="latitude" id="latitude" value="<?php echo $form['latitude']; ?>">
		<input type="hidden" name="longitude" id="longitude" value="<?php echo $form['longitude']; ?>">
		<div class="big-block">
			<h1 style="display:none;"><?php echo Kohana::lang('ui_main.reports_submit_new'); ?></h1>
			<?php
				if ($form_error) {
			?>
			<!-- red-box -->
			<div class="red-box">
				<h3>Error!</h3>
				<ul>
					<?php
						foreach ($errors as $error_item => $error_description)
						{
							// print "<li>" . $error_description . "</li>";
							print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
						}
					?>
				</ul>
			</div>
			<?php
				}
			?>
			<div class="row">
				<input type="hidden" name="form_id" id="form_id" value="<?php echo $id?>">
			</div>
			<div class="report_left">
				<div class="report_row">
					<h3><?php echo Kohana::lang('ui_main.reports_title'); ?></h3>
                    
					<?php print form::textarea('incident_title', $form['incident_title'], ' rows="2" class="textarea long" placeholder="...share one idea to improve your block, neighborhood, city..."'); ?>
				</div>
                 <div class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_location_name'); ?><br /><span class="example"><?php echo Kohana::lang('ui_main.detailed_location_example'); ?></span></h4>
					<?php print form::input('location_name', $form['location_name'], ' class="text long"'); ?>
				</div>
				<div class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_description'); ?></h4>
					<?php print form::textarea('incident_description', $form['incident_description'], ' rows="2" class="textarea long" ') ?>
				</div>
               
				<div class="report_row" style="display:none" id="datetime_default">
					<h4><a href="#" id="date_toggle" class="show-more"><?php echo Kohana::lang('ui_main.modify_date'); ?></a><?php echo Kohana::lang('ui_main.date_time'); ?>: 
						<?php echo Kohana::lang('ui_main.today_at')." "."<span id='current_time'>".$form['incident_hour']
							.":".$form['incident_minute']." ".$form['incident_ampm']."</span>"; ?></h4>
				</div>
				<div class="report_row hide" style="display:none" id="datetime_edit">
					<div class="date-box">
						<h4><?php echo Kohana::lang('ui_main.reports_date'); ?></h4>
						<?php print form::input('incident_date', $form['incident_date'], ' class="text short"'); ?>								
						<script type="text/javascript">
							$().ready(function() {
								$("#incident_date").datepicker({ 
									showOn: "both", 
									buttonImage: "<?php echo url::base() ?>media/img/icon-calendar.gif", 
									buttonImageOnly: true 
								});
							});
						</script>
					</div>
					<div class="time">
						<h4><?php echo Kohana::lang('ui_main.reports_time'); ?></h4>
						<?php
							for ($i=1; $i <= 12 ; $i++) { 
								$hour_array[sprintf("%02d", $i)] = sprintf("%02d", $i);	 // Add Leading Zero
							}
							for ($j=0; $j <= 59 ; $j++) { 
								$minute_array[sprintf("%02d", $j)] = sprintf("%02d", $j);	// Add Leading Zero
							}
							$ampm_array = array('pm'=>'pm','am'=>'am');
							print form::dropdown('incident_hour',$hour_array,$form['incident_hour']);
							print '<span class="dots">:</span>';
							print form::dropdown('incident_minute',$minute_array,$form['incident_minute']);
							print '<span class="dots">:</span>';
							print form::dropdown('incident_ampm',$ampm_array,$form['incident_ampm']);
						?>
					</div>
					<div style="clear:both; display:block;" id="incident_date_time"></div>
				</div>
				<script type="text/javascript">
					var now = new Date();
					var h=now.getHours();
					var m=now.getMinutes();
					var ampm="am";
					if (h>=12) ampm="pm"; 
					if (h>12) h-=12;
					var hs=(h<10)?("0"+h):h;
					var ms=(m<10)?("0"+m):m;
					$("#current_time").text(hs+":"+ms+" "+ampm);
					$("#incident_hour option[value='"+hs+"']").attr("selected","true");
					$("#incident_minute option[value='"+ms+"']").attr("selected","true");
					$("#incident_ampm option[value='"+ampm+"']").attr("selected","true");
				</script>
				
				<div id="custom_forms">
					
                                <?php
                                
					foreach ($disp_custom_fields as $field_id => $field_property)
					{
						echo "<div class=\"report_row\">";
						echo "<h4>" . $field_property['field_name'] . "</h4>";
						if ($field_property['field_type'] == 1)
						{ // Text Field
							// Is this a date field?
							if ($field_property['field_isdate'] == 1)
							{
								echo form::input('custom_field['.$field_id.']', $form['custom_field'][$field_id],
								' id="custom_field_'.$field_id.'" class="text"');
								echo "<script type=\"text/javascript\">
									$(document).ready(function() {
									$(\"#custom_field_".$field_id."\").datepicker({ 
									showOn: \"both\", 
									buttonImage: \"" . url::base() . "media/img/icon-calendar.gif\", 
									buttonImageOnly: true 
									});
									});
								</script>";
							}
							else
							{
								echo form::input('custom_field['.$field_id.']', $form['custom_field'][$field_id],
								' id="custom_field_'.$field_id.'" class="text custom_text"');
							}
						}
						elseif ($field_property['field_type'] == 2)
						{ // TextArea Field
							echo form::textarea('custom_field['.$field_id.']', $form['custom_field'][$field_id], '  rows="2" class="textarea long"');
						}
						echo "</div>";
					}
					?>
                            </div>
                           
                
                <div class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_categories'); ?><br /><span class="example">Check all that apply</span></h4>
					<div class="report_category" id="categories">
						<?php
						$selected_categories = array();
                if (!empty($form['incident_category']) && is_array($form['incident_category'])) {
							$selected_categories = $form['incident_category'];
						}
?>
<ul>
<?php
$visible_categories = Kohana::config('pps.visible_categories');
foreach ($categories as $category)
{
  if (in_array($category->category_title, $visible_categories))
  {
    foreach ($category->children as $child)
    {
      echo '<li>'.category::display_category_checkbox($child, $selected_categories, 'incident_category').'</li>';
    }
  }
}
?>
</ul>
					</div>
				</div>
				<?php
				
				// Action::report_form - Runs right after the report categories
				Event::run('ushahidi_action.report_form');
				?>
                
                
                
                
                		<?php if (!$multi_country)
							{
				?>
				<!--<div class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_find_location'); ?></h4>
					<?php print form::dropdown('select_city',$cities,'', ' class="select" '); ?>
				</div>-->
				<?php
					 }
				?>
				<div class="report_row">
                <h4>Map your Idea</h4>
              	  	<div class="report-find-location">
							<p>Click anywhere on map to place marker.</p> <p> Click and drag map to move map. </p><p> Use + and - icons to zoom map.</p>
                   	</div>
					<div id="divMap" class="report_map"></div>
                    <div style="clear:both;" id="find_text"><?php echo Kohana::lang('ui_main.pinpoint_location'); ?>.</div>
					
                   	</div>
					<div class="report-find-location" style="display:none;">
						<?php print form::input('location_find', '', ' title="'.Kohana::lang('ui_main.location_example').'" class="findtext"'); ?>
						<div style="float:left;margin:9px 0 0 5px;"><input type="button" name="button" id="button" value="<?php echo Kohana::lang('ui_main.find_location'); ?>" class="btn_find" /></div>
						<div id="find_loading" class="report-find-loading"></div>
						
				</div>
                
                
                
                
                
                

				<div class="report_optional">
					<h4 style="font-size:175%"><?php echo Kohana::lang('ui_main.reports_optional'); ?></h4>
					<!-- News Fields -->
				<div id="divNews" class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_news'); ?></h4>
					<?php
						$this_div = "divNews";
						$this_field = "incident_news";
						$this_startid = "news_id";
						$this_field_type = "text";
						if (empty($form[$this_field]))
						{
							$i = 1;
							print "<div class=\"report_row\">";
							print form::input($this_field . '[]', '', ' class="text long2"');
							print "<a href=\"#\" class=\"add\" onClick=\"addFormField('$this_div','$this_field','$this_startid','$this_field_type'); return false;\">add</a>";
							print "</div>";
						}
						else
						{
							$i = 0;
							foreach ($form[$this_field] as $value) {
							print "<div class=\"report_row\" id=\"$i\">\n";

							print form::input($this_field . '[]', $value, ' class="text long2"');
							print "<a href=\"#\" class=\"add\" onClick=\"addFormField('$this_div','$this_field','$this_startid','$this_field_type'); return false;\">add</a>";
							if ($i != 0)
							{
								print "<a href=\"#\" class=\"rem\"	onClick='removeFormField(\"#" . $this_field . "_" . $i . "\"); return false;'>remove</a>";
							}
							print "</div>\n";
							$i++;
						}
					}
					print "<input type=\"hidden\" name=\"$this_startid\" value=\"$i\" id=\"$this_startid\">";
				?>
				</div>


				<!-- Video Fields -->
				<div id="divVideo" style="display:none" class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_video'); ?></h4>
					<?php
						$this_div = "divVideo";
						$this_field = "incident_video";
						$this_startid = "video_id";
						$this_field_type = "text";

						if (empty($form[$this_field]))
						{
							$i = 1;
							print "<div class=\"report_row\">";
							print form::input($this_field . '[]', '', ' class="text long2"');
							print "<a href=\"#\" class=\"add\" onClick=\"addFormField('$this_div','$this_field','$this_startid','$this_field_type'); return false;\">add</a>";
							print "</div>";
						}
						else
						{
							$i = 0;
							foreach ($form[$this_field] as $value) {
								print "<div class=\"report_row\" id=\"$i\">\n";

								print form::input($this_field . '[]', $value, ' class="text long2"');
								print "<a href=\"#\" class=\"add\" onClick=\"addFormField('$this_div','$this_field','$this_startid','$this_field_type'); return false;\">add</a>";
								if ($i != 0)
								{
									print "<a href=\"#\" class=\"rem\"	onClick='removeFormField(\"#" . $this_field . "_" . $i . "\"); return false;'>remove</a>";
								}
								print "</div>\n";
								$i++;
							}
						}
						print "<input type=\"hidden\" name=\"$this_startid\" value=\"$i\" id=\"$this_startid\">";
					?>
				</div>

				<!-- Photo Fields -->
				<div id="divPhoto"  class="report_row">
					<h4><?php echo Kohana::lang('ui_main.reports_photos'); ?></h4>
					<?php
						$this_div = "divPhoto";
						$this_field = "incident_photo";
						$this_startid = "photo_id";
						$this_field_type = "file";

						if (empty($form[$this_field]['name'][0]))
						{
							$i = 1;
							print "<div class=\"report_row\">";
							print form::upload($this_field . '[]', '', ' class="file long2"');
							print "<a href=\"#\" class=\"add\" onClick=\"addFormField('$this_div','$this_field','$this_startid','$this_field_type'); return false;\">add</a>";
							print "</div>";
						}
						else
						{
							$i = 0;
							foreach ($form[$this_field]['name'] as $value) 
							{
								print "<div class=\"report_row\" id=\"$i\">\n";

								// print "\"<strong>" . $value . "</strong>\"" . "<BR />";
								print form::upload($this_field . '[]', $value, ' class="file long2"');
								print "<a href=\"#\" class=\"add\" onClick=\"addFormField('$this_div','$this_field','$this_startid','$this_field_type'); return false;\">add</a>";
								if ($i != 0)
								{
									print "<a href=\"#\" class=\"rem\"	onClick='removeFormField(\"#" . $this_field . "_" . $i . "\"); return false;'>remove</a>";
								}
								print "</div>\n";
								$i++;
							}
						}
						print "<input type=\"hidden\" name=\"$this_startid\" value=\"$i\" id=\"$this_startid\">";
					?>

				</div>
                    <div class="report_row">
							 <h4><?php echo Kohana::lang('ui_main.reports_first'); ?></h4>
                             
							 <?php print form::input('person_first', $form['person_first'], ' class="text long" ', 'value="text"'); ?>
					</div>
					<div class="report_row">
						<h4><?php echo Kohana::lang('ui_main.reports_last'); ?></h4>
						<?php print form::input('person_last', $form['person_last'], ' class="text long"'); ?>
					</div>
					<div class="report_row">
						<h4><?php echo Kohana::lang('ui_main.reports_email'); ?></h4>
						<?php print form::input('person_email', $form['person_email'], ' class="text long"'); ?>
					</div>
					<?php
					// Action::report_form_optional - Runs in the optional information of the report form
					Event::run('ushahidi_action.report_form_optional');
					?>
				</div>
                <div class="report_row">
					<input name="submit" type="submit" value="<?php echo Kohana::lang('ui_main.reports_btn_submit'); ?>" class="btn_submit" /> 
				</div>
			</div>
			<div class="report_right">
		
                
              <h5 style=" font-size:110%; font-weight:normal;">Tell us how you think New York City's public spaces could be made better! We're interested
in ideas big and small-from streets, sidewalks, and parks all the way up to systems like
transportation and other city infrastructure. If you've got an idea about improving the
physical environment of your block, neighborhood, borough, or the city as a whole, we
want to hear it.</h5>

<h5  style=" font-size:110%; font-weight:normal;">From now until April 30, we're gathering up all your ideas; in May, we're going to rally the
designers from around the world to create proposals that address many of the situations
and sites you share. The more ideas the better, so tell us what you think!</h5>

<h5  style=" font-size:110%; font-weight:normal;">Here are 3 great examples:</h5>
<h5  style=" font-size:110%; font-weight:bold;">Wouldn't be great if...</h5>

<h5  style=" font-size:110%; font-weight:normal;">...<a href="http://urbandesignweek.org/by-the-city/reports/view/41">there were no mountains of trash in the sidewalks or rats in the parking lot in the 5th street</a></h5>
<h5  style=" font-size:110%; font-weight:normal;">...<a href="http://urbandesignweek.org/by-the-city/reports/view/43">there were a gym, grocery store, and/or library near the Astoria Blvd. stop.</a></h5>
<h5  style=" font-size:110%; font-weight:normal;">...<a href="http://urbandesignweek.org/by-the-city/reports/view/47">Expand N/R subway entrance on Broadway south of Astor Pl.</a></h5>


				
				

				
									
				
			</div>
		</div>
		<?php print form::close(); ?>
		<!-- end report form block -->
	</div>
</div>
<script type="text/javascript">
(function($) {
  $(document).ready(function() {
      var options = {
          allowed: 200,
          warning: 20,
          counterText: "Characters left: ",
          counterElement: 'p'
      };
      $('#incident_title').charCount(options);
      $('#incident_description').charCount(options);
  });
})(jQuery);
</script>
