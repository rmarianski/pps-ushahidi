<div id="main" class="report_detail">

	<div class="left-col" style="float:left;width:520px; margin-right:20px">
	
  	  <?php
    	  if ($incident_verified)
    		{
    			echo '<p class="r_verified" style="display:none;">'.Kohana::lang('ui_main.verified').'</p>';
    		}
    		else
    		{
    			echo '<p class="r_unverified" style="display:none;">'.Kohana::lang('ui_main.unverified').'</p>';
    		}
  	  ?>	
    

	<h4 class="report-title"><?php echo Kohana::lang('ui_main.reports_title');?></h4> <h6><?php
			echo $incident_title;
			
			// If Admin is Logged In - Allow For Edit Link
			if ($logged_in)
			{
				echo " [&nbsp;<a href=\"".url::site()."admin/reports/edit/".$incident_id."\">".Kohana::lang('ui_main.edit')."</a>&nbsp;]";
			}
		?></h6> 
      <h4 class="report-title">Where</h4><h6><?php echo $incident_location; ?></h6>
	
	
		
		<div class="report-description-text">
			<h4><?php echo Kohana::lang('ui_main.reports_description');?>&nbsp;</h4>
			<h6> <?php echo $incident_description; ?></h6>
<?php
// XXX hard coded to return the custom field
// can make this more generic by iterating through the custom form fields
$cat_id = 14;
if (isset($disp_custom_fields[$cat_id]) AND !empty($disp_custom_fields[$cat_id])):
?>
<h4>Because I want the city to be...</h4>
<h6><?php echo $disp_custom_fields[$cat_id]; ?></h6>
<?php endif; ?>
			<div class="credibility">
<!--
				<table class="rating-table" cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td><?php echo Kohana::lang('ui_main.credibility');?>?</td>
            <td><a href="javascript:rating('<?php echo $incident_id; ?>','add','original','oloader_<?php echo $incident_id; ?>')"><img id="oup_<?php echo $incident_id; ?>" src="<?php echo url::base() . 'media/img/'; ?>up.png" alt="UP" title="UP" border="0" /></a></td>
            <td><a href="javascript:rating('<?php echo $incident_id; ?>','subtract','original')"><img id="odown_<?php echo $incident_id; ?>" src="<?php echo url::base() . 'media/img/'; ?>down.png" alt="DOWN" title="DOWN" border="0" /></a></td>
            <td><a href="" class="rating_value" id="orating_<?php echo $incident_id; ?>"><?php echo $incident_rating; ?></a></td>
            <td><a href="" id="oloader_<?php echo $incident_id; ?>" class="rating_loading" ></a></td>
          </tr>
        </table>-->
<span class='st_twitter_vcount' displayText='Tweet' st_url="<?php echo urlencode(url::base() . url::current()) ?>" st_title="I just shared my idea for improving NYC. What's yours? #bythecity"></span>
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(url::base() . url::current()) ?>&amp;layout=standard&amp;show_faces=true&amp;width=292&amp;action=like&amp;font&amp;colorscheme=light&amp;height=55" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:55px;" allowTransparency="true"></iframe>
			</div>
		</div>
   
        	
	<p class="report-when-where">
			
            <span class="r_date"><?php echo $incident_time.' '.$incident_date; ?> </span>
