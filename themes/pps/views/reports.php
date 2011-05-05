<div id="content">
<div style="float: right; width: 200px">
   <form method="get" action="<?php echo url::site('search'); ?>">
     <input id="ideas-search" type="text" name="k" value="Search Ideas" />
   </form>
</div>
	<div class="content-bg" style="clear: both">
		<!-- start reports block -->
		<div class="big-block">
			<!--span><?php
			// Filter::report_stats - The block that contains reports list statistics
			//Event::run('ushahidi_filter.report_stats', $report_stats);
			//echo $report_stats;
			?></span-->
<h1><?php echo Kohana::lang('ui_main.reports').": ";?>
 <?php
if (!empty($category_titles))
     {
       echo 'in '.implode(', ',$category_titles).' - ';
     }
?>
<?php echo $pagination_stats; ?></h1>
<form method="GET" action="<?php echo url::site('reports'); ?>">
<ul>
<span style="font-weight: bold">Filter by</span>
<?php
foreach ($user_categories as $visible_category)
  {
          echo '<li style="list-style: none; display: inline; padding: 0 5px">'.category::display_category_checkbox($visible_category, $selected_categories, 'c').'</li>';
  }
?>
<span style="font-weight: bold; margin-left: 1em">Borough</span>
<select name="b">
   <option value="any">Any</option>
   <option value="Queens" <?php if (isset($_GET['b']) AND $_GET['b'] == "Queens"): ?>selected="true"<?php endif; ?>>Queens</option>
   <option value="Brooklyn" <?php if (isset($_GET['b']) AND $_GET['b'] == "Brooklyn"): ?>selected="true"<?php endif; ?>>Brooklyn</option>
   <option value="Manhattan" <?php if (isset($_GET['b']) AND $_GET['b'] == "Manhattan"): ?>selected="true"<?php endif; ?>>Manhattan</option>
   <option value="Bronx" <?php if (isset($_GET['b']) AND $_GET['b'] == "Bronx"): ?>selected="true"<?php endif; ?>>Bronx</option>
   <option value="Staten Island" <?php if (isset($_GET['b']) AND $_GET['b'] == "Staten Island"): ?>selected="true"<?php endif; ?>>Staten Island</option>
</select>

<span style="font-weight: bold; margin-left: 1em">Sort on</span>
<select name="sort">
   <option value="date">Date</option>
   <option value="comments" <?php if (isset($_GET['sort']) AND $_GET['sort'] == "comments"): ?>selected="true"<?php endif; ?>>Comments</option>
</select>
<input type="submit" value="Apply" />
</ul>
</form>
			<div style="clear:both;"></div>
			<div class="r_cat_tooltip"> <a href="#" class="r-3">2a. Structures a risque | Structures at risk</a> </div>

   

			<div class="reports-box">
            
				<?php
				foreach ($incidents as $incident)
				{
					$incident_id = $incident->id;
					$incident_title = $incident->incident_title;
					$incident_description = $incident->incident_description;
					//$incident_category = $incident->incident_category;
					// Trim to 150 characters without cutting words
					// XXX: Perhaps delcare 150 as constant

					$incident_description = text::limit_chars(strip_tags($incident_description), 150, "...", true);
					$incident_date = date('g:ia M d, Y', strtotime($incident->incident_dateadd));
					//$incident_time = date('H:i', strtotime($incident->incident_dateadd));
					$location_id = $incident->location_id;
					$location_name = $incident->location->location_name;
					$incident_verified = $incident->incident_verified;

					if ($incident_verified)
					{
						$incident_verified = '<span class="r_verified" style="display:none;">'.Kohana::lang('ui_main.verified').'</span>';
					}
					else
					{
						$incident_verified = '<span class="r_unverified" style="display:none;">'.Kohana::lang('ui_main.unverified').'</span>';
					}
					
					$comment_count = $incident->comment->count();
					
					$incident_thumb = url::site()."media/img/report-thumb-default.jpg";
					$media = $incident->media;
					if ($media->count())
					{
						foreach ($media as $photo)
						{
							if ($photo->media_thumb)
							{ // Get the first thumb
								$prefix = url::base().Kohana::config('upload.relative_directory');
								$incident_thumb = $prefix."/".$photo->media_thumb;
								break;
							}
						}
					}
					?>
					<div class="rb_report">

						<div class="r_media">
							<p class="r_photo"> <a href="<?php echo url::site(); ?>reports/view/<?php echo $incident_id; ?>">
								<img src="<?php echo $incident_thumb; ?>" height="59" width="89" /> </a>
							</p>

							<!-- Only show this if the report has a video -->
							<p class="r_video" style="display:none;"><a href="#">Video</a></p>
							
							<!-- Category Selector -->
							<div class="r_categories">
								<h4><?php echo Kohana::lang('ui_main.categories'); ?></h4>
								<?php
								foreach ($incident->category AS $category)
								{
									if ($category->category_image_thumb)
									{
										?>
										<a class="r_category" href="<?php echo url::site(); ?>reports/?c=<?php echo $category->id; ?>"><span class="r_cat-box"><img src="<?php echo url::base().Kohana::config('upload.relative_directory')."/".$category->category_image_thumb; ?>" height="16" width="16" /></span> <span class="r_cat-desc"><?php echo $localized_categories[(string)$category->category_title];?></span></a>
										<?php
									}
									else
									{
										?>
										<a class="r_category" href="<?php echo url::site(); ?>reports/?c=<?php echo $category->id; ?>"><span class="r_cat-box" style="background-color:#<?php echo $category->category_color;?>;"></span> <span class="r_cat-desc"><?php echo $localized_categories[(string)$category->category_title];?></span></a>
										<?php
									}
								}
								?>
							</div>
						</div>

						<div class="r_details">
							<h3 class="r_title">Wouldn't it be great if... <a class="r_title" href="<?php echo url::site(); ?>reports/view/<?php echo $incident_id; ?>"><?php echo $incident_title; ?></a> <a href="<?php echo url::site(); ?>reports/view/<?php echo $incident_id; ?>#discussion" class="r_comments"><?php echo $comment_count; ?></a> <?php echo $incident_verified; ?></h3>
							<p class="r_date r-3 bottom-cap"><?php echo $incident_date; ?></p>
							<div class="r_description" style="display:none"> <?php echo $incident_description; ?> </div>
							<h3 class="r_title">Where? <b style="font-weight:normal"><?php echo $location_name; ?></b></h3>
<?php if (isset($person_submitted_info[$incident->id])) {
$person_info = $person_submitted_info[$incident->id];
if ($person_info['first_name'] || $person_info['last_name']) { ?>
<h3>By <b style="font-weight: normal"><?php echo $person_info['first_name'].' '.$person_info['last_name']; ?></b></h3>
<?php } ?>
<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php echo $pagination; ?>
		</div>
		<!-- end reports block -->
	</div>
</div>
<script type="text/javascript">
(function($) {
$(document).ready(function() {
$('#ideas-search')
    .focus(function() {
        if ($(this).val() === "Search Ideas") {
            $(this).val('');
        }
    })
    .blur(function() {
        if ($(this).val().length === 0) {
            $(this).val("Search Ideas");
        }
    });
});
})(jQuery);
</script>
