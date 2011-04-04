<div class="bg">
	<h2>
		<?php admin::reports_subtabs("gpxer"); ?>
	</h2>
	
	<?php print form::open(NULL, array('enctype' => 'multipart/form-data', 'id' => 'gpxer', 'name' => 'gpxer')); ?>
	<input type="hidden" name="gpx2" value="222">
	<div class="report-form">	
		<div class="head">
			<h3>Upload GPX Files</h3>
		</div>
		<!-- column -->
		
		<?php
		if ($form_error) {
		?>
			<!-- red-box -->
			<div class="red-box">
				<h3><?php echo Kohana::lang('ui_main.error');?></h3>
				<ul>
				<?php
				foreach ($errors as $error_item => $error_description)
				{
					print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
				}
				?>
				</ul>
			</div>
		<?php
		}

		if ($form_saved) {
		?>
			<!-- green-box -->
			<div class="green-box">
				<h3><?php echo Kohana::lang('ui_main.report_saved');?></h3>
			</div>
		<?php
		}
		?>
		
		<!-- column -->		
		<div class="settings_holder">
			<p>
				GPX (the GPS Exchange Format) is a light-weight XML data format for the interchange of GPS data (waypoints, routes, and tracks) between applications and Web services on the Internet.
			</p>
			<p>
				Your GPX file will be converted to a single report.
			</p>
			<div class="row">
				<h4>GPX Location/Description <span>Road, Trail, Etc.</span></h4>
				<?php print form::input('gpx_location', $form['gpx_location'], ' class="text title"'); ?>
			</div>
			<div class="row">
				<h4>GPX File</h4>
				<?php print form::upload("gpx", "", ""); ?>
			</div>
			<div class="row">
				<br />
				<input type="submit" value="Upload" id="gpx_btn" />
			</div>
		</div>
		
		<div class="simple_border"></div>
		
	</div>
	<?php print form::close(); ?>
	
</div>