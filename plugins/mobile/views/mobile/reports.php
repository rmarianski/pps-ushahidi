<div class="report_list">
	<div class="block">
		<?php
		if ($category AND $category->loaded)
		{
			$category_id = $category->id;
			$color_css = 'class="swatch" style="background-color:#'.$category->category_color.'"';
			echo '<h2 class="other"><a href="#"><div '.$color_css.'></div>'.$category->category_title.'</a></h2>';
		}
		else
		{
			$category_id = "";
		}
		?>
		<div class="list">
			<ul>
				<?php
				if ($incidents->count())
				{
					$page_no = (isset($_GET['page'])) ? $_GET['page'] : "";
					foreach ($incidents as $incident)
					{
						$incident_date = $incident->incident_date;
						$incident_date = date('M j Y', strtotime($incident->incident_date));
						$location_name = $incident->location_name;
						echo "<li><strong><a href=\"".url::site()."mobile/reports/view/".$incident->id."?c=".$category_id."&p=".$page_no."\">".$incident->incident_title."</a></strong>";
						echo "&nbsp;&nbsp;<i>$incident_date</i>";
						echo "<BR /><span class=\"location_name\">".$location_name."</span></li>";
					}
				}
				else
				{
					echo "<li>No Reports Found</li>";
				}
				?>
			</ul>
		</div>
		<?php echo $pagination; ?>
	</div>
</div>