<span>Submitted by:
<?php echo ($submitted_first_name || $submitted_last_name) ? $submitted_first_name." ".$submitted_last_name." " : "Anonymous " ?>
<?php if ($submitted_neighborhood): ?>
in <?php echo $submitted_neighborhood; ?>
<?php endif; ?>
</span>
		</p>
		<div class="report-category-list">
		<p>
			<?php
				foreach($incident_category as $category) 
				{ 
				  if ($category->category->category_image_thumb)
					{
					?>
					<a href="<?php echo url::site()."reports/?c=".$category->category->id; ?>"><span class="r_cat-box" style="background:transparent url(<?php echo url::base().Kohana::config('upload.relative_directory')."/".$category->category->category_image_thumb; ?>) 0 0 no-repeat;">&nbsp;</span> <?php echo $category->category->category_title; ?></a>
					
					<?php 
					}
					else
					{
					?>
					  <a href="<?php echo url::site()."reports/?c=".$category->category->id; ?>"><span class="r_cat-box" style="background-color:#<?php echo $category->category->category_color; ?>">&nbsp;</span> <?php echo $category->category->category_title; ?></a>
				  <?php
				  }
				}
			?>
			</p>
			<?php
			// Action::report_meta - Add Items to the Report Meta (Location/Date/Time etc.)
			Event::run('ushahidi_action.report_meta', $incident_id);
			?>
		</div>
		
		<?php
			// Filter::comments_block - The block that contains posted comments
			Event::run('ushahidi_filter.comment_block', $comments);
			echo $comments;
		?>
		
		<?php
			// Filter::comments_form_block - The block that contains the comments form
			Event::run('ushahidi_filter.comment_form_block', $comments_form);
			echo $comments_form;
		?>
	
	</div>
	
	<div style="float:right;width:350px;">

		<div class="report-media-box-tabs">
			<ul>
				<li class="report-tab-selected"><a class="tab-item" href="#report-map"><?php echo Kohana::lang('ui_main.map');?></a></li>
				<?php if( count($incident_photos) > 0 ) { ?>
					<li><a class="tab-item" href="#report-images"><?php echo Kohana::lang('ui_main.images');?></a></li>
				<?php } ?>
				<?php if( count($incident_videos) > 0 ) { ?>
					<li><a class="tab-item" href="#report-video"><?php echo Kohana::lang('ui_main.video');?></a></li>
				<?php } ?>
			</ul>
		</div>
		
		<div class="report-media-box-content">
			
			<div id="report-map" class="report-map">
				<div class="map-holder" id="map"></div>
        <ul class="map-toggles">
          <li><a href="#" class="smaller-map">Smaller map</a></li>
          <li style="display:block;"><a href="#" class="wider-map">Wider map</a></li>
          <li><a href="#" class="taller-map">Taller map</a></li>
          <li><a href="#" class="shorter-map">Shorter Map</a></li>
        </ul>
        <div style="clear:both"></div>
			</div>
			
			<!-- start images -->
			<?php if( count($incident_photos) > 0 ) { ?>
				<div id="report-images" style="display:none;">
						<?php
						foreach ($incident_photos as $photo)
						{
							$thumb = str_replace(".","_t.",$photo);
							$prefix = url::base().Kohana::config('upload.relative_directory');
							echo '<a class="photothumb" rel="lightbox-group1" href="'.$prefix.'/'.$photo.'"><img src="'.$prefix.'/'.$thumb.'"/></a> ';
						}
						?>
				</div>
			<?php } ?>
			<!-- end images -->
			
			<!-- start videos -->
			<?php if( count($incident_videos) > 0 ) { ?>
				<div id="report-video" style="display:none;">
					<?php
						// embed the video codes
						foreach( $incident_videos as $incident_video) {
							$videos_embed->embed($incident_video,'');
						}
					?>
				</div>
			<?php } ?>
			<!-- end videos -->
		
		</div>
<?php if (!empty($incident_news)): ?>
<div class="report-news">
<h4>Related links for this idea</h4>
<div class="rb_report">
<ul>
<?php foreach ($incident_news as $news_link): ?>
<li><a href="<?php echo $news_link; ?>"><?php echo $news_link; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</div>
<?php endif; ?>
		<div class="report-additional-reports">
			<h4><?php echo Kohana::lang('ui_main.additional_reports');?></h4>
			<?php foreach($incident_neighbors as $neighbor) { ?>
			  <div class="rb_report">
  			  <h5><a href="<?php echo url::site(); ?>reports/view/<?php echo $neighbor->id; ?>"><?php echo $neighbor->incident_title; ?></a></h5>
  			  <p class="r_date r-3 bottom-cap"><?php echo date('g:ia M d, Y', strtotime($neighbor->incident_date)); ?></p>
  			  <p class="r_location"><?php echo $neighbor->location_name.", ".round($neighbor->distance, 2); ?> Kms</p>
  			</div>
      <?php } ?>
		</div>

	</div>
	
	<div style="clear:both;"></div>
	
	
	
	
</div>