
<div id="content">
	<div class="content-bg">
		<!-- start block -->
		<div class="big-block">
			
			<!-- green-box -->
			<div class="green-box">
				<div class="thanks_msg">
                <h4><?php echo Kohana::lang('ui_main.reports_submit_new');?></h4>
				<p><?php echo Kohana::lang('ui_main.reports_submitted');?></p><br />
				<br />

				<p>More ways to help:<br /><br />
					- Add another <a href="../reports/submit">idea</a><br /><br />
                    - Share this w/ friends with the buttons at the top of the page.<br /><br />
					- Vote or comment on fellow New Yorker's ideas; <a href="../">view the map</a> or <a href="../reports">view by list</a></p>	
                
                <a href="<?php echo
					url::site().'reports' ?>"><?php echo Kohana::lang('ui_main.reports_return');?></a>
					<?php echo Kohana::lang('ui_main.feedback_reports');?>
					<?php 
					print form::open('http://feedback.ushahidi.com/fillsurvey.php?sid=2', array('target'=>'_blank'));
					print form::hidden('alert_code', $_SERVER['SERVER_NAME']);
					print "&nbsp;&nbsp;";
					/*print form::submit('button', Kohana::lang('ui_main.feedback'), ' class=btn_gray ');*/
					print form::close();
					?>
				</div>
			</div>
		</div>
		<!-- end block -->
	</div>
</div>